import {ValidatorForms} from "./ValidatorForms";
import {SimpleFunctions} from "./SimpleFunctions";
const $ = jQuery;
export class Login {

    public static init(){
        this.eventListener();
        this.validateFormLogin();
        this.validationFormRegister();
        this.validationFormForgotPass();
        this.validationFormResetPass();
        this.tabLogin();

    }

    static eventListener(){

        $('.sl-login:not(.logged-in) .btn-user').click(()=>{
            const $menu_mobile = $('#menu_mobile');
            $('.popup-login').addClass('active');

            //is menu mobile open.
            if($menu_mobile.hasClass('open')){
                SimpleFunctions.closeMenuMobile();
            }

            //Calculate popup.
            SimpleFunctions.calculatePopup();

        });

        $('.popup-login .overlay-popup,' +
            '.popup-login .close-popup').click(this.clolePopupLogin);

    }

    static clolePopupLogin(){
        $('.popup-login').removeClass('active');
    }

    static tabLogin(){
        $('.tab-login').click(function(){
            let $self = $(this);
            let tabContentId = $self.data('tab');

            $('.content-popup .active').removeClass('active');
            $self.addClass('active');
            $(`#${tabContentId}`).addClass('active');
            SimpleFunctions.calculatePopup();
        });
    }

    static validateFormLogin(){

        let formLogin = new ValidatorForms($('#SL_login'),true);

        formLogin.cbAjaxSuccess((data)=>{
            location.reload();
        });

        formLogin.cbAjaxError((error:any)=>{
            let error_server = error.responseJSON;
            $('#SLLogin_password_error').text(error_server.SLLogin);

        });


    }

    static validationFormRegister(){
        let formRegister = new ValidatorForms($('#SL_register'),true);

        formRegister.cbAjaxSuccess((data)=>{
            location.reload();
        });

        formRegister.cbAjaxError((error:any)=>{
            let errors = error.responseJSON;
            for (let error_server in errors) {
                let input = error_server.replace('_error','');

                $(`#${input}`).addClass('error');
                $(`#${error_server}`).text(errors[error_server]);
            }
            for (let value of errors) {
                value += 1;
                console.log(value);
            }
        });
    }

    static validationFormForgotPass(){

        let formRegister = new ValidatorForms($('#SL_forgot_pass'),true);

        formRegister.cbAjaxSuccess((data)=>{
            $('#SL_forgot_pass .message-thanks').show();
        });

        formRegister.cbAjaxError((error:any)=>{
            let error_server = error.responseJSON;
            $('#SLForgotPass_email').addClass('error');
            $('#SLForgotPass_email_error').text(error_server.SLForgot);
        });
    }

    static validationFormResetPass(){
        let formRegister = new ValidatorForms($('#SL_reset_pass'),true);

        formRegister.cbAjaxSuccess((data)=>{
            location.reload();
        });

        formRegister.cbAjaxError((error)=>{
            console.log(error)
        });
    }




}