<?php
//Prevent direct file call

use InfixsRSP\Support\Str;
use InfixsRSP\Http\Request;

defined( 'ABSPATH' ) || exit;

$request = new Request();


include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="subscription-wrap mx-auto">
        <form class="anim" autocomplete="off" method="POST">
            <h3 class="rsp-h3 font-bold"><?php echo __( 'Payment', 'recurring-subscription-plans' ); ?></h3>
            <div class="card subscription-card">
                <?php if( isset($validate) && $validate->fails() ) : ?>
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                    <span class="message">
                        <?php 
                            foreach($validate->errors()->all() as $error){
                                echo '<li>' . sanitize_text_field($error) . '</li>';
                            }
                        ?>
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="before-message row mb-4">
                    <div class="col-md">
                        <div class="message">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="15px" height="12px" viewBox="0 0 15 12" enable-background="new 0 0 15 12" xml:space="preserve">
                                <rect x="2.539" y="3.535" transform="matrix(0.7069 -0.7073 0.7073 0.7069 -4.1456 5.0653)" fill="#61CE61" width="3" height="8.001"/>
                                <rect x="2.843" y="4.268" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.342 8.2958)" fill="#61CE61" width="13" height="3"/>
                            </svg>
                            <div class="info-message">
                                <?php printf( wp_kses( __( 'You are subscribing to the <strong>%s</strong> plan for only <strong>%s</strong>, cancel anytime for free.', 'recurring-subscription-plans' ), [ 'strong' => [] ] ), sanitize_text_field( $plan->name ), Str::toMoney( $plan->price ) );?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="before-message row">
                    <div class="col-md">
                        <?php if( isset( $plan ) ): ?>
                        <div class="message mb-4">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="15px" height="12px" viewBox="0 0 15 12" enable-background="new 0 0 15 12" xml:space="preserve">
                                <rect x="2.539" y="3.535" transform="matrix(0.7069 -0.7073 0.7073 0.7069 -4.1456 5.0653)" fill="#61CE61" width="3" height="8.001"/>
                                <rect x="2.843" y="4.268" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.342 8.2958)" fill="#61CE61" width="13" height="3"/>
                            </svg>
                            <div class="info-message">
                                <?php printf( wp_kses( __( 'Primeiro mês gratuito! Não faremos nenhuma cobrança antes dos 30 dias.', 'recurring-subscription-plans' ), [ 'strong' => [] ] ), sanitize_text_field( $plan->name ), Str::toMoney( $plan->price ) );?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="ccname"><?php echo __( 'Name on Card', 'recurring-subscription-plans' ); ?></label>
                            <input id="ccname" name="ccname" class="form-input" value="<?php echo $request->old('ccname'); ?>" type="text" autocomplete="cc-number" x-autocompletetype="cc-number">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="cardnumber"><?php echo __( 'Credit Card Number', 'recurring-subscription-plans' ); ?></label>
                            <input id="cardnumber" name="cardnumber" class="form-input card-number" value="<?php echo $request->old('cardnumber'); ?>" type="text" maxlength="19" autocomplete="cc-number" x-autocompletetype="cc-number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="exp-date"><?php echo __( 'Expiration Date', 'recurring-subscription-plans' ); ?></label>
                            <input id="exp-date" name="exp-date" class="form-input expire-date" value="<?php echo $request->old('exp-date'); ?>" type="text" inputmode="text" autocomplete="cc-exp" x-autocompletetype="cc-exp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cvv"><?php echo __( 'Security Code', 'recurring-subscription-plans' ); ?></label>
                            <input value="" id="cvv" name="cvv" class="form-input cvv" inputmode="text" >
                        </div>
                    </div>
                </div>
                <div class="after-message row mt-1">
                    <div class="col-md">
                        <label class="footer-info"><?php echo __( 'Your card details are protected and are used only to charge the subscription, which can be canceled at any time without charge by the customer.', 'recurring-subscription-plans' ) ?></label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="firstname" value="<?php echo esc_html( $request->input('firstname') ); ?>"/>
            <input type="hidden" name="lastname" value="<?php echo esc_html( $request->input('lastname') ); ?>"/>
            <input type="hidden" name="phone" value="<?php echo esc_html( $request->input('phone') ); ?>"/>
            <input type="hidden" name="document_number" value="<?php echo esc_html( $request->input('document_number') ); ?>"/>
            <input type="hidden" name="birthdate" value="<?php echo esc_html( $request->input('birthdate') ); ?>"/>
            <input type="hidden" name="email" value="<?php echo esc_html( $request->input('email') ); ?>"/>
            <input type="hidden" name="gender" value="<?php echo esc_html( $request->input('gender') ); ?>"/>
            <button type="submit" class="btn btn-primary float-right" name="sendcard" id="sendcard" value="1"><?php echo __( 'Continue', 'recurring-subscription-plans' ); ?></button>
        </form>          
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';