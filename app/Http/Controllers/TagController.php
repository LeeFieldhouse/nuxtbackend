<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    public function mostPopular(){
        try {
        $mostPopular = Tag::select('tag')
            ->groupBy('tag')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

            return response()->json($mostPopular);
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function getTag(Request $request, $id){
        $tags = Tag::where('tag', '#'.$id)->first();
        return response()->json(new TagResource($tags));
    }
}
