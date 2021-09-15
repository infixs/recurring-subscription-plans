<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\Support\Validator;
use Infixs\WP;

class SubscriptionController extends Controller
{
    public function index()
    {
        return $this->view('front.subscription');
    }

    public function store()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $nasc = $_POST['nasc'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $validate = Validator::make( $_POST, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'nasc' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required'
        ]);

        
        return $this->view('front.subscription', compact('validate') );
    }
}