<template>

    <div class="home-area">
        <div class="home-slides owl-carousel owl-theme">
            <div class="hero-banner banner-bg2"></div>
            <div class="hero-banner banner-bg3"></div>
            <div class="hero-banner banner-bg4"></div>
        </div>

        <div class="main-banner-content" style="">
            <h1 id="main-banner-heading"><span>{{locale==='en'?'Discover':'اكتشف'}}</span> {{locale==='en'?'Your Property Kuwait City':'عقارك في مدينة الكويت'}}</h1>

            <div class="main-search-wrap">
                <form style="">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <div class="form-group" style="text-align-last: center">
                                <label style="width: fit-content;  color: #088dd3!important;">
                                  <i class='bx bxs-keyboard'></i>
                                </label>
                                <input type="text" v-model="key_word" id="keyword" name="keyword" :placeholder="locale==='en'?'What are you looking for?':'عما تبحث؟'">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group create_advertising_select" style="text-align-last: center">
                                <label style="width: fit-content; color: #088dd3!important;">
                                    <i class='bx bx-current-location'></i>
                                </label>
                                <select name="area_id" id="area" v-model="area"  class="form-control d-block border-0"
                                        style="background:unset!important;color:#7d7d7d!important;border-right:1px solid #eeeeee!important;">
                                    <option selected value="-1">{{locale==='en'?'Select Area':'موقعك'}}</option>
                                    <option v-for="area in areas" :value="area.name_en" >{{locale==='en'? area.name_en : area.name_ar}}</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-6">
                            <div class="form-group create_advertising_select" style="text-align-last: center">
                                <label style="width: fit-content;  color: #088dd3!important;" ><i class='bx bx-slider'></i></label>
                                <select v-model="type" @change="getVenueTypes" name="type" id="type" class="form-control d-block border-0"
                                        style="background: unset!important;color:#7d7d7d!important;border-right: 1px solid #eeeeee!important;">>
                                    <option value="">{{locale==='en'?'All Categories':'جميع الفئات'}}</option>
                                    <option value="residential">
                                        {{locale==='en'?'Residential':'سكني'}}
                                    </option>
                                    <option value="commercial">
                                        {{locale==='en'?'Commercial':'تجاري'}}
                                    </option>
                                    <option value="industrial">
                                        {{locale==='en'?'Industrial':'صناعي'}}
                                    </option>                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group create_advertising_select" style="text-align-last: center">
                                <label style="width: fit-content;  color: #088dd3!important;"><i class='bx bx-current-location'></i></label>
                                <select name="venue_type" v-model="venue_type" id="venueType" class="form-control d-block border-0"
                                        style="background: unset!important;color:#7d7d7d!important;border-right: 1px solid #eeeeee!important;">>
                                    <option value="">{{locale==='en'?'All Types':'كل الانواع'}}</option>
                                         <option v-if="venuetypes.length" v-for="venuetype in venuetypes" :value="venuetype.id">
                                         {{locale==='en'?venuetype.title_en:venuetype.title_ar}}
                                         </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="main-search-btn">
                        <button id="search" type="button" @click="search">{{locale==='en'?'Search':'بحث'}} <i class='bx bx-search-alt'></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'search-section',
        props:['locale'],
        data(){
            return{
                areas:[],
				venuetypes:[],
                type:'' ,
                venue_type:'',
                key_word:'',
                area:-1,

            }
        },
        created() {
            this.getAreas();
			this.getVenueTypes();
        },
        mounted() {

        },
        methods:{
            search(){
                window.location.href='/'+this.locale+'/search?keyword='+this.key_word+'&&area='+this.area+'&&venue_type='+this.venue_type+'&&type='+this.type

            },
            getAreas() {
                axios.get('/'+this.locale+'/get-all-areas').then(res => {
                    this.areas = res.data;
                });
            },
			getVenueTypes() {
                axios.post('/'+this.locale+'/venuetypes', {type_id: this.type}).then(res => {
                    this.venuetypes = res.data;
                });
            },
        },
    }

</script>
