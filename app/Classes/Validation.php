<?php

namespace App\Classes;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Validation extends BaseController
{

    public function validate(Request $request,$validationItems)
    {
        $validator = Validator::make($request->all(),$validationItems);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

    }

}