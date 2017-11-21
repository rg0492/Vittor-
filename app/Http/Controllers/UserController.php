<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
         // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'first_name'       => 'required',
            'last_name'       => 'required',
            'email'      => 'required|email',
            'username' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user= User::find($id);
            $user->first_name       = Input::get('first_name');
            $user->last_name       = Input::get('last_name');
            $user->username       = Input::get('username');
            $user->email      = Input::get('email');
            if(Input::get('password')){

                $uer->password = bcrypt(Input::get('user_level'));
            }
            
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('user');
        }
    
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
          return redirect('home');
    }




    function search(Request $request){
    $users =     User::where('username', '=', $request->searchuser)
                    ->orWhere('email', '=', $request->searchuser)->paginate();
          return view('home')->with('users',$users);            
    }
}
