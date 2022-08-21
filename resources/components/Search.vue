<script>
import Multiselect from 'vue-multiselect'

export default {
    name: 'Search',
    components: { Multiselect },
    data () {
        return {
            options: [],
            areas: [],
            venue_types: [],
            venue_type: null,
            purpose: 'all'
        }
    },
    methods: {
        search() {
            var area_ids = this.areas ? this.areas.map(item => item.id) : [] ;

            this.$root.searchVariables = {
                area_id : area_ids,
                venue_type: this.venue_type ? this.venue_type.id : null ,
                purpose: this.purpose
            }
        }
    },
    mounted () {
        axios
            .get(window.url + 'cities')
            .then(response => {
                this.options  = response.data.data;
            })
        axios
            .get(window.url + 'get-search-property')
            .then(response => {
                this.venue_types  = response.data.data.type;
            })
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
