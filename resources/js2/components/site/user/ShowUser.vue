<template>
    <section class="faq-area ptb-100">
        <div class="container">

            <div class="tab faq-accordion-tab">
                <div class="profile" style="margin: 0 auto 50px auto;text-align: center;">
                    <img v-if="user.image_profile" :src="user.image_profile" class="profile_pic"
                         style="width: 200px;height: 200px;border-radius: 100px;-moz-border-radius: 100px;-webkit-border-radius: 100px;border: solid 5px #088dd3;"
                         alt=""/>
                    <img v-else src="/images/main/logo.png" class="profile_pic"
                         style="width: 200px;height: 200px;border-radius: 100px;-moz-border-radius: 100px;-webkit-border-radius: 100px;border: solid 5px #088dd3;"
                         alt=""/>
                    <br>
                    <div class="profile_text">
                        Full Name : <strong>{{ user.name }}</strong>
                        <i v-if="user.verified === 1" class='bx bxs-badge-check verify'
                           style="color:#088dd3;font-size: 25px "></i>
                        <br/>
<!--                        Balance :-->
<!--                        <strong>-->
<!--                            <a href="ads.html" class="text_blue" style="color:#088dd3; ">-->
<!--                                <span v-if="credit.count_normal_advertising===0 && credit.count_premium_advertising===0" >0 Ads</span>-->
<!--                                <span v-else>-->
<!--                                {{ credit.count_normal_advertising}} Regular Ads + {{ credit.count_premium_advertising }} Premium-->
<!--                                Ads Remaining-->
<!--                               </span>-->
<!--                            </a>-->
<!--                        </strong>-->
                        <br/>
                        Status :
                       <strong v-if="user.is_enable===1" class="text_green"
                                                                       style="color: #00b232">Active</strong>
                         <strong v-else class="text_red" style="color: red">Deactive</strong>

                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                   <advertises v-if="cpAdvertises" :archived_id="archived_id" :user="this.user" :auth_user="auth_user"></advertises>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'show-user',
        props: ['user', 'credit','archived_id','auth_user'],
        data() {
            return {
                cpProfile:false,
                cpAdvertises:true

            }
        },
        created() {
        },
        mounted() {

        },
        methods: {
            showProfile(){
                this.cpProfile=true;
                this.cpAdvertises=false;
            },
            showAdvertises(){
                this.cpProfile=false;
                this.cpAdvertises=true;
            }

        },
    }
</script>
