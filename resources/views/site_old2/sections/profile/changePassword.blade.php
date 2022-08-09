@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>Success!</strong> Your password was edited succesfully !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Something went wrong !
    </div>
@elseif((session('status')) == 'dontmatch')
    <div class="alert alert-danger">
        <strong>UnSuccess!</strong> Your password was wrong !
    </div>
@endif


<div id="result"></div>

<div class="col-lg-12 col-md-12">
    <div class="contact-form">

        <form method="post" action="{{ route('User.changePassword', app()->getLocale()) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Current Password <span>*</span></label>
                        <input type="password" name="current" id="current" class="form-control @error('current') is-invalid @enderror" value="{{ old('current') }}" required>
                        @error('current')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>New Password <span>*</span></label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>Confirm New Password <span>*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" required>
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        &nbsp;
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <button type="submit" class="default-btn">Update Password</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</div>