<template>
  <form >
    <div class="row">
      <div class="col-lg-3 col-md-12">
        <div class="form-group">
          <label style="width: fit-content;"><i class='bx bxs-keyboard'></i></label>
          <input type="text" id="keyword" name="keyword" placeholder="{{__('what_are_u_looking_title')}}">
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="form-group">
          <label style="width: fit-content;"><a href="#"><i class='bx bx-current-location'></i></a></label>
          <select name="area_id" id="area"  class="form-control">
            <option value="-1">{{__('select_area_title')}}</option>
            @foreach($areas as $area)
            <option value="{{$area->name_en}}">{{app()->getLocale()=='en'?$area->name_en:$area->name_ar}}</option>

            @endforeach
          </select>
        </div>
      </div>


      <div class="col-lg-3 col-md-6">
        <div class="form-group">
          <label style="width: fit-content;"><i class='bx bx-slider'></i></label>
          <select v-model="type" name="type" id="type">
            <option value="">{{__('all_categories_title')}}</option>
            @foreach(\App\Models\Advertising::TYPES as $key=>$type)
            <option value="{{$type}}">{{$type}} </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="form-group">
          <label style="width: fit-content;"><i class='bx bx-current-location'></i></label>
          <select name="venue_type" id="venueType" class="form-control">
            <option value="">{{__('all_types_title')}}</option>
          </select>
        </div>
      </div>
    </div>

    <div class="main-search-btn">
      <button id="search" type="button" onclick="search">{{__('search')}} <i class='bx bx-search-alt'></i></button>
    </div>
  </form>
</template>
<script>
  export default {
    data:() =>({
      type : null,
    }),
    async created(){
	this.getVenueTypes();
    },
    methods:{
			getVenueTypes() {
                axios.post('/'+this.locale+'/venuetypes', {type_id: this.type}).then(res => {
                    this.venuetypes = res.data;
                });
            },
    }
  }
</script>