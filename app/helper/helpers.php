<?php
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Stripe\Stripe;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\EmailCron;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FileObj;

function getLatitudeLongitude($address)
{
    $address = urlencode($address);
    $url = 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyCcbWlKpbS5BOqrktc7iW0CCgKrQkvG8zc&address=' . $address . '&sensor=false';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable host verification
    $geocode = curl_exec($ch);

    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return false;
    }

    curl_close($ch);

    $output = json_decode($geocode);
    if ($output->status !== 'OK') {
        return false;
    }

    $lat = $output->results[0]->geometry->location->lat;
    $long = $output->results[0]->geometry->location->lng;

    $locationArray['lat'] = "$lat";
    $locationArray['long'] = "$long";
    return $locationArray;
}
function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } elseif ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}
function sendEmail($toEmail,$subject,$path,$data='')
{
    $to_email=$toEmail;
    //$to_email='dawngill08@gmail.com';
    $from_email = env('MAIL_FROM_ADDRESS');
    $subject = $subject;
    // $cc = env('CCEMAIL');
    $sendEmail=env('SEND_EMAIL');
    if($sendEmail == '1')
        {
            Mail::send("$path", compact('data'), function ($message) use ($to_email, $from_email, $subject) {
                $message->to($to_email)
                    ->subject($subject);
                $message->from($from_email);
            });    

        }
}
function makeTwoLetter($str)
{
    $charArr = explode(' ', $str);
    $firstNameInitial = Str::limit($charArr[0], 1, '');
    
    // Get the first letter of the last name
    $lastNameInitial = Str::limit($charArr[count($charArr) - 1], 1, '');
    
    // Combine the initials into a single string
    $initials = $firstNameInitial . $lastNameInitial;
    return  strtoupper($initials) ;
}
function sendSMS($to, $message)
{
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
    
    $client = new Client($sid, $token);

    $client=$client->messages->create(
        $to,
        [
            'from' => $twilioPhoneNumber,
            'body' => $message,
        ]
    );
    return $client->status;
}

function createPaymentLinkForEmail($data)
{
    Stripe::$verifySslCerts = false;

    Stripe::setApiKey(env('STRIPE_SECRET'));
    // Set the price and currency for your product
    $price = intval($data['price'] * 100); // $10.00 (amount in cents)
    $currency = 'usd';
    $eventId=$data['event_id'];
    $eventName=$data['event_name'];
    $name=$data['name'];
    $email=$data['email'];
    
    $paymentLink = \Stripe\Checkout\Session::create([
        'success_url' => route('public-event-success', ['name' => $data['name'], 'eventId' => $data['event_id'], 'email' => $data['email'], 'price' => $data['price']]), // Redirect URL after successful payment
        'cancel_url' => route('public-event-cancel', ['eventId' => $data['event_id']]), // Redirect URL if payment is canceled
        'payment_method_types' => ['card','paypal'],
        'customer_email' => $email,
        'locale' => 'en',  // Set the desired language code (e.g., 'de' for German)
        'line_items' => [
            [
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $price,
                    'product_data' => [
                        'name' => $eventName, 
                    ],
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
    ]);                                                              

    return $paymentLink->url;
}

function generateOTP($length = 6, $expirationMinutes = 2)
{
    $otp = Str::random($length);

    // Calculate expiration timestamp
    $expiresAt = Carbon::now()->addMinutes($expirationMinutes);
    $user = Auth::user();
    
    $user->update([
        'otp' =>  $otp, 
        'expires_at' =>  $expiresAt, 
    ]);
    $data['name']=$user->name;
    $data['email']=$user->email;
    $data['otp']=$otp;
    sendEmail($user->email,'GIVR 2FA','template/template_otp',$data);
    Session::put('user_2fa', 'no');
    // Store the OTP and its expiration timestamp
    return true;
}

function saveEmailCron($toEmail,$subject,$body)
{
    EmailCron::create([
        'user_id' => isset(Auth::user()->id) ? Auth::user()->id : 0,
        'to_email' => $toEmail,
        'subject' => $subject,
        'body' => $body,
    ]);
}

function uploadImageWithCompresserUpdate($request,$nameInput,$columName,$obj,$pathFile)
{
    if ($request->hasFile($nameInput)) {

        $validator = $request->validate([
            $nameInput => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],["$nameInput.max" => "The $nameInput field must not be greater than 2 MB."]);
        try {
            if($validator->fails()){
                return $validator;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        
        $previousPic = $obj->$columName;
        if ($previousPic != 'uploads/profile/blank.png') {
            FileObj::delete($previousPic);
        }

        $userId=Auth::user()->id;
        $destinationPath = $pathFile . $userId;
        $file = $request->file($nameInput);
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $img=Image::make($file)->orientate();
        if(!FileObj::isDirectory($destinationPath)){
            FileObj::makeDirectory($destinationPath, 0755, true, true);
        }
        $img->save(public_path($destinationPath."/".$filename),20);
        // $size = $file->getSize();
        // $file->move($destinationPath, $filename);
        $obj->$columName= $pathFile . $userId . "/" . $filename;

    }
}
function uploadImageWithCompresserAdd($request,$nameInput,$pathFile)
{
   
    if ($request->hasFile($nameInput)) {
        $validator = $request->validate([
            $nameInput => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],["$nameInput.max" => "The $nameInput field must not be greater than 2 MB."]);
        try {
            if($validator->fails()){
                return $validator;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $userId = Auth::user()->id;
        $destinationPath = $pathFile . $userId;
        $file = $request->file($nameInput);
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $img=Image::make($file)->orientate();
        if(!FileObj::isDirectory($destinationPath)){
            FileObj::makeDirectory($destinationPath, 0755, true, true);
        }
        $img->save(public_path($destinationPath."/".$filename),20);
        // $size = $file->getSize();
        // $file->move($destinationPath, $filename);
       return $pathFile . $userId . "/" . $filename;
    }
    return 'uploads/profile/blank.png';
}

function addFile($request,$nameInput,$pathFile)
{
    if ($request->hasFile($nameInput)) {
       
        $userId = Auth::user()->id;
        $destinationPath = base_path('public/'.$pathFile.$userId);
        $file = $request->file($nameInput);
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $size = $file->getSize();
        $file->move($destinationPath, $filename);
       return $pathFile . $userId . "/" . $filename;
    }
    return 'uploads/profile/blank.png';
}
function updateFile($request,$nameInput,$columName,$obj,$pathFile) 
{
    if ($request->hasFile($nameInput)) {

        $previousPic = $obj->$columName;
        if ($previousPic != 'uploads/profile/blank.png') {
            FileObj::delete($previousPic);
        }

        $userId=Auth::user()->id;
        $destinationPath = base_path('public/'.$pathFile.$userId);
        $file = $request->file($nameInput);
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $size = $file->getSize();
        $file->move($destinationPath, $filename);
        $obj->$columName= $pathFile . $userId . "/" . $filename;
    }
}