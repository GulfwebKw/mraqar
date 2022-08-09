<template>

    <div class="listing-review-comments">
        <h3>
            <span>{{comments.length}} {{locale==='en'?'Reviews':'المراجعات'}}</span>
        </h3>

        <div v-if="comments.length" v-for="comment in comments" class="user-review">
            <img v-if="comment.user.image_profile" :src="comment.user.image_profile" alt="image">
            <img v-else src="/images/main/logo.png" alt="image">

            <div class="review-rating">
                <span class="d-inline-block">{{comment.user.name}}</span>
            </div>

            <span class="d-block sub-comment"></span>
            <p>{{comment.comment}}</p>
        </div>
        <div class="mt-3">
            <h6> {{locale==='en'?'write your comment here':'أكتب تعليقك هنا'}}</h6>
            <form action="">
                <div class="form-group">
                    <textarea  :placeholder="locale==='en'?'comment.... ':' تعليق....'"
                           class="form-control form-control-lg "
                           :class="error?'is-invalid':''"
                           v-model="comment"
                               name="name" required ></textarea>
                    <span v-if="error" class="invalid-feedback" role="alert">
                                        <strong>{{ error }}</strong>
                                        </span>
                </div>
		
                <button type="button" class="btn btn-success" @click="send">{{locale==='en'?'Send':'إرسال'}}</button>
                <div v-if="show_success" class="alert alert-success mt-2">
                    <span>{{locale==='en'?'your comment send successfully':'تعليقك أرسل بنجاح'}} </span>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name:'comment',
        props:['advertising','user','locale'],
        data(){
            return{
                error_code:'',
                comments:this.advertising.comments,
                comment:'',
                error:'',
                show_success:false,
            }
        },
        created() {
		
        },
        mounted() {

        },
        methods:{
            send(){
                if (this.user ){
                    if (this.comment){
                    axios.post('/'+this.locale+'/add-comment',{'advertising_id': this.advertising.id,'comment':this.comment}).then(res => {
                        if (res.data.status===1){
                            this.getComments()
                            this.comment=''
                            this.show_success=true;


                        }
                    }).catch(err =>{});
                    }else{
                        this.error='please fill the input'

                    }
                }else {
                    this.error='please login first'
                }
            },
            getComments(){
                axios.post('/'+this.locale+'/get-comment',{'advertising_id': this.advertising.id}).then(res => {
                this.comments=res.data
                }).catch(err =>{});
            }
        },
    }
</script>
