@extends('layouts.admin', ['crumbs' => [
    __('Notifications') => route('notifications.index'),
    __('Settings Notification') => route('notifications.settings')]
, 'title' => __('Settings Notification')])
@section('content')
    <div class="card col-md-12 mx-auto">
        <form method="post" action="{{route('notifications.updateSettings')}}" enctype="multipart/form-data" class="form theme-form">
            @csrf
            <div class="card-body">
                 @foreach($notification_message as $key=>$item)
                    <h6> {{$item->title}} </h6>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <label for="name" class="col-sm-10 col-form-label"><span class="text-danger">*</span> {{__('Title En')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="{{$key."_title_en"}}" class="form-control  @error('title_en') is-invalid @enderror" id="title_en"  value="{{$item->title_en}}" required>
                                        @error('title_en')
                                        <div class="help-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="name" class="col-sm-10 col-form-label"><span class="text-danger">*</span> {{__('Title Ar')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="{{$key."_title_ar"}}"  class="form-control  @error('title_en') is-invalid @enderror" id="title_en" placeholder="{{__('Title En')}}" value="{{$item->title_ar}}" required>
                                        @error('title_en')
                                        <div class="help-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="name" class="col-sm-10 col-form-label"><span class="text-danger">*</span> {{__('Message En')}}</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="{{$key."_message_en"}}" >{{$item->message_en}}</textarea>
                                        @error('title_en')
                                        <div class="help-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="name" class="col-sm-10 col-form-label"><span class="text-danger">*</span> {{__('Message Ar')}}</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control"  name="{{$key."_message_ar"}}">{{$item->message_ar}}</textarea>
                                        @error('title_en')
                                        <div class="help-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                 @endforeach

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                <a href="{{route('notifications.index')}}" class="btn btn-light">{{__('Cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
@section("scripts")
    <script>
        @if(isset($success))
        $(function () {
            swal({ icon: 'success', title: 'Success', text: 'Update Settings Notification Successfully'});
        });
        @endif
    </script>
@endsection