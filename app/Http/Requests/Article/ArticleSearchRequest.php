<?php

namespace App\Http\Requests\Article;

use App\Exceptions\ValidationRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ArticleSearchRequest extends FormRequest
{

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'keyword' => 'required|string',
            'fromDate' => 'nullable|date',
            'toDate' => 'nullable|date',
            'category' => 'nullable|string',
            'source' => 'nullable|string|in:newsapi,theguardian,nyt',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     * @throws ValidationRequestException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ValidationRequestException($validator->errors(),
            Response::HTTP_BAD_REQUEST);
    }
}
