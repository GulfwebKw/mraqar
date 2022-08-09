<template>

	<form>
	    <div class="form-group">
	        <label class="w-100">{{locale==='en'?'Name':'اسم'}}: <span class="text-danger">*</span></label>
	        <input v-model="list.name" type="text" class="form-control">
	    </div>

	    <div class="form-group">
	        <label class="w-100">Email: <span class="text-danger">*</span></label>
	        <input v-model="list.email" type="email" class="form-control">
	    </div>

	    <div class="form-group">
	        <label class="w-100">{{locale==='en'?'Phone Number':'رقم الهاتف'}}: <span class="text-danger">*</span></label>
	        <input v-model="list.mobile" type="text" class="form-control">
	    </div>

<!--	    <div class="form-group">-->
<!--	        <label>Persons: <span class="text-danger">*</span></label>-->
<!--	        <number-input v-model="list.persons" :min="1" :center="true" controls />-->
<!--	    </div>-->

	    <div class="form-group">
	        <label class="w-100">{{locale==='en'?'Date ':' تاريخ'}}: <span class="text-danger">*</span></label>
	        <date-picker :auto-submit="true" :timezone="true" v-model="list.date" :locale="'en'" format="YYYY/MM/DD" :placeholder="locale==='en'?'Select a date ':' اختر التاريخ'"/>
	    </div>

	   <div class="form-group">
	        <label class="w-100">{{locale==='en'?'Time ':' زمن'}}: <span class="text-danger">*</span></label>
	        <timepicker :auto-submit="true" close-on-complete  format="hh:mm A"  inputWidth="100%" v-model="list.time" name="list.time" id="list.time"  type="time" :placeholder="locale==='en'?'Select a time ':' اختر وقتًا'"/>
	    </div>

	    <div class="form-group">
	        <label class="w-100">{{locale==='en'?'Write Message ':' اكتب رسالة'}}:</label>
	        <textarea v-model="list.message" class="form-control" cols="30" rows="5"></textarea>
	    </div>

	    <span v-if="isLoading">{{locale==='en'?'please wait... ':'  ارجوك انتظر...'}}</span>

	    <a v-else @click="send" :disabled="isLoading" class="btn default-btn text-white">
	    	<span> {{locale==='en'?'Book':'كتاب'}}</span>
	    </a>
	</form>
</template>
<script>

    import VueNumberInput from '@chenfengyuan/vue-number-input'
	import VuePersianDatetimePicker from 'vue-persian-datetime-picker'
	import 'vue-toast-notification/dist/theme-default.css'
	
    import  VueTimepicker from 'vue2-timepicker'
    import 'vue2-timepicker/dist/VueTimepicker.css'

	export default{
		data: () => ({
			list:{
				persons:1,
				time:''
			},
			isLoading:false,
			login:false
		}),
		methods:{
			send(){
				var app = this

				if (! app.login) {
					window.location.href = "/register"
				}
				else{
					const list = app.list
					app.isLoading = true
					if (list.name && list.email && list.mobile && list.persons && list.date && list.time) {
					   
						axios.post('/'+app.locale+'/advertising/'+ app.advertisin.hash_number + '/booking' , app.list)
							.then((res) => {
								if (res.data.status == 200) {
									//window.location.href='/'+app.locale+'/bookings'
									app.clearList()
									app.alert('<font color="#ffffff">You have successfully booked the appointment.Our staff will review the details and get back to you.</font>' , 'success')
								}
								app.isLoading = false
							})
							.catch((error) => {
								app.isLoading = false
								app.alert('error' , 'error')
								console.log(error)
							})
					}
					else{
						app.alert('<font color="#ffffff">Please fill in the required fields.</font>' , 'error')
					}
				}
			},
			clearList(){
				var app = this
				var newList     = app.list
				newList.name    = app.user.name
				newList.email   = app.user.email
				newList.mobile  = app.user.mobile
				newList.persons = 1
				newList.date    = null
				newList.time    = null
				newList.message = null
			},
			alert(message , type){
                Vue.$toast.open({
                    duration:4000,
                    position: 'bottom-right',
                    message: message,
                    type: type,
                    // all other options
                });
			}
		},
		props:{

			advertisin:{
				type : [Object,Array]
			},

			user:{
				type : [Object,Array]
			},
            locale:{
			    type:[String]
            }

		},
		components: {'number-input' : VueNumberInput , 'date-picker' : VuePersianDatetimePicker , 'timepicker':VueTimepicker },
		async created(){
			if (this.user) {
				this.login  = true
				var list    = this.list
				list.name   = this.user.name
				list.email  = this.user.email
				list.mobile = this.user.mobile
			}
		}
	}
</script>
<style>
	.vpd-icon-btn {
	
	    display: table-cell !important;
	    width: 11% !important;
	    cursor: pointer !important;
	    padding: 0 10px !important;
	    height: 25px !important;
	    border-radius: 4px !important;
	}

</style>
