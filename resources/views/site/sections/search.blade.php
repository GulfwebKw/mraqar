<Search ref="search"
        :trans="{to: '{{__('search_to')}}', kuwait: '{{__('search_kuwait')}}', in: '{{__('search_in')}}', ad: '{{__('search_ad')}}', search_and_more: '{{__('search_and_more')}}', and: '{{__('and')}}'}"
        lang="{{app()->getLocale()}}"
        :purpose_lang="{rent: '{{ __('rent') }}' ,sell: '{{ __('sell') }}' ,exchange: '{{ __('exchange') }}' ,required_for_rent: '{{ __('required_for_rent') }}', all: '{{__('all')}}' }"
        :areas_count="{{env('SEARCH_AREAS', 2)}}"
        inline-template>
    <div>

        <div v-if="searchTitle" class="blue-search bg-primary blue-search center-xs p-4" style="height: 25px;">
            <span v-text="searchTitle" class="mb-3 text-lg fw-600"></span>
        </div>

        <div class="mdc-card main-content-header mb-3 my-search-box">
            <form action="javascript:void(0);" id="filters" class="search-wrapper">
                <div class="row md-flex-no-wrap justify-content-center">
                    <div class="col-xs-12 col-sm-6 col-md-3 p-2 d-flex align-items-center" id="select_areas">
                        <multiselect v-model="areas" :options="options" @select="onSelect"
                                     placeholder="{{__('areas_filter')}}" selected-label="{{__('selected')}}"
                                     deselect-group-label="{{__('deselect_areas')}}"
                                     select-group-label="{{__('select_all_areas')}}" select-label=""
                                     deselect-label="{{__('deselect')}}" :multiple="true" group-values="areas"
                                     group-label="name_{{ app()->getLocale() }}" :group-select="true" track-by="id"
                                     label="name_{{ app()->getLocale() }}" maxHeight="300"><span
                                slot="noResult">{{__('no_result')}}</span></multiselect>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 p-2 d-flex align-items-center">
                        <multiselect v-model="venue_type" :options="venue_types" placeholder="{{__('venue_filter')}}"
                                     selected-label="{{__('selected')}}" select-label=""
                                     deselect-label="{{__('deselect')}}" track-by="id"
                                     label="title_{{ app()->getLocale() }}" :searchable="false"><span
                                slot="noResult">{{__('no_result')}}</span></multiselect>
                    </div>
                    @if( ! isset($required_for_rent) )
                        <div class="col-xs-12 col-md-4 mb-2 p-0 d-flex justify-center">
                            <div class="mdc-form-field">
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="rent"
                                           name="purpose" value="rent">
                                    <div class="mdc-radio__background">
                                        <div class="mdc-radio__outer-circle"></div>
                                        <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                </div>
                                <label for="rent">{{__('rent')}}</label>
                            </div>
                            <div class="mdc-form-field">
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="sell"
                                           name="purpose" value="sell">
                                    <div class="mdc-radio__background">
                                        <div class="mdc-radio__outer-circle"></div>
                                        <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                </div>
                                <label for="sell">{{__('sell')}}</label>
                            </div>
                            <div class="mdc-form-field">
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="exchange"
                                           id="exchange" name="purpose" value="exchange">
                                    <div class="mdc-radio__background">
                                        <div class="mdc-radio__outer-circle"></div>
                                        <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                </div>
                                <label for="exchange">{{__('exchange')}}</label>
                            </div>
                        </div>
                    @endif
                    <span class="row center-xs middle-xs p-2 col-md-2 d-md-flex d-lg-flex w-100">
                    <button @click="search(true)" class="mdc-button mdc-button--raised w-100" type="submit">
                        <span class="mdc-button__ripple"></span>
                        <i class="material-icons mdc-button__icon">search</i>
                        <span class="mdc-button__label">{{__('search')}}</span>
                    </button>
                </span>
                </div>
            </form>
        </div>
    </div>
</Search>
