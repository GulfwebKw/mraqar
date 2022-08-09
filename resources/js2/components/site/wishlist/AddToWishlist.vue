<template>
    <div class="d-inline-block">
        <a v-if="!vue_archived"  data-toggle="tooltip" data-placement="top" title="add wishlist" style="cursor: pointer"
           @click="addToArchive">
            <i class='bx bx-heart' :style=" lg_class ? 'font-size: 40px!important;' :''" style="color: red"></i></a>
        <a v-if="vue_archived" data-toggle="tooltip" data-placement="top" title="remove wishlist" style="cursor: pointer"
           @click="removeFromArchive">
            <i class='bx bxs-heart' :style="lg_class ? 'font-size: 40px!important;' : ''" style="color: red"></i></a>
    </div>
</template>

<script>
    export default {
        name: 'add-to-wishlist',
        props: ['archived', 'advertising', 'user', 'lg_class','locale'],
        data() {
            return {
                error_code: '',
                vue_archived: !!this.archived,
            }
        },
        created() {
        },
        mounted() {

        },
        methods: {
            addToArchive() {
                if (this.user) {
                    axios.post('/'+this.locale+'/archive-advertising/add', {'advertising_id': this.advertising.id}).then(res => {
                        if (res.data.status === 1) {
                            events.$emit('add-removed-wishlist')
                            this.vue_archived = true
                        }
                    }).catch(err => {
                    });
                } else {
                    this.error_code = 'please login first'
                   swalError(this.error_code)
                }
            },
            removeFromArchive() {
                if (this.user) {
                    axios.post('/'+this.locale+'/archive-advertising/remove', {'advertising_id': this.advertising.id}).then(res => {
                        if (res.data.status === 1) {
                            events.$emit('add-removed-wishlist')
                            this.vue_archived = false
                        }
                    }).catch(err => {
                    });
                } else {
                    this.error_code = 'please login first'
                    swalError(this.error_code)
                }
            },

        },
    }
</script>
