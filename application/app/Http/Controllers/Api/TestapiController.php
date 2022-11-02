<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Http\Controllers\Api\BaseController;

class TestapiController extends Controller
{

    public function index()
    {
       $user = User::all();

        //return $this->respondNoContentResource();
        //return $this->respondCreated($user);
        return $this->respondWithResource(TestResource::collection($user), 'Data found successfully');
    }

    public function store(Request $request)
    {
    }
}
