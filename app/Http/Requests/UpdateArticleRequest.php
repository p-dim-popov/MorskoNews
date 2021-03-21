<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateArticleRequest extends StoreArticleRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->id === $this->article->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'title' => ['required', Rule::unique('articles')->ignore($this->article->id), 'max:127', 'min:5'],
        ]);
    }
}
