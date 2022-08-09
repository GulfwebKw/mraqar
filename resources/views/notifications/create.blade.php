@extends('layouts.admin', ['crumbs' => [
    __('Notifications') => route('notifications.index'),
    __('Make Notification') => route('notifications.create')]
, 'title' => __('New Notification')])
@section('content')
    <div class="card col-md-12 mx-auto">
        <form method="post" action="{{route('notifications.dispatch')}}" enctype="multipart/form-data" class="form theme-form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Title En')}}</label>
                            <div class="col-sm-7">
                                <input type="text" name="title_en" class="form-control  @error('title_en') is-invalid @enderror" id="title_en" placeholder="{{__('Title En')}}" value="{{ old('title_en') }}" required>
                                @error('title_en')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Title Ar')}}</label>
                            <div class="col-sm-7">
                                <input type="text" name="title_ar" class="form-control  @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="{{__('Title Ar')}}" value="{{ old('title_ar') }}" required>
                                @error('title_ar')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message_en" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Message En')}}</label>
                            <div class="col-sm-7">
                                <textarea required id="message_en" name="message_en" class="form-control   @error('message_en') is-invalid @enderror"></textarea>
                                @error('message_en')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message_ar" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Message Ar')}}</label>
                            <div class="col-sm-7">
                                <textarea required id="message_ar" name="message_ar" class="form-control   @error('message_ar') is-invalid @enderror"></textarea>
                                @error('message_ar')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Target')}}</label>
                            <div class="col-sm-7">

                                <select required id="type" class="form-control "  name="type">
                                    <option    value="all_users">All Users ({{$allUser}})</option>
                                    <option    value="all_company_users">All Company Users ({{$allCompanyUser}})</option>
                                    <option    value="all_individual_users">All Individual Users ({{$allIndividualUser}})</option>
                                    <option    value="not_exist_buy">All Users who do not buy ({{$noPayed}})</option>
                                    <option    value="not_exist_comment">All Users Not Register Comment ({{$noCommentUser}})</option>
                                    <option    value="not_exist_bocking">All Users Not Save Bocking ({{$noBookingUser}})</option>
                                    <option  @if($potentialCustomers==0) disabled @endif    value="potential_customer">Potential customer ({{$potentialCustomers}})</option>
                                </select>

                                @error('packages')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
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
                swal({ icon: 'success', title: 'Success', text: 'Send Notification Successfully scheduled'});

            });
        @endif
    </script>
@endsection