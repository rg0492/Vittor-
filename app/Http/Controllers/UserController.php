<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditRequest;
Use paginate;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
      $users = User::paginate();
    return view('home')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return  view('create_new_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $uRequest)
    {
        $user = User::create([
            'first_name' => $uRequest->first_name,
            'last_name' => $uRequest->last_name,
            'username' => $uRequest->username,
            'password' => bcrypt($uRequest->password),
            'email' => $uRequest->email,
            'gender' => $uRequest->gender

        ]);
        session::flash('message','User '.$user->first_name.' has been created');
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 

    $user = User::find($id);
    return view('editUser')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $UErequest, $id)
    {
    
            $user= User::find($id);
            $user->first_name       = $UErequest->first_name;
            $user->last_name       = $UErequest->last_name;
            $user->username       = $UErequest->username;
            $user->email      = $UErequest->email;
            $user->gender      = $UErequest->gender;

            if(Input::get('password')){

                $user->password = bcrypt($UErequest->password);
            }
            
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('user');
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session::flash('message','User has been deleted');
          return redirect('/user');
    }




    function search(Request $request){
    $users =     User::where('username', '=', $request->searchuser)
                    ->orWhere('email', '=', $request->searchuser)->paginate();
           session::flash('message','Search result for  '.$request->searchuser.'');
          return view('home')->with('users',$users);            
    }
}
