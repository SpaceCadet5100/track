<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSVController extends Controller
{
	public function create()
	{
		return view('csv-form');
	}

	public function store(Request $request)
	{
		dd($request->file('csv'));
		return view('csv-form');
	}
}

