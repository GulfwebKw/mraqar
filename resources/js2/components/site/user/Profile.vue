<template>
    <div class="contact-form">
         <div class="row">
             <div class="col-12 col-md-6">
                 <div class="listing-sidebar-widget">

                     <div class="listing-contact-info">
                         <h3>Contact Info</h3>

                         <ul>
                             <li style="border-top: unset;!important;"><span>name :</span> <a href="#"> {{user.name}}</a></li>
                             <li><span>Phone :</span> <a href="tel:+965 960123456"> {{user.mobile}}</a>
                             </li>
                             <li><span>Email :</span> <a
                                 href="mailto:info@ajrnii.com"> {{user.email}}</a></li>
                         </ul>
                     </div>

                 </div>
             </div>
         </div>
    </div>
</template>

<script>
    export default {
        name: 'profile',
        props: ['user', 'credit'],
        data() {
            return {}
        },
        created() {

        },
        mounted() {

        },
        methods: {},
    }
</script>
