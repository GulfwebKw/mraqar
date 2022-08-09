<template>
    <div class="col-lg-6 col-md-12 p-0">
        <div class="register-content">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="register-form">
                        <div class="logo">
                            <a href="/"><img :src="'/images/main/logo.png'"
                                                                     alt="image"></a>
                        </div>

                        <h3>Create Your Account Now</h3>
                        <p>Already registered? <a href="/login">Sign in</a></p>


                        <form v-if="!showSmsCodePart" method="POST" action="/register">

                            <div class="fieldset">
                                <input type="radio" name="type-usage" v-model="type_usage" value="individual" id="monthly-1" checked>
                                <label for="monthly-1" class="badge badge-warning py-3 "
                                       style="border-radius: 50em;font-size: 14px;background-color: #088dd3" id="individual">Individual</label>
                                <input type="radio" v-model="type_usage" name="type-usage" value="company" id="annualy-1">
                                <label for="annualy-1" style="border-radius: 50em;font-size: 14px;" id="company">Company</label>
                                <span class="switch d-none"></span>
                            </div>
                            <p>&nbsp;</p>

                            <div class="form-group">
                                <input id="name" type="text" placeholder="Your full name"
                                       class="form-control form-control-lg "
                                       :class="error_name?'is-invalid':''"
                                       v-model="name"
                                       name="name" required autofocus>
                                <span v-if="error_name" class="invalid-feedback" role="alert">
                                        <strong>{{ error_name }}</strong>
                                        </span>
                            </div>

                            <div class="form-group">
                                <input id="mobile" type="tel" placeholder="Your phone number"
                                       class="form-control form-control-lg"
                                       :class="error_mobile?'is-invalid':''"
                                       v-model="mobile"
                                       name="mobile"  required autofocus>
                                <span v-if="error_mobile" class="invalid-feedback" role="alert">
                                        <strong>{{ error_mobile }}</strong>
                                        </span>
                           </div>

                            <div class="form-group">
                                <input id="email" type="email" placeholder="Your Email"
                                       v-model="email"
                                       class="form-control form-control-lg "
                                       :class="error_email?'is-invalid':''"
                                       name="email" required autofocus>
                                <span v-if="error_email" class="invalid-feedback" role="alert">
                                        <strong>{{ error_email }}</strong>
                                        </span>
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Your Password"
                                       class="form-control form-control-lg"
                                       v-model="password"
                                       :class="error_password?'is-invalid':''"
                                       name="password"  required autofocus>
                                <span v-if="error_password" class="invalid-feedback" role="alert">
                                        <strong>{{ error_password }}</strong>
                                        </span>

                            </div>

                            <div class="form-group">
                                <input id="password_confirmation" type="password" placeholder="Your password again"
                                       class="form-control form-control-lg "
                                       v-model="password_confirmation"
                                       :class="error_password_confirmation?'is-invalid':''"
                                       name="password_confirmation"
                                       required autofocus>
                                <span v-if="error_password_confirmation" class="invalid-feedback" role="alert">
                                        <strong>{{ error_password_confirmation }}</strong>
                                        </span>
                            </div>

                            <input type="hidden" name="language" value="en">

                            <button type="button" @click="register">Signup</button>
                            <br>
                        </form>
                        <form v-if="showSmsCodePart" >

                            <div >
                                <p>please enter verification code you receive on your phone</p>

                            </div>

                            <div class="form-group">
                                <input id="code" type="text" placeholder="enter code"
                                       class="form-control form-control-lg "
                                       :class="error_code?'is-invalid':''"
                                       v-model="code"
                                       name="name" required autofocus>
                                <span v-if="error_code" class="invalid-feedback" role="alert">
                                        <strong>{{ error_code }}</strong>
                                        </span>
                            </div>
                            <button type="button" @click="verifyCode">verify</button>
                            <br>
                        </form>
                        <p v-if="countDown !== 0 && showSmsCodePart">00:{{countDown}}</p><a v-if="countDown===0" href="#" @click="resendCode">أعد إرسال الرمز</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'sign-up',
        props:['locale'],
        data(){
            return{
                error_name:'',
                error_mobile:'',
                error_email:'',
                error_password:'',
                error_password_confirmation:'',
                name:'',
                mobile:'',
                email:'',
                password:'',
                password_confirmation:'',
                type_usage:'individual',
                language:'ar',
                verified_office:0,
                company_name:'',
                device_token:'',
                showSmsCodePart:false,
                code:'',
                error_code:'',
                countDown: 59

            }
        },
        created() {
        },
        mounted() {

            setInterval(() => {
                if (this.countDown !==0 && this.showSmsCodePart){
                    this.countDown -= 1

                }
            }, 1000);
        },
        methods:{
            resendCode(){
                this.countDown=59
                this.sendSmsCode()
            },

            register(){
                if (this.password=== this.password_confirmation){
                axios.post('/'+this.locale+'/register',this.$data).then(res => {
                    if (res.data.status===1){
                        this.sendSmsCode();
                    }

                }).catch(err =>{
                    if(err.response.data.errors){
                        if (err.response.data.errors.name){
                            this.error_name=err.response.data.errors.name[0]
                        }
                        if (err.response.data.errors.mobile){
                            this.error_mobile=err.response.data.errors.mobile[0]
                        }
                        if (err.response.data.errors.email){
                            this.error_email=err.response.data.errors.email[0]
                        }
                        if (err.response.data.errors.password){
                            this.error_password=err.response.data.errors.password[0]
                        }

                    }
                });
                }else{
                    this.error_password_confirmation='password and password confirmation are not the same'
                }
            },
            sendSmsCode(){
                axios.post('/'+this.locale+'/sendSmsCode',{'mobile': this.mobile}).then(res => {
                    if (res.data.status===1){
                        this.showSmsCodePart=true
                    }
                });
            },
            verifyCode(){
            if (this.code){
                axios.post('/'+this.locale+'/verifyUserBySmsCode',{'mobile': this.mobile,'code':this.code}).then(res => {
                    if (res.data.status===1){
                        window.location.href='/'
                    }
                }).catch(err =>{
                    if(err.response.data.errors){
                        if (err.response.data.errors.code){
                            this.error_code=err.response.data.errors.code[0]
                        }

                    }
                });
            }else {
                this.error_code='code is required'
            }
            }
        },
        watch:{
            type_usage(){
                console.log(this.type_usage)
                if (this.type_usage === 'individual'){
                    $('#individual').addClass('badge badge-warning py-3').css('background-color','#088dd3')
                    $('#company').removeClass('badge badge-warning py-3').css('background-color','unset')
                }else{
                    console.log('hi')

                    $('#individual').removeClass('badge badge-warning py-3').css('background-color','unset')
                    $('#company').addClass('badge badge-warning py-3').css('background-color','#088dd3')
                }
            }
        }
    }
</script>
