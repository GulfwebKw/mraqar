@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>Success!</strong> Your profile was edited succesfully !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Something went wrong !
    </div>
@endif

<div id="result"></div>

            <div class="col-lg-12 col-md-12">
                <div class="contact-form">
                    <form method="post" action="{{ route('User.editUser',app()->getLocale()) }}" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label class="w-100">{{__('full_name_title')}} <span>*</span></label>
                                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ auth()->user()->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="w-100">{{__('phone_number_title')}} <span>*</span></label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control  @error('phone_number') is-invalid @enderror" value="{{ auth()->user()->mobile}}">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="w-100">{{__('email_address_title')}} <span>*</span></label>
                                <input type="email" name="email" id="email" class="form-control  @error('email') is-invalid @enderror" value="{{ auth()->user()->email}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="w-100">{{__('get_verified_profile_title')}}<span>*</span></label>
                                <input type="file" name="licence" id="licence" class="form-control" style="padding: 7px" value="Upload File">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="w-100">{{__('profile_image_title')}}<span>*</span></label>
                                <input type="file" name="avatar" id="avatar" class="form-control" style="padding: 7px" value="Upload File">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <button type="submit" class="default-btn" style="margin-top:30px;">{{__('save_title')}} &amp; {{__('upload_title')}}</button>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group" style="margin-top:40px;">
                                <a href="{{ route('Main.changePassword',app()->getLocale()) }}" class="default-btn" style="background-color:#ff0000; float:right;">
                                    <i class='bx bx-lock'></i>{{__('change_password_title')}}
                                </a>
                            </div>
                        </div>

                        
                    </div>

                    </form>
                </div>
            </div>

