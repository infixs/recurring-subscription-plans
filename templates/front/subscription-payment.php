<?php
//Prevent direct file call

use Infixs\Support\Str;

defined( 'ABSPATH' ) || exit;

include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="subscription-wrap mx-auto">
        <form class="anim" autocomplete="off" method="POST">
            <h3 class="rsp-h3 font-bold">Pagamento</h3>
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
                        <i class="fa fa-check"></i>
                        <div class="text">Você está assinando o plano <strong><?php printf( '%s', sanitize_text_field( $plan->name ) ); ?></strong> por apenas <strong><?php printf( '%s', Str::toMoney( $plan->price ) ); ?></strong>, cancele a qualquer momento sem custos.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="ccname">Nome do titular do cartão</label>
                            <input value="" id="ccname" name="ccname" class="form-input" type="text" autocomplete="cc-number" x-autocompletetype="cc-number">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="cardnumber">Número do cartão</label>
                            <input value="" id="cardnumber" name="cardnumber" class="form-input card-number" type="text" maxlength="19" autocomplete="cc-number" x-autocompletetype="cc-number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="exp-date">Data de validade</label>
                            <input value="" id="exp-date" name="exp-date" class="form-input expire-date" type="text" inputmode="text" autocomplete="cc-exp" x-autocompletetype="cc-exp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cvv">Código de segurança</label>
                            <input value="" id="cvv" name="cvv" class="form-input cvv" inputmode="text">
                        </div>
                    </div>
                </div>
                <div class="after-message row mt-4">
                    <div class="col-md">
                        <label class="footer-info">Os dados do seu cartão são protegidos e somente são usados para a cobrança da assinatura, que poderá ser cancelada a qualquer momento sem custos pelo cliente.</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="send-register">Continuar</button>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';