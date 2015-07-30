<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminSourcesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (\Auth::guest()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumb'             =>  'mimes:jpeg,png',
            'shorthand'         =>  'required',
            'name'              =>  'required',
            'url'               =>  'required|url',
            'author_twitter'    =>  'required',
            'author_email'      =>  'email',
            'rss_feed'          =>  'url'

        ];
    }
}
