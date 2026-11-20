<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Session;
use App\Models\User;
use Hash;
use DB;

class AuthController extends Controller
{
public function login(Request $request){
       
		$date = date('Y-m-d H:i:s');
        $date = strtotime($date);
        $date = strtotime("+3 minute", $date);
        $new_date=date('Y-m-d H:i:s', $date);
        $otp = random_int(100000, 999999);
       
        $data = $request->validate([
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-9]{9}/',
        ]);
        
        $phone = $data['phone'];
        $ip = $request->ip();
        
        // SEC-07: Check if phone belongs to staff/admin
        $existingUser = User::where('mobile', $phone)->first();
        if ($existingUser && $existingUser->hasAnyRole(['admin', 'worker', 'vendor'])) {
            return response()->json([
                'success' => false,
                'msg' => 'Staff accounts must sign in at /admin'
            ]);
        }
        
        // SEC-08: Rate limit OTP sending - 1 per minute, 5 per hour per phone+IP
        $otpKey = "otp_send:{$phone}:{$ip}";
        $minuteKey = $otpKey . ':minute';
        $hourKey = $otpKey . ':hour';
        
        if (Cache::has($minuteKey)) {
            return response()->json([
                'success' => false,
                'msg' => 'Please wait before requesting another OTP'
            ], 429);
        }
        
        $hourCount = Cache::get($hourKey, 0);
        if ($hourCount >= 5) {
            return response()->json([
                'success' => false,
                'msg' => 'Too many OTP requests. Please try again later.'
            ], 429);
        }
    
        $data['otp_verify'] = $otp;
        $data['exp_time'] = $new_date;
        $data['otp_attempts'] = 0;
        
        session()->put('user_data', $data);        
        $number = $phone;        
        $msg = 'Your One-Time PIN is ' . $otp . '. It will expire in 3 minutes.';
        $success = sendSMS($number, $msg);        
        $res = json_decode($success);
     	
       	$url = route('front.getOpt');

        if (isset($res->Status) && ($res->Status == '0')) {
            // Increment rate limit counters
            Cache::put($minuteKey, 1, now()->addMinute());
            Cache::put($hourKey, $hourCount + 1, now()->addHour());
            
            return response()->json(['success' => true, 'msg' => 'PIN Is Send Please Check Your Phone', 'url' => $url]);
        } else {
            return response()->json(['success' => false, 'msg' => 'Something Went Wrong . try again Later !']);
        }
    
    }
  
    public function getOpt(){

		$user_data=session()->get('user_data');
        
        if(empty($user_data)){
            return redirect()->route('login');
        }
     
        return view('auth.otp_verify');
    }
  
  
  
public function optVerify(){
         
        $user_data=session()->get('user_data');
        //dd($user_data);
        date_default_timezone_set("Asia/Dhaka");
        
        
        if(empty($user_data)){
            return redirect()->route('login');
        }
        
        $exp_date = date('Y-m-d H:i:s');
        if(request('button')=='Save'){
            request()->validate([
                'otp_verify' => 'required',
            ]);
            
            // SEC-08: Track OTP verification attempts (max 5 per OTP)
            $attempts = ($user_data['otp_attempts'] ?? 0) + 1;
            $user_data['otp_attempts'] = $attempts;
            session()->put('user_data', $user_data);
            
            if ($attempts > 5) {
                session()->put('user_data', []);
                return back()->with('error_msg', 'Too many failed attempts. Please request a new OTP.');
            }
            
            if($user_data['otp_verify'] != request('otp_verify')){
                return back()->with('error_msg', 'PIN Is Not Match. please try again !');
            }
            
            if($user_data['exp_time']<$exp_date){
                return back()->with('error_msg', 'Time Is Expired!');
            }
            
            $user=User::where('mobile', $user_data['phone'])->first();
            if($user){
                // SEC-07: Prevent staff/admin from logging in via frontend OTP
                if ($user->hasAnyRole(['admin', 'worker', 'vendor'])) {
                    session()->put('user_data',[]);
                    return back()->with('error_msg', 'Staff accounts must sign in at /admin');
                }
                
                Auth::loginUsingId($user->id);
                session()->put('user_data',[]);
                
                if(auth()->user()->type=='1'){
                    session()->put('cart',[]);
                }
                return redirect(url('/checkouts'))->with('success_msg', 'Login Success!');
            }else{
                $user=$this->createUser($user_data);
                if($user){
                    Auth::loginUsingId($user->id);
                    session()->put('user_data',[]);
                    return redirect(url('/checkouts'))->with('success_msg', 'Login Success!');
                }else{
                    
                    return back()->with('error_msg', 'Something Went Wrong . try again !');
                }
            }
} else if(request('button')=='Resend'){
            $phone = $user_data['phone'];
            $ip = request()->ip();
            
            // SEC-08: Rate limit OTP resend - 1 per minute, 5 per hour per phone+IP
            $otpKey = "otp_send:{$phone}:{$ip}";
            $minuteKey = $otpKey . ':minute';
            $hourKey = $otpKey . ':hour';
            
            if (Cache::has($minuteKey)) {
                return back()->with('error_msg', 'Please wait before requesting another OTP');
            }
            
            $hourCount = Cache::get($hourKey, 0);
            if ($hourCount >= 5) {
                return back()->with('error_msg', 'Too many OTP requests. Please try again later.');
            }
            
            $date = date('Y-m-d H:i:s');
            $date = strtotime($date);
            $date = strtotime("+3 minute", $date);
            $new_date = date('Y-m-d H:i:s', $date);
            $otp = random_int(100000, 999999);
            
            $user_data['exp_time'] = $new_date;
            $user_data['otp_verify'] = $otp;
            $user_data['otp_attempts'] = 0;
            session()->put('user_data', $user_data);
            
            $number = $user_data['phone'];
            $msg = 'Your One-Time PIN is ' . $otp . '. It will expire in 3 minutes.';
    
            $success = sendSMS($number, $msg);
            $res = json_decode($success);
            if (isset($res->Status) && ($res->Status == '0')) {
                Cache::put($minuteKey, 1, now()->addMinute());
                Cache::put($hourKey, $hourCount + 1, now()->addHour());
                return redirect()->route('front.getOpt')->with('status', 'PIN Is Send Check Your Phone');
            } else {
                return back()->with('error_msg', 'OTP Is Send Check Your Phone');
            }
            
            
        }
    }
  
  	private function createUser($data){
        $user=User::create([
            'mobile' => $data['phone'],
        ]);
        return $user;
    }
  
  


    public function register(Request $request){
		
        
    //     $number='01863651124';
    //   	$message='01863651124';
      
    //   	$res=SendSms($number,$message);
    //   	$status=json_decode($res)->status_code;
      
        $request->validate([
            'email' => 'nullable|email|unique:users',
            'username' => 'required|min:6|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        $url=session()->get('url');

        if (empty($url)) {
            $url= route('front.home');
        }

        Auth::login($user);

        return response()->json(['success'=>true,'msg'=>'Successfully Register !', 'url'=>route('front.home')]);
        
    }



    public function create(array $data)
    {

      return User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'username' => $data['username'] ?? null,
        'business_name' => $data['business_name'] ?? null,
        'email' => $data['email'] ?? null,
        'password' => Hash::make($data['password']),
        'status' => 1,
      ]);
    }

}
