<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 *      @OA\Info(
 *      version="1.0.0",
 *      title="Nice Planet API",
 *      description="Nice Planet API")
 *      @OA\Serve(url="http://localhost:8000/api")
 *      @OA\SecurityScheme(
 *      securityScheme="Bearer",
 *      type="http",
 *      scheme="bearer",
 *     )
 **/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
