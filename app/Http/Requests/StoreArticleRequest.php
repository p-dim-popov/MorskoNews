<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole(User::ROLES['ADMIN']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'unique:articles', 'max:127', 'min:5'],
            'content' => ['required', 'max:16777215', 'min:300'],
            'categories' => ['required', 'min:2'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'categories.min' => 'The  :attribute must be at least :min.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'categories' => collect($this['categories'])
                ->map(fn($cat) => Str::of($cat)->trim()->lower())
                ->toArray(),
            'title' => Str::of($this['title'])->trim(),
        ]);
    }
}
