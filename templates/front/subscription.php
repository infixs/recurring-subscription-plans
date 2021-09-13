<?php
//Prevent direct file call
defined( 'ABSPATH' ) || exit;

include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/header.php';
?>
<div class="py-10" id="subscription-content">
    <div class="bg-grey-500 h-auto mx-auto" style="width:720px;" id="subscription-wrap">
        <form id="register-form" class="anim" autocomplete="off">
            <h3 class="text-5xl font-bold">Subscribe</h3>
            <div class="my-10 bg-white h-20 shadow rounded border border-solid border-gray-100">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label" for="firstname">Nome</label>
                        <input id="firstname" name="firstname" class="form-input" type="text" autocomplete="off">
                    </div>
                    <div>9</div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include \INFIXS_RSP_TEMPLATE_PATH . 'front/layout/footer.php';