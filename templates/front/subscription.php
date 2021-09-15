<?php
//Prevent direct file call
defined( 'ABSPATH' ) || exit;

include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="subscription-wrap mx-auto">
        <form class="anim" autocomplete="off" method="POST">
            <h3 class="rsp-h3 font-bold">Registrar</h3>
            <div class="card subscription-card">
                <?php if( isset($validate) && !$validate['isValid'] ) : ?>
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                    <span class="message">
                        <?php echo $validate['htmlErrors']; ?>
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="before-message row mb-5">
                    <div class="col-md">
                        <div class="message">
                        <i class="fa fa-check"></i>
                        <div class="text">Você está assinando o plano <strong>Nome do Plano</strong> por apenas <strong>R$ 29,90</strong>, cancele a qualquer momento sem custos.</div>
                        </div>
                    </div>
                </div>
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
                            <label class="form-label" for="nasc">Nascimento</label>
                            <input id="nasc" name="nasc" class="form-input date" type="text" autocomplete="off">
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
                            <input type="password" id="password" name="password" class="form-input" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="musclepass">Confirmar Senha</label>
                            <input type="password" id="password_confirm" name="password_confirm" class="form-input" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="send-register">Continuar</button>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';