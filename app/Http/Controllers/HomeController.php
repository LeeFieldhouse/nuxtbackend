<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use App\Http\Resources\UserResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userDetails(){
        return response()->json(auth()->user()->tweets()->count());

    }

    public function userProfile(Request $request, $id){
        $user = User::where('username', $id)->first();
        if($user){
            return response()->json([
                'user' => new UserResource($user),
                'likes' => $user->likes()->count(),
                'fav_tags' => $user->tags()
                                ->select('tag')
                                ->groupBy('tag')
                                ->orderByRaw('count(*) desc')
                                ->limit(6)
                                ->get(),



                ]);
        }else{
            return "Doesn't Exist";
        }

    }

}
