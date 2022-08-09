<template>
    <div class="contact-form">
        <div class="row">
            <div v-if="advertises.length" v-for="advertise in advertises" class="col-lg-4 col-sm-12 col-md-6 f_left">
                <div class="single-listing-item">
                    <div class="listing-image">
                        <a :href="'/advertising/' + advertise.hash_number + '/details'" class="d-block">
                            <img style="height: 200px!important;" :src="advertise.main_image" class="w-100" alt="image">
                        </a>

                        <div class="listing-tag">
                            <a href="#" class="d-block">{{ advertise.type }}</a>
                        </div>
                    </div>
                    <div class="listing-content">
                        <div class="listing-author d-flex align-items-center">
                            <img v-if="user.image_profile" :src="user.image_profile" class="rounded-circle mr-2" alt="image">
                            <img v-else src="/images/main/logo.png" class="rounded-circle mr-2" alt="image">
                            <span>{{ user.name }}</span>
                        </div>

                        <h3><a :href=" '/advertising/' + advertise.hash_number + '/details'" class="d-inline-block">{{ advertise.title_en }}</a></h3>

                        <span class="location"><i class="bx bx-map"></i>{{ advertise.city.name_en + " - " + advertise.area.name_en }}</span>
                    </div>
                    <div class="listing-option-list">
                        <a target="_blank" :href="'/advertising/' + advertise.hash_number + '/direction'"  data-toggle="tooltip" data-placement="top" title="Find Directions"><i
                            class='bx bx-directions'></i></a>
                        <add-to-wishlist :user="auth_user"
                                         :advertising="advertise"
                                         :archived="!!(archived_id && archived_id.includes(advertise.id))"
                        ></add-to-wishlist>
                        <a target="_blank" :href="'/advertising/' + advertise.hash_number + '/location'"  data-toggle="tooltip" data-placement="top" title="On the Map"><i
                            class='bx bx-map'></i></a>
                    </div>

                    <div class="listing-badge">
                        <span v-if="advertise.advertising_type=== 'premium'">Premium</span>
                        <span v-if="advertise.advertising_type=== 'normal'">Normal</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'advertises',
        props: ['user','archived_id','auth_user'],
        data() {
            return {
                advertises:[],
            }
        },
        created() {
            this.getAdvertises()
        },
        mounted() {

        },
        methods: {
            getAdvertises(){
                axios.post('/user/advertises',{'user_id': this.user.id}).then(res => {
                        this.advertises = res.data
                }).catch(err =>{});
            }
        },
    }
</script>
