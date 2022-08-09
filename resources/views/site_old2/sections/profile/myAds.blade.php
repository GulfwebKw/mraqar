@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>{{__('success_title')}}!</strong> {{__('ad_delete_success_title')}} !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>{{__('un_success_title')}}!</strong> {{__('un_success_alert_title')}} !
    </div>
@endif

<div class="row">
    @foreach($ads as $ad)
        <div class="col-lg-4 col-sm-12 col-md-6 f_left">
            <div class="single-listing-item">
                <div class="listing-image">
                    <a href="{{ '/'.app()->getLocale().'/advertising/' . $ad->hash_number . '/details' }}"
                       class="d-block"><img  src="{{ asset($ad->main_image) }}"
                                            class="w-100 ad-image-responsive" alt="image"></a>


                    <div class="listing-tag">
                        <a href="#" class="d-block  ad-text-ellipsis">
                            @if (app()->getLocale()=='ar')
                                @if ($ad->type =='residential')
                                    {{__('residential_title')}}
                                @elseif($ad->type =='industrial')
                                    {{__('industrial_title')}}
                                @elseif($ad->type =='commercial')
                                    {{__('commercial_title')}}
                                @endif
                            @else
                                {{ $ad->type }}
                            @endif</a>
                    </div>
                </div>

                <div class="listing-content">
                    <div class="listing-author d-flex align-items-center">
                        <img src="{{ asset($ad->user->image_profile) }}" class="rounded-circle mr-2" alt="image">
                        <span>{{ $ad->user->name }}</span>
                    </div>


                    <h3><a href="{{'/'. app()->getLocale(). '/advertising/' . $ad->hash_number . '/details' }}"
                           class="d-inline-block  ad-text-ellipsis">{{ app()->getLocale()==='en'? $ad->title_en : $ad->title_ar}}</a></h3>

                    <span class="location"><i class="bx bx-map"></i>{{ app()->getLocale()==='en'?$ad->city->name_en . " - " . $ad->area->name_en:$ad->city->name_ar . " - " . $ad->area->name_ar }}</span>
                </div>

                <div class="listing-box-footer">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('site.advertising.edit',[app()->getLocale(),$ad->hash_number]) }}"
                           class="default-btn">{{__('edit_title')}}</a>
                        <!--<button type="submit" class="default-btn">Edit</button>-->
                        <form id="delete-form-{{$ad->id}}" method="post"
                              action="{{ route('site.advertising.destroy',app()->getLocale()) }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $ad->id }}">
                            <button type="button" id="delete-btn" onclick="showModal({{ $ad->id }})"
                                    class="default-btn delete_but">{{__('delete_title')}}</button>
                        </form>
                    </div>
                </div>

                <div class="listing-badge">
                    @if($ad->advertising_type == "premium") {{__('premium_title')}}
                    @elseif($ad->advertising_type == "normal") {{__('normal_title')}}
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div style="clear:both;"></div>
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('confirmation')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('ask_delete_title')}} ?!
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel_title')}}</button>
                    <button type="button" class="btn btn-danger" id="delete">{{__('yes_title')}}
                        ,{{__('delete_title')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>
