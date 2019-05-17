<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use App\Http\Resources\TweetResource;
use Carbon\Carbon;


use App\User;
use Lcobucci\JWT\Token;
use Tymon\JWTAuth\Token as TymonToken;

class TweetController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tweets = Tweet::all()->sortByDesc('created_at');

        return TweetResource::collection($tweets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tweet' => 'required|min:3'
        ]);

        try {
            $tweet = new Tweet;
            $tweet->tweet = $request->tweet;
            $tweet->user_id = auth()->id();
            $tweet->save();
        }
        catch(\Exception $e){
            return response()->json($e);
        }
        return new TweetResource($tweet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}
