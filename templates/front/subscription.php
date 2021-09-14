<?php
//Prevent direct file call
defined( 'ABSPATH' ) || exit;

include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="subscription-wrap mx-auto">
        <form class="anim" autocomplete="off">
            <h3 class="rsp-h3 font-bold">Subscribe</h3>
            <div class="card subscription-card">
                <div style="display:none;" class="alert alert-danger alert-dismissible fade show" role="alert"><span class="message">' + data.message + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="firstname">Nome</label>
                            <input id="firstname" name="firstname" class="form-input" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="lastname">Sobrenome</label>
                            <input id="lastname" name="lastname" class="form-input" type="text" autocomplete="no">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Celular</label>
                            <input id="phone" name="phone" class="form-input celphone" type="text" autocomplete="off" maxlength="15">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cpf">CPF</label>
                            <input id="cpf" name="cpf" class="form-input cpf" type="text" autocomplete="off" maxlength="14">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Nascimento</label>
                            <input id="email" name="email" class="form-input" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">E-mail</label>
                            <input id="email" name="email" class="form-input" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="musclepass">Senha</label>
                            <input type="password" id="musclepass" name="musclepass" class="form-input" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="musclepass">Confirmar Senha</label>
                            <input type="password" id="musclepass" name="musclepass" class="form-input" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="send-register" disabled="">Continuar</button>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';