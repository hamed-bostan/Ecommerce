<?php
//
//namespace App\Http\Controllers\Traits;
//
//
//use Illuminate\Support\Facades\Request;
//use Illuminate\Support\Facades\Validator;
//
//trait ValidationController
//{
//
//    public function hamed(Request $request)
//    {
//        $validate = Validator::make($request->all(),[
//            'email'    => 'required',
//            'password' => 'required',
//        ]);
//
//
//        if ($validate->fails()) {
//            return response()->json([
//                'message' => __('fail.invalid_message')
//            ]);
//        }
//
//
//        else{
//            return response()->json([
//                'message'=>'success hamed'
//            ]);
//        }
//    }
//
//}
