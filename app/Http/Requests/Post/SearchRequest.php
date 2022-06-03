<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\SearchRules;

class SearchRequest extends FormRequest
{
    use SearchRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->validation();
    }
}
