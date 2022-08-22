<Search inline-template>
    <div class="mdc-card main-content-header mb-3">
        <form action="javascript:void(0);" id="filters" class="search-wrapper">
            <div class="row md-flex-no-wrap justify-content-center">
                <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                    <multiselect v-model="areas" :options="options"  placeholder="{{__('areas_filter')}}" selected-label="{{__('selected')}}" select-group-label="{{__('select_all_areas')}}" select-label="" deselect-label="" :multiple="true" group-values="areas" group-label="name_{{ app()->getLocale() }}" :group-select="true" track-by="id" label="name_{{ app()->getLocale() }}" maxHeight="300"><span slot="noResult">{{__('no_result')}}</span></multiselect>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                    <multiselect v-model="venue_type" :options="venue_types" placeholder="{{__('venue_filter')}}" selected-label="{{__('selected')}}" select-label="" deselect-label="" track-by="id" label="title_{{ app()->getLocale() }}"><span slot="noResult">{{__('no_result')}}</span></multiselect>
                </div>
                @if( ! isset($required_for_rent) )
                <div class="col-xs-12 col-md-4 mb-2 p-0 d-flex justify-center">
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="rent" name="purpose" value="rent">
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                        </div>
                        <label for="rent">{{__('rent')}}</label>
                    </div>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="sell" name="purpose" value="sell">
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                        </div>
                        <label for="sell">{{__('sell')}}</label>
                    </div>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" v-model="purpose" id="exchange" name="purpose" value="exchange">
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
</Search>
