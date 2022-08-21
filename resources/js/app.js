import Vue from 'vue';
import Card from './../components/Card.vue';
import Search from './../components/Search.vue';
import axios from 'axios';

window.Vue = require('vue');

window.url = '/api/v1/';
window.axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-localization'] = document.getElementById("app").getAttribute('data-locale');


var filter = function(text, length, clamp){
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
};

Vue.filter('truncate', filter);


new Vue({
    el: '#app',
    data () {
        return {
            url: "this is msg",
            cards: [],
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
                    console.log(response.data.data);
                    this.maxPage = response.data.data.last_page;
                    console.log('lllllllll')
                    this.cards.push(...response.data.data.data);
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

        this.getAds();
    }

});

// window.url = 'http://mraqar.test/';
