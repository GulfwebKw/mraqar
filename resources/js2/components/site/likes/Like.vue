<template>
    <div class="d-inline-block">
        <a v-if="!vue_liked"  data-toggle="tooltip" data-placement="top" title="like" style="cursor: pointer" @click="like">
            <i  class='bx bx-like'></i></a>
        <a v-if="vue_liked"  data-toggle="tooltip" data-placement="top" title="you liked this advertising" style="cursor: pointer">
            <i @click="unlikeAd"   class='bx bx-like' style="color: dodgerblue;cursor: pointer"></i>
        </a>
        <span>{{locale==='en'?'Likes':'الإعجابات'}}</span>
        <a href="#">{{advertisingLikes}}</a>
    </div>
</template>

<script>
    export default {
        name:'like',
        props:['advertising','user','liked','locale'],
        data(){
            return{
                error_code:'',
                vue_liked:this.liked?this.liked:false,
                advertisingLikes:this.advertising.advertising_likes.length
            }
        },
        created() {

        },
        mounted() {

        },
        methods:{
            like(){
                if (this.user && !this.liked){
                    axios.post('/'+this.locale+'/like-advertising',{'advertising_id': this.advertising.id}).then(res => {
                        if (res.data.status===1){
                            this.vue_liked = true
                            this.advertisingLikes +=1;
                        }
                    }).catch(err =>{});
                }else {
                    this.error_code = 'please login first'
                    swalError(this.error_code)
                }
            },
            unlikeAd(){
                if (this.user  ){
                    axios.post('/'+this.locale+'/unlike-advertising',{'advertising_id': this.advertising.id}).then(res => {
                        if (res.data.status===1){
                            this.vue_liked = false
                            this.advertisingLikes -=1;
                        }
                    }).catch(err =>{});
                }else {
                    this.error_code = 'please login first'
                    swalError(this.error_code)
                }
            },
        },
    }
</script>
