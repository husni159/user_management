<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User; 

class UniqueEmail implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if the email is unique in the users table
        return !User::where('email', $value)->exists();
    }

    public function message()
    {
        return 'The :attribute is already taken.';
    }
}
