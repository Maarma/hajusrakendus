<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marker;

class MapsMarkerController extends Controller
{
    public function index()
    {
        $markers = Marker::all();
        return view('Maps.index', compact('markers'));
    }
}
