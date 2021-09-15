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

    var animateForm = function(){
        
    };

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
    $("input.cep").mask('00000-000', {reverse: false});
    $("input.musclecard").mask('00 00 00000', {reverse: false});
    $("input.confirmcode").mask('00 00', {reverse: false});
    $("input.date").mask('00/00/0000', {reverse: false});
    $("input.expire-date").inputmask({regex: "^(0[1-9]|1[0-2])\/[0-9]{4}"});
    $("input.cvv").inputmask({regex: "^[0-9]{3}[0-9]?$"});
    $("input.card-number").mask('0000 0000 0000 0000');

    $("#subscibe-form").on("submit", function(e){
        e.preventDefault();
        let formEl = $(this);
        let formData = formEl.serialize();
        muscleboss.loading.add("body",true);
        $.post(adminAjaxUrl, formData).done(function(data){
            if( data.status == 'OK' ){
                formEl.find('.alert').hide();
                $("#subscibe-form").unbind().submit();
            }else{
                muscleboss.loading.remove();
                $(".alert").html(data.message).show();
                muscleboss.goTop();
            }
        }).fail(function(){
            $(".alert").html("Falha ao enviar formulÃ¡rio, tente novamente mais tarde.").show();
            muscleboss.loading.remove();
            muscleboss.goTop();
        });
    });

    $(".muscle-default-form").on("submit", function(e){
        e.preventDefault();
        let formEl = $(this);
        let formData = formEl.serialize();
        muscleboss.loading.add("body",true);
        $.post(adminAjaxUrl, formData).done(function(data){
            if( data.status == 'OK' ){
            
                formEl.find('.alert').hide();

                if( data.alert !== undefined ){
                    muscleboss.loading.remove();
                    Swal.fire( data.alert ).then((result) => {
                        if( data.redirect !== undefined ){
                            muscleboss.loading.add("body",true);
                            window.location.href = data.redirect;
                            return;
                        }
                    });
                    return;
                }

                if( data.actionUrl !== undefined ){
                    formEl.attr('action', data.actionUrl);
                }
                if( data.redirect !== undefined ){
                    window.location.href = data.redirect;
                    return;
                }

                formEl.unbind().submit();
            }else{
                muscleboss.loading.remove();
                $(".alert").html(data.message).show();
                muscleboss.goTop();
            }
        }).fail(function(){
            $(".alert").html("Falha ao enviar formulÃ¡rio, tente novamente mais tarde.").show();
            muscleboss.loading.remove();
            muscleboss.goTop();
        });
    });

    $("#register-form").on("submit", function(e){
        e.preventDefault();
        let formEl = $(this);
        let formData = $("#register-form").serialize();
        muscleboss.loading.add("body",true);
        $.post(adminAjaxUrl, formData).done(function(data){
            if( data.status == 'OK' ){
                formEl.find('.alert').hide();
                console.log(data.redirect);
                window.location = data.redirect;
            }else{
                muscleboss.loading.remove();
                $(".alert").html(data.message).show();
                muscleboss.goTop();
            }
        }).fail(function(){
            $(".alert").html("Falha ao enviar formulÃ¡rio, tente novamente mais tarde.").show();
            muscleboss.loading.remove();
            muscleboss.goTop();
        });
    });

    $("#subscibe-form-complete").on("submit", function(e){
        e.preventDefault();
        let formEl = $(this);
        let formData = formEl.serialize();
        muscleboss.loading.add("body",true);
        $.post(adminAjaxUrl, formData).done(function(data){
            if( data.status == 'OK' ){
                formEl.find('.alert').hide();
                switch(data.message){
                    case 'paid':
                        window.location = data.redirect;
                    break;
                    case 'refused':
                        muscleboss.loading.remove();
                        //$(".alert").html("CobranÃ§a recusada, verifique os dados e tente novamente.").show();
                    break;
                }
            }else{
                muscleboss.loading.remove();
                $(".alert").html(data.message).show();
                muscleboss.goTop();
            }
        }).fail(function(){
            $(".alert").html("Falha ao enviar formulÃ¡rio, tente novamente mais tarde.").show();
            muscleboss.loading.remove();
            muscleboss.goTop();
        });
    });

});