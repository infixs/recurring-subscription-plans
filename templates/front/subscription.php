<?php
//Prevent direct file call

use Infixs\Support\Str;
use Infixs\Http\Request;

$request = new Request();

defined( 'ABSPATH' ) || exit;

include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="subscription-wrap mx-auto">
        <form class="anim rsp-subscription-form" autocomplete="off" method="POST">
            <h3 class="rsp-h3 font-bold"><?php echo __( 'Subscription', 'recurring-subscription-plans' ); ?></h3>
            <div class="card subscription-card">
                <?php if( !isset($plan) ): ?>
                    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                        <span class="message"><?php echo __( 'You need to select a plan to proceed', 'recurring-subscription-plans' ); ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php else: ?>
                <div class="form-content">
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
                                <?php printf( wp_kses( __( 'You are subscribing to the <strong>%s</strong> plan for only <strong>%s</strong>, cancel anytime for free.', 'recurring-subscription-plans' ), [ 'strong' => [] ] ), sanitize_text_field( $plan->name ), Str::toMoney( $plan->price ) );?>
                                </div>
                            </div>
                            <?php endif; ?>
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
                                    <?php printf( wp_kses( __( 'Você ganhou <strong>1 mês gratuito</strong>! Não faremos nenhuma cobrança antes dos 30 dias.', 'recurring-subscription-plans' ), [ 'strong' => [] ] ), sanitize_text_field( $plan->name ), Str::toMoney( $plan->price ) );?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname"><?php echo __( 'First Name', 'recurring-subscription-plans' ); ?></label>
                                <input id="firstname" name="firstname" class="form-input" type="text" value="<?php echo $request->old('firstname'); ?>" autocomplete="no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname"><?php echo __( 'Last Name', 'recurring-subscription-plans' ); ?></label>
                                <input id="lastname" name="lastname" class="form-input" type="text" value="<?php echo $request->old('lastname'); ?>" autocomplete="no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="phone"><?php echo __( 'Cell Phone', 'recurring-subscription-plans' ); ?></label>
                                <input id="phone" name="phone" class="form-input celphone" type="text" autocomplete="no" value="<?php echo $request->old('phone'); ?>" maxlength="15">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="cpf"><?php echo __( 'Document number', 'recurring-subscription-plans' ); ?></label>
                                <input id="cpf" name="cpf" class="form-input cpf" type="text" autocomplete="no" value="<?php echo $request->old('cpf'); ?>" maxlength="14">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nasc"><?php echo __( 'Birth Date', 'recurring-subscription-plans' ); ?></label>
                                <input id="nasc" name="nasc" class="form-input date" type="text" value="<?php echo $request->old('nasc'); ?>" autocomplete="no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email"><?php echo __( 'Email', 'recurring-subscription-plans' ); ?></label>
                                <input id="email" name="email" class="form-input" type="text" value="<?php echo $request->old('email'); ?>" autocomplete="no">
                            </div>
                        </div>
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="musclepass"><?php echo __( 'Password', 'recurring-subscription-plans' ); ?></label>
                                <input type="password" id="password" name="password" class="form-input" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="musclepass"><?php echo __( 'Confirm Password', 'recurring-subscription-plans' ); ?></label>
                                <input type="password" id="password_confirm" name="password_confirm" class="form-input" autocomplete="new-password">
                            </div>
                        </div>-->
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" id="send-register" name="sendbasic" value="1"><?php echo __( 'Continue', 'recurring-subscription-plans' ); ?></button>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';