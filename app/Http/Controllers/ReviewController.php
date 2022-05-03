<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($packageId)
    {
	return	view('review-delivery-app')->with('packageId', $packageId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stars' => ['digits_between:1,5'],
        ]);


        $review = Review::create([
            'text' => $request->text,
            'stars' => $request->stars,
	    'package_id' => $request->packageId,
        ]);

        return redirect(Route('incoming-packages'));
    }

    public function createGuest($packageId)
    {
	return	view('review-delivery-guest')->with('packageId', $packageId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGuest(Request $request)
    {
        $request->validate([
            'stars' => ['digits_between:1,5'],
        ]);


        $review = Review::create([
            'text' => $request->text,
            'stars' => $request->stars,
	    'package_id' => $request->packageId,
        ]);
	$review->save();

        return redirect($_SERVER['APP_URL'] . ":" .$_SERVER['SERVER_PORT'] . "/package/" . base64_encode($request->packageId));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
