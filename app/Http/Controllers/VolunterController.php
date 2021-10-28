<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddShelterRequest;
use Redirect;
use DB;
use Validator;

class VolunterController extends Controller
{
    public function volunter_home()
    {
        return view('volunterhome');
    }


    public function volunter_shelter_list()
    {
        $user_id = auth()->user()->id;
        $list = AddShelterRequest::where('user_id', $user_id)->paginate(10);

        return view('volunter.shelter_request', compact('list', 'user_id'));
    }

    public function shelter_request_save(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:50',
            'f_name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
        ],
            [
                'name.required' => 'Name should be in string format',
                'f_name.required' => 'Father Name should be in string format'


            ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . "." . $image->extension();
            $imagePath = public_path() . '/images/';
            $image->move($imagePath, $imageName);
            $imageDbPath = $imageName;

        }

        $new = new AddShelterRequest();
        $new->name = $request->name;
        $new->f_name = $request->f_name;
        $new->contact = "92".$request->contact;
        $new->city = $request->city;
        $new->cnic = $request->cnic;
        $new->user_id = $request->user_id;
        $new->image = $imageDbPath;
        $new->save();

        /** check where the room is available from shelter homes */
        $list = DB::table('shelter_homes')->where('city', $request->city)->where('remaining_rooms', '>=', '1')->first();
        if ($list) {
            $data = $list;

        }else{

            $data = DB::table('shelter_homes')->where('remaining_rooms', '>=', '1')->first();
        }

        $name = $data->name;
        $contact = $data->contact;
        $city = $data->city;
        $address = $data->address;

        if ($data) {
            return redirect()->back()->with('success', "Please take this user to this shelter home " . '<br>' . "
             Shelter Home Name: $name " . '<br>' . "
             Shelter Home Contact: $contact " . '<br>' . "
             Shelter Home City: $city " . '<br>' . "
             Shelter Home Address: $address " . '<br>' . "
             ");

        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }



        return redirect()->back();
    }


    public function shelter_delete($id)
    {
        if ($id) {
            $delete = AddShelterRequest::where('id', $id)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Your data deleted successfully');
            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        } else {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }
}
