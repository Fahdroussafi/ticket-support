<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    // post comment
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
    }
}

