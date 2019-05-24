<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Tweet;
use App\Tag;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tweets = [];
        foreach(Tag::where('tag', $this->tag)->get() as $tag){
            array_push($tweets, [
                'tweet' => [
                    'tweet' => $tag->tweet->tweet,
                    'posted' => $tag->tweet->created_at
                ],
                'user' => [
                    'username' => $tag->user->username,
                    'avatar' => $tag->user->avatar

                ]
            ]);
        }
        return [
            'tweets' => $tweets
        ];
    }
}
