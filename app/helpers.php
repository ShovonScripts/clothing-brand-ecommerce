<?php

function dateFormate($date = null)
{
    $value = '';
    if ($date) {
        $value = date('M d Y', strtotime($date));
    }
    return $value;
}

/**
 * Generate a unique invoice number
 * Format: INV-YYYYMMDD-XXXXXXXX (timestamp + random)
 */
function generateInvoiceNo(): string
{
    $prefix = 'INV';
    $datePart = date('Ymd');
    $randomPart = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
    
    $invoiceNo = "{$prefix}-{$datePart}-{$randomPart}";
    
    // Ensure uniqueness (extremely unlikely collision, but check anyway)
    while (\App\Models\Order::where('invoice_no', $invoiceNo)->exists()) {
        $randomPart = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        $invoiceNo = "{$prefix}-{$datePart}-{$randomPart}";
    }
    
    return $invoiceNo;
}

function getImage($folder = null, $value = null)
{
    $url = asset('images/no_found.png');
    $path = public_path($folder . '/' . $value);
    if (!empty($folder) && (!empty($value))) {
        if (file_exists($path)) {
            $url = asset($folder . '/' . $value);
        }
    }
    return $url;
}

function deleteImage($folder = null, $file = null)
{
    if (!empty($folder) && !empty($file)) {
        $path = public_path($folder . '/' . $file);
        if (file_exists($path)) {
            unlink($path);
        }
    }
    return true;
}

function priceFormate($amount = 0)
{
    $currency = optional(\App\Models\Information::first())->currency;

    switch ($currency) {
        case 'Dollar':
            return '$' . number_format($amount, 0);
        case 'Euro':
            return "\u{20AC}" . number_format($amount, 0);
        case 'Rupee':
            return "\u{20B9}" . number_format($amount, 0);
        default:
            return "\u{09F3}" . number_format($amount, 0);
    }
}

function getRole()
{
    return auth()->user()->roles->pluck('name')[0] ?? '';
}

function getTotalCart()
{
    return count(session()->get('cart', []));
}

function getProductInfo($product)
{
    $price = ($product->after_discount > 0) ? $product->after_discount : $product->sell_price;
    $discount_amount = $product->dicount_amount;
    $old_price = $product->sell_price;

    return ['price' => $price, 'discount_amount' => $discount_amount, 'old_price' => $old_price];
}

function getSectionLists()
{
    return ['0' => 'None', '1' => 'Trending', '2' => 'Hot Deals', '3' => 'Recommended', '4' => 'Top Brand'];
}

function getOrderStatus($type = "")
{
    if ($type != "") {
        return ['' => 'All', 'pending' => 'Pending', 'processing' => 'Processing', 'on_the_way' => 'On The Way', 'on_hold' => 'On Hold', 'complete' => 'Complete', 'cancell' => 'Cancelled'];
    }

    return ['pending' => 'Pending', 'processing' => 'Processing', 'on_the_way' => 'On The Way', 'on_hold' => 'On Hold', 'complete' => 'Complete', 'cancell' => 'Cancelled'];
}

function getOrderMethod()
{
    return ['cash' => 'Cash', 'Card' => 'Card'];
}

/**
 * Send a transactional SMS through the configured gateway.
 *
 * Credentials come from config/services.php ('sms' block), which reads the
 * SMS_* keys in .env. If the gateway is not configured, nothing is sent and
 * the call returns false instead of leaking customer numbers to a third party.
 *
 * NOTE: the query parameter names below are gateway specific. Adjust them to
 * match whichever provider you sign up with.
 */
function SendSms($number = null, $message = null)
{
    $config = config('services.sms');

    if (empty($config['url']) || empty($config['apikey'])) {
        \Illuminate\Support\Facades\Log::warning('SendSms skipped: SMS gateway is not configured.');

        return false;
    }

    if (empty($number) || empty($message)) {
        return false;
    }

    try {
        $response = \Illuminate\Support\Facades\Http::timeout(10)->get($config['url'], [
            'apikey' => $config['apikey'],
            'secretkey' => $config['secretkey'],
            'callerID' => $config['sender_id'],
            'toUser' => $number,
            'messageContent' => $message,
        ]);

        if ($response->failed()) {
            // Never log the recipient number or the message body.
            \Illuminate\Support\Facades\Log::error('SendSms failed with HTTP status '.$response->status());

            return false;
        }

        return $response->body();
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('SendSms error: '.$e->getMessage());

        return false;
    }
}

function getPageName()
{
    return ['about' => 'About Us', 'return-policy' => 'Return Policy', 'privacy-policy' => 'Privacy Policy', 'term' => 'Term And Condition'];
}

function getCouponDiscount()
{
    $coupon = session()->get('coupon_discount');
    $type = session()->get('discount_type');

    $cart = session()->get('cart');
    $total = 0;
    $amount = 0;

    if ($cart) {
        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }

    if ($type == 'fixed') {
        $amount = $coupon;
    } else {
        $amount = (($total * $coupon) / 100);
    }

    if (($total > 0) and ($coupon)) {
        $amount = $amount;
    }

    return round($amount);
}

function full_name($user)
{
    if ($user) {
        return $user->first_name . ' ' . $user->last_name;
    }

    return '';
}

function BanglaText($index)
{
    $bangla_text = array(
        "cust_info" => "Customer Information",
        "instruction" => "Please enter your name, mobile number and full address to confirm your order.",
        "name" => "Your Name",
        "placeholder_name" => "Enter your full name",
        "mobile" => "Your Mobile Number",
        "placeholder_mobile" => "Enter your mobile number",
        "address" => "Your Full Address",
        "placeholder_address" => "House, road, area, city",
        "delivery_zone" => "Select delivery area",
        "confirm_order" => "Confirm your order",
        "alert" => "* Please check your information before confirming the order.",
        "order_information" => "Order Information",
        "order" => "Place Order",
        "cart" => "Shopping Cart",
        "land_instruction" => "Please enter your name, mobile number and full address to confirm your order.",
    );
    return $bangla_text[$index] ?? '';
}
