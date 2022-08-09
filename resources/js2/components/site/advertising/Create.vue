<template>
    <div class="row">
        <div v-if="showFirstPage" class="col-12">
<!--            <uploader :options="options" class="uploader-example">-->
<!--                <uploader-unsupport></uploader-unsupport>-->
<!--                <uploader-drop>-->
<!--                    <p>Drop files here to upload or</p>-->
<!--                    <uploader-btn>select files</uploader-btn>-->
<!--                </uploader-drop>-->
<!--                <uploader-list></uploader-list>-->
<!--            </uploader>-->
            <div class="row">
                <div class="col-12">
                    <h4><span v-if="locale==='en'">ADVERTISE TYPE</span>
                        <span v-else>نوع الإعلان</span>
                        <span class="text-danger"> *</span></h4>
                </div>
                <div class="col-6 bg-white p-3 rounded">
                    <div class="form-group">
                        <input type="radio"
                               class="d-inline-block  mt-2"
                               style="opacity: 1"
                               name="advertise_type"
                               v-model="advertising_type"
                               value="normal"
                               :disabled="!credit_user.count_normal_advertising || credit_user.count_normal_advertising===0"
                               required>
                        <span class="text-dark ml-4 " v-if="locale==='en'">Normal</span>
                        <span class="text-dark ml-4 mr-4" v-else>عادي</span>
                        <span v-if="locale==='en'" class="float-right "
                              :class="credit_user.count_normal_advertising && credit_user.count_normal_advertising>0?'text-success':'text-danger'"
                        >{{credit_user.count_normal_advertising?credit_user.count_normal_advertising:'0'}} ad remaining</span>
                        <span v-else class="float-left "
                              :class="credit_user.count_normal_advertising && credit_user.count_normal_advertising>0?'text-success':'text-danger'"
                        >{{credit_user.count_normal_advertising?credit_user.count_normal_advertising:'0'}} الإعلان المتبقي</span>
                    </div>
                    <div class="form-group">
                        <input type="radio"
                               class="d-inline-block mt-2 "
                               style="opacity: 1"
                               name="advertise_type"
                               v-model="advertising_type"
                               value="premium"
                               :disabled="!credit_user.count_premium_advertising || credit_user.count_premium_advertising===0"
                               required>
                        <span class="text-dark  ml-4" v-if="locale==='en'">Premium</span>
                        <span class="text-dark  mr-4" v-else>الممتازة</span>
                        <span class="float-right" v-if="locale==='en'"
                              :class="credit_user.count_premium_advertising && credit_user.count_premium_advertising>0?'text-success':'text-danger'"
                        >{{credit_user.count_premium_advertising ? credit_user.count_premium_advertising : '0'}}   ad remaining</span>
                        <span class="float-left" v-else
                              :class="credit_user.count_premium_advertising && credit_user.count_premium_advertising>0?'text-success':'text-danger'"
                        >{{credit_user.count_premium_advertising ? credit_user.count_premium_advertising : '0'}}  الإعلان المتبقي</span>

                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4 v-if="locale==='en'">PERSONAL INFORMATION</h4>
                    <h4 v-else>معلومات شخصية</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="w-100" v-if="locale==='en'" >FULLNAME<span class="text-danger">*</span></label>
                                <label class="w-100" v-else >الاسم الكامل<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="text" :value="user.name" class="form-control"
                                       disabled>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <div class="form-group">
                                <label class="w-100" v-if="locale==='en'" >PHONE NUMBER<span class="text-danger">*</span></label>
                                <label class="w-100" v-else >رقم الهاتف <span class="text-danger">*</span></label>
                                <input type="email" name="number" :value="user.mobile" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="w-100">EMAIL <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" :value="user.email" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4 v-if="locale==='en'">AREA INFORMATION</h4>
                    <h4 v-else>معلومات المنطقة
                    </h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group create_advertising_select">
                                <label class="w-100" v-if="locale==='en'">CITY<span class="text-danger">*</span></label>
                                <label class="w-100"  v-else>مدينة<span class="text-danger">*</span></label>
                                <select @change="getAreas" v-model="city_id" name="email"
                                        class="form-control d-block first_page_required">
                                    <!--                                    <option value="">1</option>-->
                                    <option v-if="cities.length" v-for="city in cities" :value="city.id">
                                        {{locale==='en'?city.name_en:city.name_ar}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <div class="form-group create_advertising_select">
                                <label class="w-100" v-if="locale==='en'">AREA <span class="text-danger">*</span></label>
                                <label class="w-100" v-else>منطقة <span class="text-danger">*</span></label>
                                <select v-model="area_id" name="number"
                                        class="form-control  d-block first_page_required">
                                    <option v-if="areas.length" v-for="area in areas" :value="area.id">
                                        {{locale==='en'? area.name_en:area.name_ar}}
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4 v-if="locale==='en'">PROPERTY DETAILS</h4>
                    <h4 v-else>تفاصيل اوضح</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group create_advertising_select">
                                <label class="w-100" v-if="locale==='en'">CATEGORY<span class="text-danger">*</span></label>
                                <label class="w-100" v-else>الفئة<span class="text-danger">*</span></label>
                                <select v-model="type" @change="getVenueTypes" class="form-control d-block first_page_required ">
                                    <option value="Residential">
                                        {{locale==='en'?'Residential':'سكني'}}
                                    </option>
                                    <option value="Commercial">
                                        {{locale==='en'?'Commercial':'تجاري'}}
                                    </option>
                                    <option value="Industrial">
                                        {{locale==='en'?'Industrial':'صناعي'}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 ">
                            <div class="form-group create_advertising_select">
                                <label class="w-100" v-if="locale==='en'">PROPERTY TYPE <span class="text-danger">*</span></label>
                                <label class="w-100" v-else>نوع الملكية <span class="text-danger">*</span></label>
                                <select v-model="venue_type" class="form-control d-block first_page_required">
                                    <option v-if="venuetypes.length" v-for="venuetype in venuetypes" :value="venuetype.id">
                                        {{locale==='en'?venuetype.title_en:venuetype.title_ar}}
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4 v-if="locale==='en'">DESCRIPTION</h4>
                    <h4 v-else>وصف</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'TITLE':'عنوان'}}<span class="text-danger">*</span></label>
                                <input v-model="title_en" type="text" class="form-control first_page_required">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100">{{locale==='en'?'PRICE(KD)':'السعر (دينار كويتي)'}} <span class="text-danger">*</span></label>
                                <input v-model="price" type="number" class="form-control first_page_required">
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label class="w-100">{{locale==='en'?'DESCRIPTION':'وصف'}}<span class="text-danger">*</span></label>
                                <textarea  style="padding:10px;height:150px;width:100%;border:0;background-color:#f5f5f5;" v-model="description" class="first_page_required"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4>{{locale==='en'?'DETAILS':'تفاصيل'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'NUMBER OF FLOORS':'عدد الطوابق '}}</label>
                                <input v-model="number_of_floor" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100">{{locale==='en'?'AREA(M2)':'المساحة (متر مربع)'}}</label>
                                <input v-model="surface" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'NUMBER OF ROOMS':'عدد الغرف'}}</label>
                                <input v-model="number_of_rooms" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100">{{locale==='en'?'NUMBER OF BATHROOMS':' رقم الحمامات'}} </label>
                                <input v-model="number_of_bathrooms" type="number"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'NUMBER OF MASTER ROOMS':' عدد الغرف الرئيسية'}}</label>
                                <input v-model="number_of_master_rooms" type="number"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100">{{locale==='en'?'NUMBER OF MAID ROOMS ':' عدد غرف الخادمة'}}</label>
                                <input v-model="number_of_miad_rooms" type="number"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'NUMBER OF BALCONY ':'رقم الشرفة'}} </label>
                                <input v-model="number_of_balcony" type="number"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="w-100"> {{locale==='en'?'NUMBER OF PARKING':'عدد مواقف السيارات'}}</label>
                                <input v-model="number_of_parking" type="number"
                                       class="form-control">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4> {{locale==='en'?'AMENITIES':'وسائل الراحة'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">
                        <div @click="addAmenities(amenity.id)" v-if="amenities.length" :id="'amenity-'+amenity.id"
                             v-for="amenity in amenities"
                             class="col-12 col-md-4 text-center alert m-1 "
                             :class="selectedAmenities.some(selectedAmenity => selectedAmenity.id ===amenity.id)? 'alert-success' : 'alert-info'"
                             style="cursor: pointer">
                            <span>{{ locale==='en'?amenity.title_en:amenity.title_ar}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div v-if="first_page_require_error" class="alert alert-danger">
                        {{ locale==='en'?'please fill the require field':'يرجى ملء الحقل المطلوب'}}
                    </div>
                    <button @click="showSecondPage" type="button" class="btn btn-success w-25">
                        {{ locale==='en'?'next':'التالى'}}
                    </button>
                </div>
            </div>
        </div>
        <div v-if="!showFirstPage" class="col-12">
            <form class="row">
                <div class="col-12 mt-3">
                    <h4> {{ locale==='en'?'UPLOAD PHOTO':'حمل الصورة'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="row">

                        <div class="col-12">
                            <img v-if="mainImageRender" style="width: 50px; height: 50px" :src="mainImageRender"
                                 class="uploading-image"/>
                            <div class="form-group">
                                <label class="w-100" > {{ locale==='en'?'Main Photo':' الصورة الرئيسية'}} <span>*</span></label>
                                <input autofocus @change="uploadMainImage" type="file" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div v-for="otherPhotoCount in otherPhotoCounts" class="col-4 bg-white p-3 rounded">
                            <img v-if="otherImageRender.length && otherImag.id === otherPhotoCount"
                                 v-for="otherImag in otherImageRender"
                                 style="width: 50px; height: 50px" :src="otherImag.image" class="uploading-image"/>
                            <div class="form-group">
                                <label class="w-100"> {{ locale==='en'?' Photo':' صورة فوتوغرافية'}} {{otherPhotoCount}} </label>
                                <input @change="UploadOtherImage(otherPhotoCount,$event)" type="file" name="name"
                                       :id="'other_photo'+ otherPhotoCount"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4> {{ locale==='en'?' UPLOAD VIDEO':' رفع فيديو'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div class="form-group">
                        <label class="w-100"> {{ locale==='en'?' Add Video < $40MB':' أضف فيديو < $40MB'}} </label>
                        <input @change="uploadVideo" type="file" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4>{{ locale==='en'?'UPLOAD FLOOR PLAN':' تحميل مخطط الطابق'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <img v-if="floorImageRender" style="width: 50px; height: 50px" :src="floorImageRender"
                         class="uploading-image"/>
                    <div class="form-group">
                        <label class="w-100"> {{ locale==='en'?'Add Floor Plan':' أضف مخطط الطابق'}} </label>
                        <input @change="uploadFloorImage" type="file" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <h4> {{ locale==='en'?'LOCATION':' موقعك'}}</h4>
                </div>
                <div class="col-12 bg-white p-3 rounded">
                    <div id="vue-map" style="height: 200px">
                        <map-location-selector :latitude=lat :longitude=long
                                               @locationUpdated="locationUpdated">
                        </map-location-selector>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div v-if="second_page_require_error" class="alert alert-danger">
                        {{ locale==='en'?'please fill the require field':'يرجى ملء الحقل المطلوب'}}
                    </div>
                    <span v-if="isLoading">
                      {{ locale==='en'?'please wait...':'ارجوك انتظر...'}}</span>
                    <button @click="submit" :v-if="!isLoading" type="button" class="btn btn-success w-25"
                            :class="locale==='en'?'float-left':'float-right'">
                        {{ locale==='en'?'submit':'إرسال'}}</button>
                    <button @click="showFirstPage=true" type="button" class="btn btn-outline-danger  w-25"
                    :class="locale==='en'?'float-right':'float-left'">
                        {{ locale==='en'?'back':'عودة'}}</button>

                </div>
            </form>
        </div>

    </div>
</template>
<script>

    import mapLocationSelector from 'vue-google-maps-location-selector'


    export default {
        name: 'create',
        components: {mapLocationSelector},
        props: ['user','locale'],
        data() {
            return {
                lat:29.368570 ,////this is long in component
                long: 47.972832,/////// this is lat in component
                location_lat: 0,
                location_long: 0,
                cities: [],
                areas: [],
                type: 'residential',
                venue_type: '',
				venuetypes:[],
                showFirstPage: true,
                amenities: [],
                selectedAmenities: [],
                city_id: '',
                otherPhotoCounts: 6,
                mainImage: '',
                otherImage: [],
                floor_plan: '',
                video: '',
                advertising_type: '',
                title_en: '',
                price: '',
                description: '',
                number_of_floor: '',
                surface: '',
                number_of_rooms: '',
                number_of_bathrooms: '',
                number_of_master_rooms: '',
                number_of_miad_rooms: '',
                number_of_balcony: '',
                number_of_parking: '',
                area_id: '',
                first_page_require_error: false,
                second_page_require_error: false,
                gym: 0,
                pool: 0,
                furnished: 0,
                security: 0,
                floorImageRender: '',
                mainImageRender: '',
                otherImageRender: [],
                credit_user: [],
                csrf: $('meta[name="csrf-token"]').attr('content'),
                options: {
                    // https://github.com/simple-uploader/Uploader/tree/develop/samples/Node.js
                    target: '/upload-video',
                    testChunks: false,
                    // chunks:false,
                    chunkSize:50000000,
                    headers:{
                        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content
                    }
                },
                attrs: {
                    accept: 'image/*'
                },
                isLoading:false,

            }
        },
        created() {
            this.getCities();
            this.getAmenities();
            this.getCreditUser();
        },
        methods: {
            submit() {
                if (this.mainImage ) {
                    const data = new FormData();
                    data.append('city_id', this.city_id);
                    data.append('area_id', this.area_id);
                    data.append('type', this.type);
                    data.append('venue_type', this.venue_type);
                    data.append('advertising_type', this.advertising_type);
                    data.append('description', this.description);
                    data.append('price', this.price);
                    data.append('title_en', this.title_en);
                    data.append('number_of_rooms', this.number_of_rooms);
                    data.append('number_of_bathrooms', this.number_of_bathrooms);
                    data.append('number_of_master_rooms', this.number_of_master_rooms);
                    data.append('number_of_parking', this.number_of_parking);
                    data.append('number_of_balcony', this.number_of_balcony);
                    data.append('number_of_miad_rooms', this.number_of_miad_rooms);
                    data.append('surface', this.surface);
                    data.append('location_lat', this.location_lat);
                    data.append('location_long', this.location_long);
                    data.append('gym', this.gym);
                    data.append('pool', this.pool);
                    data.append('furnished', this.furnished);
                    data.append('security', this.security);
                    data.append('floor_plan', this.floor_plan);
                    data.append('main_image', this.mainImage);
                    data.append('video', this.video);
                    data.append('selectedAmenities', JSON.stringify(this.selectedAmenities));
                    for (var i = 1; i <= this.otherImage.length; i++) {
                        data.append('other_image' + i, this.otherImage[i - 1].image);
                    }
                    this.isLoading = true
                    axios.post('/'+this.locale+'/advertising/store', data).then(res => {
                        if (res.data.status === 1) {
                            this.isLoading = false
                            swalSuccess('advertising created successfully');
                            window.location.href='/'+this.locale+'/myads'
                        }
                    });
                } else {
                    this.second_page_require_error = true
                }
            },
            showSecondPage() {
                var mpty = $('.first_page_required').filter(function () {
                    return this.value === ''
                });
                if (mpty.length === 0 && this.advertising_type) {
                    this.showFirstPage = false
                } else {
                    this.first_page_require_error = true
                }
            },
            locationUpdated(latlng) {
                this.location_lat = latlng.lat;
                this.location_long = latlng.lng;
            },
            getCities() {
                axios.get('/'+this.locale+'/cities').then(res => {
                    this.cities = res.data;
                });
            },
            getCreditUser() {
                axios.get('/'+this.locale+'/get-credit-user').then(res => {
                    if (res.data.status === 1) {
                        this.credit_user = res.data.data;
                    }
                });
            },
            getAreas() {
                axios.post('/'+this.locale+'/areas', {city_id: this.city_id}).then(res => {
                    this.areas = res.data;
                });
            },
			getVenueTypes() {
                axios.post('/'+this.locale+'/venuetypes', {type_id: this.type}).then(res => {
                    this.venuetypes = res.data;
                });
            },
            getAmenities() {
                axios.get('/'+this.locale+'/amenities').then(res => {
                    this.amenities = res.data;
                });
            },
            addAmenities(id) {


                let amenity = this.selectedAmenities.filter(amenity => amenity.id === id)

                if (amenity.length) {
                    this.selectedAmenities = this.selectedAmenities.filter(p => p.id !== id)
                } else {
                    this.selectedAmenities.push({
                        id: id
                    })


                }

            },
            uploadVideo(e) {
                const file = e.target.files[0];
                if (!(file.size > 39000000)) {
                    this.video = file;
                } else {
                    e.preventDefault();
                    alert(this.locale==='en'?'file is too big, you cant upload it':'الملف كبير جدًا ، لا يمكنك تحميله')
                }
            },
            uploadMainImage(e) {
                this.mainImage = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(this.mainImage);
                reader.onload = e => {
                    this.mainImageRender = e.target.result;
                };
            },
            uploadFloorImage(e) {
                var image = e.target.files[0];
                this.floor_plan = image
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.floorImageRender = e.target.result;
                };

            },
            UploadOtherImage(id, e) {
                if (this.otherImage.length) {
                    var imges = this.otherImage.filter(image => image.id !== id)
                    this.otherImageRender = this.otherImageRender.filter(image => image.id !== id)
                    this.otherImage = imges;
                }
                var image = e.target.files[0];
                this.otherImage.push({
                    id: id,
                    image: image
                })
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.otherImageRender.push({
                        id: id,
                        image: e.target.result
                    })
                };

            },


        },
        computed: {
            commercial_shop() {
                if (this.type === 'commercial' && this.venue_type === 'shop') {
                    return true;
                } else return false
            },
            commercial_office() {
                if (this.type === 'commercial' && this.venue_type === 'office') {
                    return true;
                } else return false
            },
            commercial_land() {
                if (this.type === 'commercial' && this.venue_type === 'land') {
                    return true;
                } else return false
            },
            commercial_building() {
                if (this.type === 'commercial' && this.venue_type === 'building') {
                    return true;
                } else return false
            },
            industrial_shop() {
                if (this.type === 'industrial' && this.venue_type === 'shop') {
                    return true;
                } else return false
            },
            industrial_office() {
                if (this.type === 'industrial' && this.venue_type === 'office') {
                    return true;
                } else return false
            },
            industrial_building() {
                if (this.type === 'industrial' && this.venue_type === 'building') {
                    return true;
                } else return false
            },


        },
        mounted() {

        },
    }
</script>
<style>
    .uploader-example {
        width: 880px;
        padding: 15px;
        margin: 40px auto 0;
        font-size: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .4);
    }
    .uploader-example .uploader-btn {
        margin-right: 4px;
    }
    .uploader-example .uploader-list {
        max-height: 440px;
        overflow: auto;
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>
