<?php

namespace Scrabble\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ScrabbleClubController extends Controller
{
    public function index(): View
    {
        return view('scrabble-club::layouts.scrabble-club-layout');
    }
}
