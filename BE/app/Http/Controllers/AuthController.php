<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Exception;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function login_user(Request $request)
    {
 
        try{
            
            $credentials = $request->only('email', 'password');
          
            if(!Auth::attempt($credentials, false)) {
                return $this->error('', 'Credentials do not match', 401);
            }
            $user = User::where('email', $request->email)->first();
            $user['avatar'] = null;
         
            //response
            return $this->success([
                'user' => $user,
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function logout() : string {
        return response()->json('this is my logout method');
    }

    
}
