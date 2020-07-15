<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Validator;
 use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  private function apiResponse($status,$message,$data){
    $response = [
        'status' => 1,
        'message' => 'sucess',
        'data' => $data,
    ];
    return response()->json($response);
  }

   function responseJson($status,$message,$data){
    $response = [
        'status' => 1,
        'message' => 'sucess',
        'data' => $data,
    ];
    return response()->json($response);
  }


  function str_random($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }


 public function register(Request $request){
    $validator = validator()->make($request->all(),[
          'phone' => 'required',
          'name' => 'required',
          'email' => 'required',
          'date_of_birth' => 'required',
          'city_id' => 'required',
          'blood_type_id' => 'required',
          'city_id' => 'required',
          'password' => 'required|confirmed',
    ]);

    if($validator->fails()){

      return $this->apiResponse(0,$validator->errors()->first(),$validator->errors());
    }

    $request->merge(['password' => bcrypt($request->password)]);
    $clientregister = Client::create($request->all());
    $clientregister->api_token = $this->str_random(60);
    $clientregister->save();
  /*  $clientregister->cities()->attach($request->city_id);
    $bloodType = BloodType::where('name',$request->blood_type_id)->first();
    $clientregister->cities()->attach($request->city_id);*/
    return $this->apiResponse(1,'تم التسجيل',[
    'client' =>  $clientregister,
    'api_token' => $clientregister->api_token
  ]);
 }


public function login(Request $request){
  $validator = validator()->make($request->all(),[
        'phone' => 'required',
        'password' => 'required',
  ]);

  if($validator->fails()){
    return $this->apiResponse(0,$validator->errors()->first(),$validator->errors());
  }

$client = Client::where('phone',$request->phone)->first();
if($client){

  if(Hash::check($request->password,$client->password)){
    return $this->responseJson(1,"تم تسجيل الدخول بنجاح",[
      'client' => $client,
      'api_token' => $client->api_token
    ]);
  }
  else{
    return $this->responseJson(0,"بيانات الدخول غير صحيحة",$client);

  }
}
else{
  return $this->responseJson(0,"بيانات الدخول غير صحيحة",$client);

}
}




public function resetPassword(Request $request){
  $validator = validator()->make($request->all(),[
        'phone' => 'required',
        //'password' => 'required',
  ]);

  if($validator->fails()){
    return $this->apiResponse(0,$validator->errors()->first(),$validator->errors());
  }

$user = Client::where('phone',$request->phone)->first();
if($user){
  $code = rand(1111,9999);
  $update = $user->update(['pin_code' => $code]);
  if($update){

    Mail::to($user->email)
      ->bcc("salmahossam639@gmail.com")
      ->send(new ResetPassword($code));

    return $this->responseJson(1,"برجاء فحص هاتفك",
    [
      'pin_code_for_test' => $code,
      'mail_fails' => Mail::failures(),
      'email' => $client->email,
    ]);

  }
  else{
    return $this->responseJson(0,"برجاء المحاولة مرة اخرى",$client);

  }
}
else{
  return $this->responseJson(0,"لا يوجد حساب مرتبط بهذا الرقم",$client);

}
}
/*view and modify*/
public function profile(Request $request){
/*  $request->user();//Just if there is middleware
  auth()->quard('api')->user()->name;*/
    $validation = validator()->make($request->all(),[
    'password' => 'confirmed',
    'email'    => Rule::unique('clients')->ignore($request->user()->id),
    'phone'    => Rule::unique('clients')->ignore($request->user()->id),
  ]);

  if($validation->false){
    $data = $validation->error();
    return responseJson(0,$validation->errors()->first(),$data);
  }

  $loginUser = $request->user();
  $loginUser->update($request->all());
  if($request->has('password')){
    $liginUser->password = bcrypt($request->password);
  }

  $loginUser->save();
  if($request->has('city_id')){
    $loginUser->cities()->detach($request->city_id);
    $loginUser->cities()->attach($request->city_id);
  }

  if($request->has('blood_type_id')){
    $bloodType = BloodType::where('name',$request->blood_type_id)->first();
    $loginUser->bloodTypes()->detach($bloodType->id);
    $loginUser->bloodTypes()->attach($bloodType>id);
  }
}
}
