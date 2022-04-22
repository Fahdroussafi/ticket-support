<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Status;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TicketsController extends Controller
{
    /* This ensures that all functions in TicketsController go through the 'auth' middleware. */
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    // public function index()
    // {
    //     $tickets = Ticket::paginate(10);
    //     return view ('tickets.index', compact('tickets'));
    // }

    /* This will pass all categories to a view. */
    public function create()
    {
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }

     /* Writes the new ticket to the database. */
    public function store(Request $request) // Request is the class that handles the request.
    {
        $this->validate($request,[  // This validates the request.
            'title' => 'required', // This is the name of the input field.
            'category' => 'required', 
            'message' => 'required',
        ]);

        $ticket = new Ticket([ // Create a new ticket object.
        'title' => $request->input('title'),
        'user_id' => Auth::user()->id, // This is the user_id of the currently logged in user.
        'ticket_id' => Str::random(10), // This is the ticket_id of the newly created ticket.
        'category_id' => $request->input('category'), // This is the category_id of the newly created ticket.
        'message' => $request->input('message'),

        ]);

        $ticket->save(); // This saves the ticket to the database.

        return redirect('dashboard')->with('success', 'Ticket created successfully'); // This redirects the user to the index page with a success message.
    }

   /* This will retrieve the current user's tickets. */

	public function userTickets() {
		$tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
		$categories = Category::all();

		return view('tickets.user_tickets', compact('tickets', 'categories'));
	}

    
	/* This will retrieve a specific ticket. */
    
	public function show($ticket_id) {
		$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();    
		$comments = $ticket->comments;
		$category = $ticket->category;

		return view('tickets.show', compact('ticket', 'category', 'comments'));
	}

 
   /* This will retrieve all tickets. */
	public function index($is_resolved = 'false') {

		// If only open tickets are requested, then we will limit our query to only show open tickets.
		$tickets = Ticket::where('is_resolved', 'Open')->paginate(10);
		if($is_resolved === 'true') {
			Log::debug('Open tickets only');
			$tickets = Ticket::where('is_resolved', 'Open')->paginate(10);
		} else {
			Log::debug('All tickets');
			$tickets = Ticket::paginate(10);
		}
		
		$categories = Category::all();

		return view('tickets.index', compact('tickets', 'categories'));
	}

	public function close($ticket_id) {
		$ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
		$ticket->is_resolved = 'Closed';
    
		$ticket->save();
		// $ticketOwner = $ticket->user;

		// Log::debug('Mail would be sent to ' . $ticketOwner->email . ' that their ticket #' . $ticket_id . ' has been closed.');

		return redirect()->back()->with("status", "The ticket has been closed.");
	}
}

