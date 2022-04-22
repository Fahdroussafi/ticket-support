<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UsersController extends Controller

{

     /* This ensures that all functions in TicketsController go through the 'auth' middleware. */

      public function __construct()
      {
          $this->middleware('auth');
      }

     /* This will retrieve the current users */

	public function index() {

        $users = User::paginate(10);
        

        return view('users.users', compact('users'));
        
	}

    // this will delete the user from the database
    public function destroy($id) {

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with("status", "User has been deleted."); 
    }
};
