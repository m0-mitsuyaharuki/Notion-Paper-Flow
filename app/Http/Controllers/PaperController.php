<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;

class PaperController extends Controller
{
    public function index(Paper $paper)
    {
        return $paper->get();
    }
}
