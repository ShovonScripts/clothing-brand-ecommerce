<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserAccountDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();

        return view('frontend.dashboard.account_details', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id != auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // SEC-06: Users can only update their own profile
        if ($id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();

        $data = $request->validate([
            'mobile' => 'nullable|numeric|digits:11|regex:/(01)[0-9]{9}/|unique:users,mobile,'.$user->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
        ]);

        
        if (!empty($request->password)) {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);

            $old_password=$user->password;

            if (Hash::check($request->old_password, $old_password)) {
                if (!Hash::check($request->password, $old_password)) {
                    $data['password'] = Hash::make($request->password);
                    $user->update($data);
                    return response()->json(['success'=>true,'msg'=>'User Password Successfully Updated!']);
                } else {
                    return response()->json(['success'=>false,'msg'=>'new password can not be the old password !!']);   
                }
            }else {
                return response()->json(['success'=>false,'msg'=>'old password doesnt matched']);
            }
        }else{
            $user->update($data);
            return response()->json(['success'=>true,'msg'=>'User  Successfully Updated!']);

        }

        
        

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != auth()->id()) {
            abort(403, 'Unauthorized');
        }
        // Users cannot delete their own account via this route
        abort(403, 'Account deletion not allowed');
    }
}
