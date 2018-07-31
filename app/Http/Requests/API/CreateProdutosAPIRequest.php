<?php

namespace App\Http\Requests\API;

use App\Models\Produtos;
use InfyOm\Generator\Request\APIRequest;

class CreateProdutosAPIRequest extends APIRequest
{
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
        return Produtos::$rules;
    }
}
