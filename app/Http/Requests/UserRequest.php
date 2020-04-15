<?php

namespace App\Http\Requests;

use App\Permission;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route('id');
        return auth()->user()->can("manage-users") || $this->user()->id == $id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=>"required",
            "email"=>"required",
            "roles"=>"nullable|string",
            "permissions"=>"nullable|string",
        ];
    }
}
