<?php
namespace RecurringSubscriptionPlans\Controllers\Front;

use Infixs\Controller;
use Infixs\Http\Request;
use Infixs\Support\Validator;
use Infixs\WP;
use NumberFormatter;
use RecurringSubscriptionPlans\Database\Models\Plan;

class SubscriptionController extends Controller
{
    /**
     * Index function with get method
     *
     * @since 1.0.0
     * @return string
     */
    public function index( Request $request )
    {        
        $plan_id = (int) $request->input('plan');
        $plan = Plan::getPlan($plan_id, ['name', 'price']);
        $plan = $plan ? $plan : null;

        return $this->view( 'front.subscription', compact('plan') );
    }

    /**
     * Store function with post method
     *
     * @since 1.0.0
     * @return string
     */
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
            'cpf' => 'required',
            'nasc' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required'
        ]);


        if( $validate['isValid'] )
        {
            if( isset( $_GET['plan'] ) )
                $this->redirect('/subscription/payment', ['plan' => $_GET['plan']] );
            else
                $this->redirect('/' );

            die();
        }
        
        return $this->view( 'front.subscription', compact('validate') );
    }
}