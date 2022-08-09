<template>
    <div class="row">
        <div v-for="wishlist in newWishLists" class="col-lg-4 col-sm-12 col-md-6 f_left">
            <div class="single-listing-item">
                <div class="listing-image">

                    <a :href="'/'+locale+'/advertising/' + wishlist.hash_number +'/details'" class="d-block"><img
                        class="w-100 ad-image-responsive" :src="wishlist.main_image" alt="image"></a>


                    <div class="listing-tag">
                        <a href="#" class="d-block">
                            <span v-if="wishlist.type==='residential'">{{locale==='en'?'Residential':'سكني'}}</span>
                            <span v-if="wishlist.type==='industrial'">{{locale==='en'?'Industrial':'صناعي'}}</span>
                            <span v-if="wishlist.type==='commercial'">{{locale==='en'?'Commercial':'تجاري'}}</span>

                        </a>
                    </div>
                </div>

                <div class="listing-content">
                    <div class="listing-author d-flex align-items-center">
                        <img v-if="wishlist.user" :src=" wishlist.user.image_profile" class="rounded-circle mr-2"
                             alt="image">
                        <span v-if="wishlist.user">{{ wishlist.user.name }}</span><i
                        class='bx bxs-badge-check verify'></i>
                    </div>

                    <h3><a :href="'/'+locale+ '/advertising/' + wishlist.hash_number + '/details' "
                           class="d-inline-block ad-text-ellipsis">{{locale==='en'? wishlist.title_en : wishlist.title_ar}}</a></h3>


                    <span class="location"><i class="bx bx-map"></i> {{locale==='en'? wishlist.city.name_en + " - " + wishlist.area.name_en: wishlist.city.name_ar + " - " + wishlist.area.name_ar }}</span>
                </div>

                <div class="listing-box-footer">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="price">
                <span data-toggle="tooltip" data-placement="top" title=" Pricey ">
                    {{locale==='en'?'KD':'ک.د'}} {{ wishlist.price }}
                </span>
                        </div>

                        <div class="listing-option-list">
                            <a target="_blank" :href="'/'+locale+'/advertising/'+wishlist.hash_number+'/direction'"  data-toggle="tooltip" data-placement="top" title="Find Directions"><i
                                class='bx bx-directions'></i></a>
                            <add-to-wishlist :user="user"
                                             :advertising="wishlist"
                                             :archived="!!archived_id.includes(wishlist.id)"
                                             :locale="locale"
                            ></add-to-wishlist>
                            <a target="_blank" :href="'/'+locale+'/advertising/'+wishlist.hash_number+'/location'"  data-toggle="tooltip" data-placement="top" title="On the Map"><i
                                class='bx bx-map'></i></a>
                        </div>
                    </div>
                </div>

                <div class="listing-badge">
                    <span v-if="wishlist.advertising_type === 'premium'">{{locale==='en'?'Premium':'الممتازة'}}</span>
                    <span v-if="wishlist.advertising_type === 'normal'">{{locale==='en'?'Normal':'عادي'}}</span>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'wishlist-index',
        props: ['wishlists', 'user', 'archived_id','locale'],
        data() {
            return {
                error_code: '',
                newWishLists:this.wishlists

            }
        },
        created() {
        },
        mounted() {
            events.$on('add-removed-wishlist', ()=>{
                this.getArchived()
            })
        },
        methods: {
            getArchived() {
                    axios.get('/'+this.locale+'/wishlist',).then(res => {
                        this.newWishLists = res.data.wishLists
                    }).catch(err => {
                    });
            },


        },
    }
</script>
