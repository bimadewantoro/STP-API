<?php

namespace App\Http\Controllers;

use Hash;
use File;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserProfileRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $user=auth()->user();
        }catch(JWTException $th){
            throw $th;
        }
         return $this->response->item($user)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pt'=>'required|min:3|max:100',
            'bidang'=>'required|min:2|max:100',
            'email_pt'=>'required|min:2|max:100',
            'no_pt'=>'required|min:2|max:15',
            'description'=>'required|min:2|max:200',
            'profile_photo'=>'nullable|image|mimes:jpg,bmp,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()]);
        } 

        try{
            if(! $user = auth()->user()){
                throw new NotFoundHttpException('Profile not found');
            }

            $user->userProfile()->updateOrCreate(['user_id' => $user->id], [
                'nama_pt'=>$request->nama_pt,
                'bidang'=>$request->bidang,
                'email_pt'=>$request->email_pt,
                'no_pt'=>$request->no_pt,
                'description'=>$request->description,
                'profile_photo'=>$image_name,
            ]);
        } catch (JWTException $th){
            throw $th;
        }

        $response = [
            'message'=> 'User Created Successfully',
            'id'=>$user->id,
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
       // $userProfile = UserProfile::all();
        //return view('users.create', compact('userProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserProfileRequest  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        try {
            if(! $user = auth()->user()){
                throw new NotFoundHttpException('Profile not found');
            }

            if(!empty($request->nama_pt)){
                $validator = Validator::make($request->all(), [
                    'nama_pt'=>'required|min:3|max:100',
                ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors'=>$validator->errors()]);
                } 
            $user->userProfile()->updateOrCreate(['user_id' => $user->id], [
                 'nama_pt'=>$request->nama_pt,
                ]);
            }
    
            $response = [
                'message'=> 'User Created Successfully',
                'id'=> $user->id,
            ];
            return response()->json($response, 200);
        }
    }

    /*public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pt'=>'required|min:3|max:100',
            'bidang'=>'required|min:2|max:100',
            'email_pt'=>'required|min:2|max:100',
            'no_pt'=>'required|min:2|max:15',
            'description'=>'required|min:2|max:200',
            'profile_photo'=>'nullable|image|mimes:jpg,bmp,png'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        } 

        $user=$request->user();

        if($request->hasFile('profile_photo')){
            if($user->profile_photo){
                $old_path=public_path().'/uploads/profile_images/'.$user->profile_photo;
                if(File::exists($old_path)){
                    File::delete($old_path);
                }
            }

            $image_name='profile-image-'.time().'.'.$request->profile_photo->extension();
            $request->profile_photo->move(public_path('/uploads/profile_images'),$image_name);
        }else{
            $image_name=$user->profile_photo;
        }


        $user->update([
            'nama_pt'=>$request->nama_pt,
            'bidang'=>$request->bidang,
            'email_pt'=>$request->email_pt,
            'no_pt'=>$request->no_pt,
            'description'=>$request->description,
            'profile_photo'=>$image_name
        ]);

        return response()->json([
            'message'=>'Profile successfully updated',
        ],200);


    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      //
    }
}
    }