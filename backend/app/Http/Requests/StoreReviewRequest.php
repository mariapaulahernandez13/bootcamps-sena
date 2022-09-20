<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreReviewRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required",
            "text" => "required",
            "rating" => "numeric",
        ];
    }

    /**
     * Método para enviar respuesta en caso de validación fallida
     */
    protected function failedValidation(Validator $v){
        //Lanzar una excepción Http response en caso de errores de validación
        throw new HttpResponseException( response()->json( [ "success" => false, "errors" => $v->errors() ] , 422 ) );
    }
}
