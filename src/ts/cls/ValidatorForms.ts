interface Errors {
    elem: JQuery,
    error_message?:string
}

const $ = jQuery;

export class ValidatorForms{
    protected form:JQuery;
    protected isAjax:boolean;
    protected action:string;
    protected errors:Errors[] = [];

    //cb function after success ajax
    protected cb_success:Function;
    protected cb_error:Function;


    /**
     * init validate form
     * @param form:JQuery
     * @param ajax:boolean
     * @return void
     */
    constructor (form:JQuery, ajax:boolean = true){
        this.form   = form;
        this.isAjax = ajax;


        this.validateSubmit();
        this.listenerFocusEvent();
    }


    /**
     * listener event submit
     * @return void
     */
    protected validateSubmit():void{

        this.form.submit((e)=>{
            //reset errors
            this.errors = [];
            this.action = $(e.currentTarget).attr('action');

            this.isValid($(e.currentTarget));

            //Form is valid
            if(!this.errors.length){
                if(!this.isAjax){
                    return true;
                }

                this.sendFormAjax();
            }

            this.addErrorsToDom();
            e.preventDefault();

        });
    }


    /**
     * Check is params forms valid
     * @param form:JQuery
     * @return void
     */
    protected isValid(form:JQuery):void{
        const $ = jQuery;
        const $objRequire = form.find('[data-jd-vtype]');

        //Loop fields.
        $objRequire.each((index, elem)=>{

            let $self           = $(elem);
            let field_value     = $self.val();
            let is_require      = $self.attr('data-jd-require')=='true';
            let vtype           = $self.attr('data-jd-vtype');
            let invalid_message = $self.attr('data-jd-message-invalid');
            let error_message   = $self.attr('data-jd-error-message');

            //fields require
            if(is_require){
                // Validate Simple Valid.
                if(vtype == 'simpleValid' && !ValidatorForms.simpleValid(field_value)){
                    this.pushError($self,error_message);
                }

                else if(vtype == 'isPhone' && !ValidatorForms.isPhone(field_value)){
                    let message = !ValidatorForms.simpleValid(field_value) ? error_message : invalid_message;
                    this.pushError($self,message);
                }

                else if(vtype == 'isEmail' && !ValidatorForms.isMail(field_value)){
                    let message = !ValidatorForms.simpleValid(field_value) ? error_message : invalid_message;
                    this.pushError($self,message);
                }
            }

            //Fields check is value valid
            else{
                if(vtype == 'isEmail' && ValidatorForms.simpleValid(field_value) && !ValidatorForms.isMail(field_value)){
                    this.pushError($self,invalid_message);
                }

                if(vtype == 'sameFieldValue' && !ValidatorForms.sameFieldValue($self)){
                    this.pushError($self,invalid_message);
                }
            }

        });

    }

    /**
     * Check is param same value
     * @param $self:Object
     * @return boolean
     */
    public static sameFieldValue($self){
        let idSame = $self.data('jd-same');
        let idValue = $(`#${idSame}`).val();

        return idValue === $self.val();
    }


    /**
     * Check is param is not empty
     * @param field_value:string
     * @return boolean
     */
    public static simpleValid(field_value:string):boolean{
        if(!$.trim(field_value)){
            return false
        }

        return true;
    }

    /**
     * Check is param is phone israel
     * @param field_value:string
     * @return boolean
     */
    public static isPhone(field_value:string):boolean{
        const prefix_phone = "0(5[0,2,3,4,7,8,9,5]|7[2,3,4,6,7,8]|[2,3,4,8,9])";
        const phone = new RegExp("^" + prefix_phone + "[2-9]\\d{6}$");
        return phone.test(field_value);
    }

    /**
     * Check is param is email
     * @param field_value:string
     * @return boolean
     */
    public static isMail(field_value:string):boolean{
        let email = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,50})$/i;
        return email.test($.trim(field_value));
    }


    /**
     * add error message to dom.
     * @return void.
     */
    protected addErrorsToDom():void{
        //Reset Error Message
        this.form.find('.error-message').text('');

        //Loop Errors
        for(let error of this.errors){
            let $elem           = error.elem;
            let id              = $elem.attr('id');
            let $selector_error = $('#'+id+'_error');

            $elem.addClass('error');
            $selector_error.text(error.error_message);

        }
    }


    /**
     * Listener event focus and remove class error.
     * @return void.
     */
    protected listenerFocusEvent():void{
        $(document).on('focus','form .error',(e)=>{
            $(e.currentTarget).removeClass('error');
        })
    }

    /**
     * push object to array errors.
     * @param elem:JQuery.
     * @param message:string.
     * @return void.
     */
    protected pushError(elem:JQuery,message:string):void{
        this.errors.push({elem:elem,error_message:message});
    }

    /**
     * Send Form ajax.
     * @return void.
     */
    protected sendFormAjax():void{
        this.form.addClass('jd-form-loading');
        let elemForm:any =  this.form.get(0);
        let $btnSubmit = this.form.find('[data-jd-submit=1]');

        //Reset Error Message
        this.form.find('.error-message').text('');

        $btnSubmit.prop('disabled', 'true');

        $.ajax({
            type:'post',
            url :this.action,
            data:this.form.serialize(),

            success:(data)=>{
                elemForm.reset();
                this.form.removeClass('jd-form-loading').addClass('jd-form-success');
                $btnSubmit.removeAttr('disabled');
                if(this.cb_success != undefined){
                    this.cb_success(data);
                }

            },

            error:(data)=>{
                this.form.removeClass('jd-form-loading').addClass('jd-form-success');
                $btnSubmit.removeAttr('disabled');
                if(this.cb_success != undefined) {
                    this.cb_error(data);
                }
            }
        });
    }

    /**
    * Function cb success instance form
    * @return void.
    * */
    public cbAjaxSuccess(cb:(data:JSON)=>void){
        this.cb_success = cb;
    }

    /**
     * Function cb error instance form
     * @return void.
     * */
    public cbAjaxError(cb:(data:JSON)=>void){
        this.cb_error = cb;
    }



}