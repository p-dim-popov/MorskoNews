<?php

namespace App\Http\Requests;

class UpdateCommentRequest extends StoreCommentRequest
{
    public function authorize()
    {
        return parent::authorize() && $this->user()->id === $this->comment->user->id;
    }
}
