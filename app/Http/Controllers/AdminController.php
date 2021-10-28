<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\AddMissingPerson;
use App\Facilities;
use App\AddRoom;
use App\AddTrusties;
use App\AddShelterRequest;
use App\ApproveShelter;

use App\UserFacilitiies;
use Redirect;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function admin_home()
    {
        return view('adminhome');
    }

    public function room_list()
    {
        $list = AddRoom::paginate(10);
        return view('admin.addroom', compact('list'));
    }


    public function room_save(Request $request)
    {
        $new = new AddRoom();
        $new->name = $request->name;
        $new->save();
        return redirect()->back();
    }


    public function room_delete($id)
    {
        $delete = AddRoom::where('id', $id)->delete();
        return redirect()->back();
    }


    public function volunter_list(Request $request)
    {
        $list = User::where('status', 0)->paginate(10);
        if($request->search){
            $list = User::where('status', 0)->where('name', 'like', '%' . $request->search . '%')->paginate(10);

        }
        return view('admin.volunterlist', compact('list'));
    }


    public function add_volunter()
    {
        return view('admin.addvolunter');
    }

    public function volunter_save(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:50',
                'f_name' => 'required|string|max:50',
                'city' => 'required|string|max:50',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $std_id = User::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'f_name' => $request->f_name,
                'city' => $request->city,
                'password' => bcrypt($request->password),

            ]);

            $id = User::find($std_id);
            $role = DB::table('roles')->where('name', 'Volunter')->first();
            $id->roles()->attach($role->id);
            return redirect()->route('volunter-list');
        } catch (\Exception $e) {

            return Redirect::back()->withErrors(['This user already exist']);
        }
    }


    public function volunter_edit($id)
    {
        $edit = User::where('id', $id)->first();
        return view('admin.editvolunter', compact('edit'));
    }


    /** volunteer update */
    public function volunter_update(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'f_name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'city' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'email' => 'required|email',
        ]);

        $update = User::where('id', $request->id)->first();
        // dd($update);

        $update->name = $request->name;
        $update->f_name = $request->f_name;
        $update->contact = $request->contact;
        $update->city = $request->city;
        $update->email = $request->email;
        $update->save();
        return redirect()->route('volunter-list');
    }

    public function volunter_delete($id)
    {
        $delete = User::where('id', $id)->delete();
        return redirect()->back();
    }


    public function missing_person_list(Request $request)
    {
        $missing_list = AddMissingPerson::paginate(10);
        if($request->search){
            $missing_list = AddMissingPerson::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }

        return view('admin.missigperson_list', compact('missing_list'));
    }


    public function add_missing_person()
    {
        return view('admin.addmissing_person');
    }

    public function missing_save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'f_name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
        ]);


        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . "." . $image->extension();
            $imagePath = public_path() . '/images/';

            $image->move($imagePath, $imageName);
            $imageDbPath = $imageName;

        }


        $new = new AddMissingPerson();
        $new->name = $request->name;
        $new->f_name = $request->f_name;
        $new->contact = $request->contact;
        $new->city = $request->city;
        $new->cnic = $request->cnic;
        $new->image = $imageDbPath;
        $new->save();
        if ($new) {
            return redirect()->route('missing-person-list')->with('success', 'Missing person added successfully');;
        }else{
            return Redirect::back()->withErrors(['Some thing went wrong']);

        }
    }

    public function person_delete($id)
    {
        $delete = AddMissingPerson::where('id', $id)->delete();
        return redirect()->back();
    }


    public function trust_affair()
    {
        return view('admin.trustaffair');
    }

    public function facilities_list()
    {
        $list = Facilities::paginate(10);
        return view('admin.facilities_list', compact('list'));
    }

    public function facalities_save(Request $request)
    {

        $request->validate([
            'facalities' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
        ]);

        $new = new Facilities();
        $new->facilities_name = $request->facalities;
        $new->save();
        return redirect()->back();
    }

    public function facilites_delete($id)
    {
        $delete = Facilities::where('id', $id)->delete();
        return redirect()->back();
    }


    public function trusties_list(Request $request)
    {
        $list = AddTrusties::paginate(10);
        if($request->search){
            $list = AddTrusties::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }

        return view('admin.trustieslist', compact('list'));
    }

    public function trusties_save(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'f_name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'email' => 'required|email',
            'contact' => 'required',
            'city' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'amount' => 'required',
        ]);
        $new = new AddTrusties();
        $new->name = $request->name;
        $new->f_name = $request->f_name;
        $new->email = $request->email;
        $new->contact = $request->contact;
        $new->city = $request->city;
        $new->amount = $request->amount;
        $new->save();
        return redirect()->back();
    }


    public function trusties_delete($id)
    {
        $delete = AddTrusties::where('id', $id)->delete();
        return redirect()->back();
    }


    public function admin_shelter(Request $request)
    {
        $list = AddShelterRequest::with('user_facility')->paginate(10);

        if($request->search){
            $list = AddShelterRequest::with('user_facility')->where('name', 'like', '%' . $request->search . '%')->paginate(10);

        }
        return view('admin.adminshelterlist', compact('list'));
    }

    public function delete_shelter_request($id){
        if ($id) {
            $delete = AddShelterRequest::where('id', $id)->delete();
            if ($delete){
                return redirect()->back()->with('success', 'Shelter request deleted successfully');
            }else{
                return Redirect::back()->withErrors(['Request Id id required']);

            }
        }
    }

    public function allote_shelter($id)
    {
        $room = AddRoom::get();
        $shelter_rooms = DB::table('shelter_homes')->where('remaining_rooms', '>=', '1')->get();
        $facalities = Facilities::get();
        $shelter = AddShelterRequest::where('id', $id)->first();
//        $selectedroom = ApproveShelter::where('user_id', $id)->first();

        $selectedHome = DB::table('approve_shelter')->where('user_id', $id)->first();

        $user_facilities = UserFacilitiies::where('user_id', $id)->first();
        $user_slected_facilities = [];
        if ($user_facilities) {
            $user_slected_facilities = unserialize($user_facilities->facility_id);
        }

        return view('admin.shelter_approve', compact('shelter', 'selectedHome', 'room', 'facalities', 'user_slected_facilities', 'shelter_rooms'));
    }


    public function approve_shelter_save(Request $request)
    {
        $request->validate([
            'facilities' => 'required',
        ]);
        $approve = ApproveShelter::where('user_id', $request->id)->first();

        if (empty($approve)) {
            $approve = new ApproveShelter();
        }

        $approve->home_id = $request->home_id;
        $approve->user_id = $request->id;
        $approve->status = 1;
        $result = $approve->save();

        if ($result){
            /** calculating the remaining rooms in the shelter rooms */
            $room = DB::table('shelter_homes')->where('id', $request->home_id)->pluck('remaining_rooms')->first();
            $remainingRooms = $room - 1;
            $update = DB::table('shelter_homes')->where('id', $request->home_id)->update([
                'remaining_rooms' => $remainingRooms,
            ]);
        }


        $faclity = UserFacilitiies::where('user_id', $request->id)->first();
        if (empty($faclity)) {
            $faclity = new UserFacilitiies();
        }

        $faclity->user_id = $request->id;
        $faclity->facility_id = serialize($request->facilities);
        $faclity->save();

        return redirect()->route('admin-shelter-list');
    }

    /** Shelter home view function */
    public function admin_shelter_home(Request $request)
    {
        $data = DB::table('shelter_homes')->get();

        if($request->search){
            $data = DB::table('shelter_homes')->where('name', 'like', '%' . $request->search . '%')->paginate(10);
        }

        return view('admin.shelter_home', compact('data'));
    }

    /** save shelter home request */
    public function admin_shelter_home_save(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'contact' => 'required',
                'city' => 'required|string|max:50',
                'address' => 'required|max:150',
                'total_rooms' => 'required',
            ]);

            $result = DB::table('shelter_homes')->insert([
                'name' => $request->name,
                'contact' => "92".$request->contact,
                'city' => $request->city,
                'address' => $request->address,
                'total_rooms' => $request->total_rooms,
                'remaining_rooms' => $request->total_rooms,

            ]);
            if ($result) {
                return redirect()->back()->with('success', 'New Shelter home address added successfully');
            } else {
                return Redirect::back()->withErrors(['The shelter home not saved']);
            }

        } catch (\Exception $e) {

            return Redirect::back()->withErrors(['Something went wrong']);
        }

    }

    /** shelter home delete */
    public function shelter_home_delete($id)
    {
        if ($id) {
            $delete = DB::table('shelter_homes')->where('id', $id)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Shelter home deleted successfully');
            } else {
                return Redirect::back()->withErrors(['Something went wrong']);
            }
        }else{
            return Redirect::back()->withErrors(['Request Id id required']);
        }

    }

    /** shelter home edit */
    public function home_edit(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'contact' => 'required|max:100',
            'city' => 'required|max:100',
            'address' => 'required|max:255',
            'total_rooms' => 'required|max:255',
        ]);

        if ($request->remaining_rooms > $request->total_rooms){
            return Redirect::back()->withErrors(['Remaining Space can not be greater than Total space']);

        }

        $update = DB::table('shelter_homes')->where('id', $request->id)->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'city' => $request->city,
            'address' => $request->address,
            'total_rooms' =>$request->total_rooms,
            'remaining_rooms' =>$request->remaining_rooms
        ]);

        if ($update){
            return redirect()->back()->with('success', 'Shelter home updated successfully');
        }else{
            return Redirect::back()->withErrors(['Something went wrong']);

        }
    }

    public function homless()
    {
        $list = AddShelterRequest::with('user_facility.room', 'user_facilities')->get();
        return view('admin.homeless', compact('list'));
    }

    public function password_requests(){
        $requests = DB::table('re_generate_password')->where('password', 'no')->get();
        $count = count($requests);
        return view('admin.password_requests', compact('requests', 'count'));
    }

    public function generate_password(Request $request){
        try {
            $re_generate_password = DB::table('re_generate_password')->where('email', $request->email)->orderBy('id','desc')->take(1)->update([
                'password' => $request->password,
            ]);

                $update_user = User::where('email', $request->email)->update([
                    'password' => bcrypt($request->password),
                    ]);
            if ($update_user){
                return redirect()->back()->with('success', 'Password updated successfully');
            }else{
                return Redirect::back()->withErrors(['The password is not updated']);

            }

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['Something went wrong']);
        }
    }
    
    public function pass_request_delete($id){
        
        if($id){
            $result = DB::table('re_generate_password')->where('id', $id)->delete();
            if($result){
                        return redirect()->back()->with('success', 'Request deleted successfully');

            }else{
                 return Redirect::back()->withErrors(['Something went wrong']);
            }
            
        }else{
             return Redirect::back()->withErrors(['Id Can not be null']);

        }
        
    }

}
