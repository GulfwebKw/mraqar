<Search inline-template>
    <div class="mdc-card main-content-header mb-3" style="height: 500px;">
        <form action="javascript:void(0);" id="filters" class="search-wrapper">
            <div class="row md-flex-no-wrap">
                <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                    <multiselect v-model="areas" :options="options" :multiple="true" group-values="areas" group-label="name_{{ app()->getLocale() }}" :group-select="true" placeholder="Type to search" track-by="id" label="name_{{ app()->getLocale() }}" maxHeight="300"><span slot="noResult">Oops! No elements found. Consider changing the search query.</span></multiselect>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 p-2">
                    <multiselect v-model="venue_type" :options="venue_types" placeholder="Type to search" track-by="id" label="title_{{ app()->getLocale() }}"><span slot="noResult">Oops! No elements found. Consider changing the search query.</span></multiselect>
                </div>

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

                <span class="row center-xs middle-xs p-2 col-md-2 d-md-flex d-lg-flex w-100">
                    <button @click="search()" class="mdc-button mdc-button--raised w-100" type="submit">
                        <span class="mdc-button__ripple"></span>
                        <i class="material-icons mdc-button__icon">search</i>
                        <span class="mdc-button__label">{{__('search')}}</span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</Search>
