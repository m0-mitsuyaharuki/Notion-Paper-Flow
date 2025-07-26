<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;

class PaperController extends Controller
{
    public function index(Paper $papers)
    {
        return view('posts.index')->with(['papers' => $papers->get()]);
    }

    public function create()
    {
        return view('posts.create');
    }
}
