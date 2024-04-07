<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
// use App\Rules\UniqueEmail;
use App\Http\Requests\CreateUserRequest;

use Exception;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {
        try{
            $users = User::orderBy('updated_at', 'desc')->get();           
            return $this->success([
                'data' => $users,
            ]);

        }catch(Exception $e){      
            return $this->error(
                [],
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUser(CreateUserRequest $request)
    {
        try{
            // $request->validate([
            //     'email' => ['required', 'email', new UniqueEmail],
            // ]);

            $user = User::create([
                'name'      => $request->fullName,
                'email'     => $request->email,
                'role'      => $request->role
            ]);
            return $this->success([
                'user' => $user
            ]);
        }catch(Exception $e){
            return $this->error(
                [],
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
