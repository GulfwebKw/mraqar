@extends('site.layout.panel')
@section('title' , __('my_ads_title'))
@section('panel-content')
    @if((session('status')) == 'success')
        <div class="alert alert-success">
            <strong>{{__('success_title')}}!</strong> {{__('ad_delete_success_title')}} !
        </div>
    @elseif((session('status')) == 'unsuccess')
        <div class="alert alert-danger">
            <strong>{{__('un_success_title')}}!</strong> {{__('un_success_alert_title')}} !
        </div>
    @elseif((session('status')) == 'expire_your_credit')
        <div class="alert alert-danger">
            <strong>{{__('un_success_title')}}!</strong> {{__('un_success_alert_title')}} !
        </div>
    @elseif((session('status')) == 'ad_created')
        <div class="alert alert-success">
            <strong>{{__('success_title')}}!</strong> {{__('ad_created_title')}} !
        </div>
    @elseif((session('status')) == 'upgraded_premium')
        <div class="alert alert-success">
            <strong>{{__('success_title')}}!</strong> {{__('upgraded_premium')}} !
        </div>
    @endif


    <table class="mdc-data-table__table" aria-label="Dessert calories">
        <thead>
        <tr class="mdc-data-table__header-row">
            <th class="mdc-data-table__header-cell">{{ __('image') }}</th>
            <th class="mdc-data-table__header-cell">{{__('ADVERTISE_TYPE')}}</th>
            <th class="mdc-data-table__header-cell">{{ __('location_title') }}</th>
            <th class="mdc-data-table__header-cell">{{ __('action_title') }}</th>
            <th class="mdc-data-table__header-cell">{{ __('auto_extend_title') }}</th>
        </tr>
        </thead>
        <tbody class="mdc-data-table__content">

        @foreach($ads as $ad)
        <tr class="mdc-data-table__row">
            <td class="mdc-data-table__cell">
                <img src="{{ file_exists(public_path(urldecode($ad->main_image))) ? asset($ad->main_image) : asset('no-image.png')  }}" width="100" class="d-block py-3">
            </td>
            <td class="mdc-data-table__cell">
                @if($ad->advertising_type == "premium") {{__('premium_title')}}
                @elseif($ad->advertising_type == "normal") {{__('normal_title')}}
                @endif
            </td>
            <td class="mdc-data-table__cell">
                {{ app()->getLocale()==='en'?$ad->city->name_en . " - " . $ad->area->name_en:$ad->city->name_ar . " - " . $ad->area->name_ar }}
            </td>
            <td class="mdc-data-table__cell">
                <form id="delete-form-{{$ad->id}}" class="d-inline-block" method="post"
                      action="{{ route('site.advertising.destroy',app()->getLocale()) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $ad->id }}">
                    <a href="{{ route('site.advertising.edit',[app()->getLocale(),$ad->hash_number]) }}" class="mdc-icon-button material-icons primary-color">edit</a>
                    <button type="button" id="delete-btn" onclick="showModal({{ $ad->id }})"
                            class="mdc-icon-button material-icons warn-color">delete</button>
                </form>
                @if ($ad->advertising_type == 'normal')
                    <form action="{{ route('site.advertising.upgrade_premium',app()->getLocale()) }}" method="post" id="upgrade{{$ad->id}}" class="d-none">
                        @csrf
                        <input type="hidden" name="advertise_id" value="{{$ad->id}}">
                    </form>
                    <a type="button" id="delete-btn" class="mdc-icon-button material-icons d-inline-block" style="color: #c7a014;"
                       onclick="showUpgradeModal('{{$ad->id}}')">workspace_premium</a>
                @endif
            </td>
            <td>
                <div class="col-xs-12 py-3 row middle-xs">
                    <div class="mdc-switch">
                        <div class="mdc-switch__track"></div>
                        <div class="mdc-switch__thumb-underlay">
                            <div class="mdc-switch__thumb">
                                <input type="checkbox" id="extend{{$ad->id}}" class="mdc-switch__native-control"
                                       {{ !$ad->auto_extend ?: 'checked'}}>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    var checkbox = document.getElementById('extend{{$ad->id}}')

                    checkbox.addEventListener('change', (event) => {
                        if (event.currentTarget.checked) {
                            $.post('/{{app()->getLocale()}}/advertising/auto_extend', {id: {{$ad->id}}, extend: 'enable'}, function(data, status){
                                if (status === 'success') {
                                    alert(data)
                                }
                            })
                        } else {
                            $.post('/{{app()->getLocale()}}/advertising/auto_extend', {id: {{$ad->id}}, extend: 'disable'}, function(data, status){
                                if (status === 'success') {
                                    alert(data)
                                }
                            })
                        }
                    })
                </script>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('confirmation')}}</h5>
                </div>
                <div class="modal-body">
                    {{__('ask_delete_title')}} ?!
                </div>
                <div class="modal-footer justify-content-between mt-3">
                    <hr>
                    <button type="button" class="btn btn-secondary close mt-3">{{__('cancel_title')}}</button>
                    <button type="button" class="btn btn-danger mt-3" id="delete">{{__('yes_title')}}
                        ,{{__('delete_title')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmUpgrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('confirmation')}}</h5>
                </div>
                <div class="modal-body">
                    {{__('ask_upgrade_title')}}!
                </div>
                <div class="modal-footer justify-content-between mt-3">
                    <hr>
                    <button type="button" class="btn btn-secondary close mt-3">{{__('cancel_title')}}</button>
                    <button type="button" class="btn btn-danger mt-3" id="upgrade" style="background: green !important; border-color: green !important;">
                        {{__('yes_title')}}
                        ,{{__('upgrade_title')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('pagination')
    {!! $ads->links('vendor.pagination.housekey') !!}
@endsection
@section('header')
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 100000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 25%; /* Could be more or less, depending on screen size */
            display: flow-root;
        }

        .btn-danger {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            float: {{ app()->getLocale() == "en" ? 'right' : 'left' }};
        }
        .btn-secondary {
            color: #fff !important;
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            float: {{ app()->getLocale() == "ar" ? 'right' : 'left' }};
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
@endsection
@section('js')
    <script>
        // Get the modal
        var modal = document.getElementById("confirmDelete");
        var upgradeModal = document.getElementById("confirmUpgrade");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var span2 = document.getElementsByClassName("close")[1];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            upgradeModal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            else if(event.target == upgradeModal)
            {
                upgradeModal.style.display = "none";
            }
        }
        var advertiseId='';
        function showModal(id){
            modal.style.display = "block";
            advertiseId= id;
        }
        $('#delete').on('click',function () {
            $('#delete-form-'+advertiseId).submit()
        })

        var upgradableId='';
        function showUpgradeModal(id){
            upgradeModal.style.display = "block";
            upgradableId= id;
        }
        $('#upgrade').on('click',function () {
            $('#upgrade'+upgradableId).submit()

        })
    </script>
@endsection
