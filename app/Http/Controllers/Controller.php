<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponseHelpers;

    public function validate(
        Request $request,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $validator = $this->getValidationFactory()->make(
            $request->all(),
            $rules,
            $messages,
            $customAttributes
        );

        if ($validator->fails()) {
            // get the validation errors
            $errors = (new ValidationException($validator))->errors();
            // take only errors' value without its key (attribute name)
            $errors = array_values($errors);
            // flatten the array
            $errors = Arr::flatten($errors);
            // turn array to comma separated string
            $errors = implode(' ', $errors);

            throw new HttpResponseException(response()->json(
                ['message' => $errors],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            ));
        }

        // get the attributes and values that were validated.
        return $validator->validated();
    }

    public  function storeFileToPublic($uploadedFile)
    {
        if ($uploadedFile == null) return null;

        // Save file and persist its original file name by
        // adding number to file name 2121-fileName.jpg
        // this loop is to avoid duplication
        do {
            $fileName = rand(0000, 9999) . '-' . $uploadedFile->getClientOriginalName();
        } while (file_exists(public_path($fileName)));

        $path = 'files';
        $uploadedFile->move($path, $fileName);

        return $path . '/' . $fileName;
    }
}
