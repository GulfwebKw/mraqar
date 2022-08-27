<script>
import Multiselect from 'vue-multiselect'

export default {
    name: 'Search',
    components: { Multiselect },
    props: {lang: null},
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

            this.$root.reset()
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
                this.venue_types = [{
                    id: null,
                    title_en: "All",
                    title_ar: "كل",
                }];
                this.venue_types.push(...response.data.data.type);
            })
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.multiselect__tag {
    position: relative;
    display: inline-block;
    padding: 4px 26px 4px 10px;
    border-radius: 5px;
    margin-right: 10px;
    color: #fff;
    line-height: 1;
    background: var(--mdc-theme-primary) !important;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    max-width: 100%;
    text-overflow: ellipsis;
}
.multiselect__tags {
    max-height: 180px;
    overflow-y: auto;
    overflow-x: hidden;
}
.multiselect__option--highlight {
    background: var(--mdc-theme-primary) !important;
    outline: none;
    color: #fff
}
.multiselect__option--highlight:after {
    content: attr(data-select);
    background: var(--mdc-theme-primary);
    color: #fff
}
/* multiselect__option multiselect__option--highlight multiselect__option--selected */
.multiselect__option.multiselect__option--highlight.multiselect__option--selected{
    background: var(--mdc-theme-error) !important;
}
.multiselect__tag-icon:focus, .multiselect__tag-icon:hover {
    background: var(--mdc-theme-error) !important;
}
.multiselect__spinner:after, .multiselect__spinner:before {
    position: absolute;
    content: "";
    top: 50%;
    left: 50%;
    margin: -8px 0 0 -8px;
    width: 16px;
    height: 16px;
    border-radius: 100%;
    border: 2px solid transparent;
    border-top-color: var(--mdc-theme-primary) !important;
    box-shadow: 0 0 0 1px transparent
}

.multiselect__option--group {
    background: var(--mdc-theme-secondary);
    color: white;
}
.multiselect__option--group:before {
    content: "--- ";
}
.multiselect__select::before {
    top: 85%;
}
.multiselect__placeholder{
    margin-bottom: 0;
}
.multiselect__tags {
    padding-top: 6px !important;
    padding-bottom: 6px !important;
}
</style>
