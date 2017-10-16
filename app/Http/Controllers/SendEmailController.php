<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Input;

use Auth;

class SendEmailController extends Controller
{

  protected $form = '';

  protected $to = 'info@2rent.pk';

  protected $message = '';

  protected $subject = '';

  protected $support = false; 

  
    public function __construct()
    {
       
      parent::__construct();

        $this->middleware('auth');




    }


    public function sendMail(Request $request)
    {

        $this->subject = (!empty($request['name'])) ? $request['name'] :  'Message sent via your 2Rent Market profile from '.Auth::user()->name;

        $this->name = (!empty($request['name'])) ? $request['name'] : Auth::user()->name; 

        $this->to = (!empty($request['to'])) ? $request['to'] : 'info@2rent.pk'; 

        $this->from = (!empty($request['from'])) ? $request['from'] : Auth::user()->email; 

        $this->message =  $request->get('message');
        
   
        if(!empty($request['from'])){
            
           $this->support = true;  

        }
            
                 Mail::send('emails.contact',
                    array(

                        'name' => $this->name,

                        'email' => $this->from,

                        'support' =>  $this->support,
 
                        'user_message' => $this->message
                        
                    ), function ($message) {
                    
                        $message->from($this->from);

                        $message->to($this->to, '2Rent')->subject($this->subject);
                 });




        return $notification = array(
                
                'success' =>  true,

                'message' => 'Your message has been sent',

        );
    }



   

  
}
