import Vue from 'vue';
import Card from './../components/Card.vue';
import Search from './../components/Search.vue';
import axios from 'axios';

window.Vue = require('vue');

window.url = '/api/v1/';
window.axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
    el: '#app',
    data () {
        return {
            url: "this is msg",
            cards: null,
            searchVariables: {},
            page: 1,
            maxPage: null,
            isLoading: false,
            companyId: 0,
            isRequiredPage: 0,
        }
    },
    components: {
        Card,
        Search
    },
    methods: {
        getAds() {
            this.isLoading = true ;
            var searchData = this.searchVariables;
            searchData.company_id = this.companyId;
            searchData.isRequiredPage = this.isRequiredPage;

            axios
                .post(window.url + `search-advertising?page=${this.page}`, searchData )
                .then(response => {
                    console.log(response.data);
                    this.maxPage = response.data.data.last_page
                    this.cards = this.response.data.data
                    this.isLoading = false ;
                })
        },
        pageEnd() {
            if ( this.page < this.maxPage && ! this.isLoading ) {
                this.page++;
                this.getAds();
            }
        }
    },
    watch: {
        searchVariables() {
            this.page = 1 ;
            this.maxPage = null ;
            this.getAds()
        }
    },
    mounted() {
        this.companyId =  document.getElementById("app").getAttribute('data-company');
        this.isRequiredPage = document.getElementById("app").getAttribute('data-requiredPage');
        const observer = new IntersectionObserver(
            this.pageEnd,
    { threshold: 1 }
        );
        observer.observe(document.getElementById("pageEnd"));
console.log('here')
        this.getAds();
    }

});

// window.url = 'http://mraqar.test/';
