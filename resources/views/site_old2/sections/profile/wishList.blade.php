


<wishlist-index :wishlists="{{json_encode($wishLists)}}"
                :locale="{{json_encode(app()->getLocale())}}"
                @if(\Illuminate\Support\Facades\Auth::check())
                :user="{{json_encode(\Illuminate\Support\Facades\Auth::user())}}"
                :archived_id="{{json_encode(collect(\Illuminate\Support\Facades\Auth::user()->archiveAdvertising)->pluck('id')->toArray())}}"
    @endif
></wishlist-index>
{{--<div style="clear:both;"></div>--}}
