jQuery(function($){    
    $('#billing_postcode').on('focusout', function(){
        let cep = $('#billing_postcode').val();
        cep = cep.replace(/[^0-9]/i, '');
        if(cep.length == 8 ){
          $.get('https://viacep.com.br/ws/' + cep + '/json/').done(function( data ){
            
              $("#billing_address_1").addClass('filled').parents('.form-group').addClass('focused');
              $("#billing_address_1").val(data.logradouro);

              $("#billing_neighborhood").addClass('filled').parents('.form-group').addClass('focused');
              $("#billing_neighborhood").val(data.bairro);

              $("#billing_city").addClass('filled').parents('.form-group').addClass('focused');
              $("#billing_city").val(data.localidade);
              $("#billing_state").val(data.uf);
          }).fail(function(){
            
          });
        }
      });

    $('form.anim input').focus(function(){
        $(this).parents('.form-group').addClass('focused');
    });
    
    $('form.anim input').blur(function(){
        var inputValue = $(this).val();
        if ( inputValue == "" ) {
        $(this).removeClass('filled');
        $(this).parents('.form-group').removeClass('focused');  
        } else {
        $(this).addClass('filled');
        }
    }) ;

    $('form.anim input[type=text]').each(function(){
        if( $(this).val().length > 0 ){
            $(this).addClass('filled').parents('.form-group').addClass('focused');
        }
    });

    $('form.anim input').first().trigger('focus');

    $("input.cpf").mask('000.000.000-00', {reverse: false});
    $("input.celphone").mask('(00) 00000-0000', {reverse: false});
    $("input.zipcode").mask('00000-000', {reverse: false});
    $("input.date").mask('00/00/0000', {reverse: false});
    $("input.expire-date").inputmask({regex: "^(0[1-9]|1[0-2])\/[0-9]{2}"});
    $("input.cvv").inputmask({regex: "^[0-9]{3}[0-9]?$"});
    $("input.card-number").mask('0000 0000 0000 0000');

    /*$("form.rsp-subscription-form").on("submit", function(e){
        e.preventDefault();
        let formElement = $(this);
        let formData = $(formElement).serialize();
        $.post(window.location.href, formData).done(function(data){
            if( data.status == 'OK' )
                window.location.href = data.redirect;
        }).fail(function(){
            
        });

    });*/
});