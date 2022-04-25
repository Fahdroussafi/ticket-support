<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class CommentsController extends Controller
{
    // post comment
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
    
    $comment = Comment::create([
			'ticket_id' => $request->input('ticket_id'),
			'user_id'   => Auth::user()->id,
			'comment'   => $request->input('comment'),
		]);
		// when the ticket is closed , the user can no longer comment on the ticket.
		// if($comment->ticket->is_resolved == 'Closed'){
		// 	return redirect()->back()->with('Closed', 'You cannot comment on a closed ticket.');
		// }


		// // This will create a log debug message if the User is not the Ticket owner.
		if ($comment->ticket->user->id !== Auth::user()->id) {

			Log::debug('Mail would be sent to ' . $comment->ticket->user->email . ' that their ticket has received a reply.');
		}

		return redirect()->back()->with("comment", "Your comment has be submitted.");
	}
}

