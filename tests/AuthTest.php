<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class AuthTest extends TestCase
{
    use DatabaseTransactions;


    /** @test  */

    public function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
    {
          $this->visit('register')
              ->type('JohnDoe','name')
              ->type('john@example.com','email')
              ->type('password','password')
              ->type('password','password_confirmation')
              ->type('joedoe','username')
              ->type('Lahore','city')
              ->type('123456789','mobile')
              ->press('Signup Now');


          $this->see('Please confirm your email address.')
                ->seeInDatabase('users',['name' => 'JohnDoe','verified' => 0] );


          $user  = User::whereName('JohnDoe')->first();

           // $this->login($user)->seed('Could not sign you in.');
        
        $this->visit("register/confirm/{$user->token}")
            ->see('You are now confirmed Please login.')
            ->seeInDatabase('users',['name' => 'JohnDoe','verified' => 1] );





    }

    public function login($user = null)
    {
        $user = $user ?: $this->factory->create('\App\User',['password' => 'password']);
    }
}

