<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => [
                'username' => $this->user->username,
                'avatar' => $this->user->avatar
            ],
            'tweet' => $this->tweet,
            'posted' => Carbon::parse($this->created_at->toDateTimeString())->diffForHumans(),
            'likes' => $this->likes()->count(),
            // checks if user has liked the tweet
            'liked' => $this->likes()->where('user_id', auth()->id())->first(),
        ];
    }
}
