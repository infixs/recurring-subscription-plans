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
            <h3 class="rsp-h3 font-bold"><?php echo __( 'Billing card address', 'recurring-subscription-plans' ); ?></h3>
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
                            <li>Está com com problemas? entre em contato conosco <a target="_blank" href="https://api.whatsapp.com/send?phone=5541999685463&text=Estou%20com%20problemas%20para%20me%20cadastrar">clicando aqui</a></li>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="zipcode"><?php echo __( 'Zip Code', 'recurring-subscription-plans' ); ?></label>
                                <input id="zipcode" name="zipcode" class="form-input zipcode" type="text" value="<?php echo $request->old('zipcode'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="address"><?php echo __( 'Address', 'recurring-subscription-plans' ); ?></label>
                                <input id="address" name="address" class="form-input" type="text" value="<?php echo $request->old('address'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="address_number"><?php echo __( 'Address Number', 'recurring-subscription-plans' ); ?></label>
                                <input id="address_number" name="address_number" class="form-input" value="<?php echo $request->old('address_number'); ?>" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="address_2"><?php echo __( 'Address 2', 'recurring-subscription-plans' ); ?></label>
                                <input id="address_2" name="address_2" class="form-input" type="text" value="<?php echo $request->old('address_2'); ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group focused">
                                <label class="form-label" for="state"><?php echo __( 'State', 'recurring-subscription-plans' ); ?></label>
                                <select name="state" id="state" class="state_select form-input" value="<?php echo $request->old('state'); ?>" autocomplete="address-level1" data-placeholder="Selecione uma opção…" data-input-classes="">
        						    <option value="">Selecione uma opção…</option><option value="AC">Acre</option><option value="AL">Alagoas</option><option value="AP">Amapá</option><option value="AM">Amazonas</option><option value="BA">Bahia</option><option value="CE">Ceará</option><option value="DF">Distrito Federal</option><option value="ES">Espírito Santo</option><option value="GO">Goiás</option><option value="MA">Maranhão</option><option value="MT">Mato Grosso</option><option value="MS">Mato Grosso do Sul</option><option value="MG">Minas Gerais</option><option value="PA">Pará</option><option value="PB">Paraíba</option><option value="PR">Paraná</option><option value="PE">Pernambuco</option><option value="PI">Piauí</option><option value="RJ">Rio de Janeiro</option><option value="RN">Rio Grande do Norte</option><option value="RS">Rio Grande do Sul</option><option value="RO">Rondônia</option><option value="RR">Roraima</option><option value="SC">Santa Catarina</option><option value="SP">São Paulo</option><option value="SE">Sergipe</option><option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="neighborhood"><?php echo __( 'Neighborhood', 'recurring-subscription-plans' ); ?></label>
                                <input id="neighborhood" name="neighborhood" class="form-input" value="<?php echo $request->old('neighborhood'); ?>" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="city"><?php echo __( 'City', 'recurring-subscription-plans' ); ?></label>
                                <input id="city" name="city" class="form-input" value="<?php echo $request->old('city'); ?>" type="text" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <input type="hidden" name="firstname" value="<?php echo esc_html( $request->input('firstname') ); ?>"/>
            <input type="hidden" name="lastname" value="<?php echo esc_html( $request->input('lastname') ); ?>"/>
            <input type="hidden" name="phone" value="<?php echo esc_html( $request->input('phone') ); ?>"/>
            <input type="hidden" name="gender" value="<?php echo esc_html( $request->input('gender') ); ?>"/>
            <input type="hidden" name="document_number" value="<?php echo esc_html( $request->input('document_number') ); ?>"/>
            <input type="hidden" name="birthdate" value="<?php echo esc_html( $request->input('birthdate') ); ?>"/>
            <input type="hidden" name="email" value="<?php echo esc_html( $request->input('email') ); ?>"/>
            <input type="hidden" name="ccname" value="<?php echo esc_html( $request->input('ccname') ); ?>"/>
            <input type="hidden" name="cardnumber" value="<?php echo esc_html( $request->input('cardnumber') ); ?>"/>
            <input type="hidden" name="exp-date" value="<?php echo esc_html( $request->input('exp-date') ); ?>"/>
            <input type="hidden" name="cvv" value="<?php echo esc_html( $request->input('cvv') ); ?>"/>
            <button type="submit" class="btn btn-primary" id="sendregister" name="sendregister" value="1"><?php echo __( 'Continue', 'recurring-subscription-plans' ); ?></button>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';