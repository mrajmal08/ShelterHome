<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Services\PayUService\Exception;

class LoginApiController extends Controller
{
    public $successStatus = 200;

    public function login()
    {

        //check if user is authenticat or not

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $user_id = $user->id;

            // return response()->json(['message' => 'success', 'user_id' => $user_id, 'token' => $success], $this-> successStatus);

            return response()->json(['message' => 'success', 'user_id' => $user_id, 'token' => $success, 'status' => '200']);

        } else {
            return response()->json(['message' => 'error', 'status' => '401']);
        }
    }

    /** shelter request API */
    public function shelterRequest(Request $request)
    {
        try {

            if ($request->user_id) {

                if (empty($request->name) || empty($request->father_name)) {

                    return response()->json(['error' => 'Name, Father Name can not be empty'], 401);

                }
                if (empty($request->city)) {

                    return response()->json(['error' => 'City can not be empty'], 401);

                }
            

                if ($request->file('image')) {
                    $image = $request->file('image');
                    $imageName = time() . "." . $image->extension();
                    $imagePath = public_path() . '/images/';
                    $image->move($imagePath, $imageName);
                    $imageDbPath = $imageName;

                }
                $restult = DB::table('shelter_request')->insert([
                    'name' => $request->name,
                    'f_name' => $request->father_name,
                    'contact' => $request->contact,
                    'cnic' => $request->cnic,
                    'city' => $request->city,
                    'user_id' => $request->user_id,
                    'image' => $imageDbPath,
                ]);
                if ($restult) {
                    /** check where the room is available from shelter homes */
                    
                     $list = DB::table('shelter_homes')->where('city', $request->city)->where('remaining_rooms', '>=', '1')->first();
                        if ($list) {
                            $data = $list;
                
                        }else{
                
                            $data = DB::table('shelter_homes')->where('remaining_rooms', '>=', '1')->first();
                        }
              
                        return response()->json(['success' => 'Shelter info has added successfully', 'Shelter Home details' => $data], 200);
                   
                } else {
                    return response()->json(['error' => 'The data is not created, Something went wrong'], 401);

                }
            } else {
                return response()->json(['error' => 'User id can not be empty'], 401);

            }

        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /** get all shelter requests related to user */
    public function getRequests($id)
    {
        if ($id) {
            $data = DB::table('shelter_request')->where('user_id', $id)->get();

            //checking of the user have data or not
            if (count($data) > 0) {
                return response()->json(['message' => 'successfully done', 'data' => $data], 200);

            } else {
                return response()->json(['message' => 'This User dont have any data'], 401);
            }
        } else {
            return response()->json(['error' => 'User id cant be null'], 401);

        }
    }

    /** Request Password reset function */
    public function requestPasswordReset(Request $request){

        try {
            if ($request->email) {
                $user = User::where('email', $request->input('email'))->first();
                if ($user) {
                    DB::table('re_generate_password')->insert([
                        'email' => $request->email,
                    ]);

                    return response()->json(['success' => 'Your Re-Generate-Password Request Has Been Sent To Admin'], 200);

                } else {
                    return response()->json(['error' => 'This Email does not exist in the database'], 401);
                }
            }else{
                return response()->json(['error' => 'Email can not be empty'], 401);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

}
