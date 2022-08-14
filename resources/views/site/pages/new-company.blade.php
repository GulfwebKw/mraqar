@extends('site.layout.master')

@section('content')

    <main>
        <div class="px-3">
            <div class="theme-container">
                <div class="mdc-card mt-5 p-5">
                    <form method="post" action="{{ route('companies.store', app()->getLocale()) }}" class="contact-form"
                          enctype="multipart/form-data">
                        <div class="row agent-wrapper">
                            @csrf
                            <div class="col-xs-12 col-sm-8 col-md-9 p-3">
                                <h3 class="">Fill your company details</h3>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mdc-text-field mdc-text-field--outlined w-100 mt-3">
                                            <input name="company_name" placeholder="PlaceHolderText" id="company_name" class="mdc-text-field__input" required>
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="company_name" class="mdc-floating-label">Company Name</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('company_name')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mdc-text-field mdc-text-field--outlined w-100 mt-3">
                                            <input name="company_phone" placeholder="PlaceHolderText" id="company_phone" class="mdc-text-field__input" required>
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="company_phone" class="mdc-floating-label">Company Phone</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('company_phone')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mdc-text-field mdc-text-field--outlined w-100 mt-3">
                                            <input name="email" placeholder="PlaceHolderText" id="email" class="mdc-text-field__input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="email" class="mdc-floating-label">Email</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mdc-text-field mdc-text-field--outlined w-100 mt-3">
                                            <input name="instagram" placeholder="PlaceHolderText" id="instagram" class="mdc-text-field__input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="instagram" class="mdc-floating-label">Instagram</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('instagram')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="mdc-text-field mdc-text-field--outlined w-100 mt-3">
                                            <input name="twitter" placeholder="PlaceHolderText" id="twitter" class="mdc-text-field__input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="twitter" class="mdc-floating-label">Twitter</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                        @error('twitter')
                                        <span class="invalid-feedback warn-color d-inline-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="w-100 text-center mt-4">
                                    <button type="submit" class="mdc-button mdc-button--raised">
                                        <span class="mdc-button__ripple"></span>
                                        <span class="mdc-button__label">Register company</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 p-3 center-xs">
                                <img src="{{ asset('/asset/images/logo-placeholder-image.png') }}" alt="company-image"
                                     class="mw-200 d-block mx-auto" id="uploadedImage">
                                <input type="file" id="inputImage" name="image" accept="image/*" class="d-none">
                                <label class="mdc-button mdc-button--raised mw-100 mt-3" for="inputImage">
                                    <span class="mdc-button__ripple"></span>
                                    <span class="mdc-button__label">upload logo</span>
                                </label>
                                <br>
                                @error('image')
                                <span class="invalid-feedback warn-color d-inline-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        uploadedImage = document.getElementById('uploadedImage');
        imgageInput = document.getElementById('inputImage');
        imgageInput.onchange = evt => {
            const [file] = imgageInput.files
            if (file) {
                uploadedImage.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
