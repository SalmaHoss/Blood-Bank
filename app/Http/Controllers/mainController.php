<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Category;                    //here?
use App\Models\City;

use App\Models\Setting;
use App\Models\BloodType;
use App\Models\Contact;
class mainController extends Controller
{
    //
    private function apiResponse($status,$message,$data){
      $response = [
          'status' => 1,
          'message' => 'sucess',
          'data' => $data,
      ];
      return response()->json($response);
    }


    function governorates(){
     $governorates = Governorate::paginate(10);

     return $this->apiResponse( 1, 'success',$governorates);

    }


        function posts(){
         $posts = Post::paginate(10);
         return $this->apiResponse( 1, 'success',$posts);

       }


    function categories(){
     $categories = Category::paginate(10);

     return $this->apiResponse( 1, 'success',$categories);

    }

  /*
    We modifiied it because we need to display those cities of this governorate
    function cities(){
    $cities  = City::all();

    return $this->apiResponse(1,'success', $cities);

  }*/
      function cities(Request $request){
        $cities  = City::where('governorate_id',$request->governorate_id)->get();

        return $this->apiResponse(1,'success', $cities);
        }

/*
      function posts(Request $request){
        $posts = Post::where('category_id',$request->category_id)->get();
        return $this->apiResponse(1,'success',$posts );
      }
*/

    function Settings(/*Request $request*/){
        $settings = Setting::all();                       //It is the same for all

        return $this->apiResponse(1,'success',$settings );
      }

    function bloodTypes(/*Request $request*/){
        $bloodtypes = BloodType::all();                       //It is the same for all

        return $this->apiResponse(1,'success',$bloodtypes );
      }


      function contacts(Request $request){
         $validator = validator()->make($request->all(),[
                'title' => 'required',
                'message' => 'required',
                'phone' => 'required',
                'name' => 'required'
          ]);

          if($validator->fails()){
            return $this->apiResponse(0,$validator->error()->first(),$validator->errors());
          }

        $contacts = Contact::create($request->all());
      //  $contacts->api_token = str_random(60);       //why
        $contacts->save();
        return $this->apiResponse(1,'تم ارسال طلبك بنجاح.',$contacts);
      /*  return $request->all();*/
      }
}
