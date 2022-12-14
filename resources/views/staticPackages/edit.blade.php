@extends('layouts.admin', ['crumbs' => [
    __('Static Packages') => route('staticPackages.index'),
    __('Update Static Packages') => route('packages.edit',$package)]
, 'title' => __('Update Static Packages')])
@section('content')
    <div class="card col-md-12 mx-auto">
        <form method="post" action="{{route('staticPackages.update',$package->id)}}" enctype="multipart/form-data" class="form theme-form">
            <input name="_method" type="hidden" value="PUT"/>
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Title Er')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="title_en" class="form-control  @error('title_en') is-invalid @enderror" id="title_en" placeholder="{{__('Title En')}}" value="{{ $package->title_en }}" required>
                                @error('title_en')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Title Ar')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="title_ar" class="form-control  @error('title_ar') is-invalid @enderror" id="title_ar" placeholder="{{__('Title Ar')}}" value="{{ $package->title_ar }}" required>
                                @error('title_ar')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Description En')}}</label>
                            <div class="col-sm-6">
                                <textarea  name="description_en" class="form-control  @error('description_en') is-invalid @enderror" rows="2" maxlength="230">{!! $package->description_en !!}</textarea>
                                @error('description_en')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Description Ar')}}</label>
                            <div class="col-sm-6">
                                <textarea  name="description_ar" class="form-control  @error('description_ar') is-invalid @enderror" rows="2" maxlength="230">{!! $package->description_ar !!}</textarea>
                                @error('description_ar')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Note En')}}</label>
                            <div class="col-sm-6">
                                <textarea  name="note_en" class="form-control  @error('note_en') is-invalid @enderror " rows="2" >{!! $package->note_en !!}</textarea>
                                @error('note_en')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">{{__('Note Ar')}}</label>
                            <div class="col-sm-6">
                                <textarea  name="note_ar" class="form-control  @error('note_ar') is-invalid @enderror" rows="2" >{!! $package->note_ar !!}</textarea>
                                @error('note_ar')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="user_type" class="col-sm-3 col-form-label"><span class="text-danger"></span> {{__('UserType')}}</label>
                            <div class="col-sm-6">
                                <select id="user_type" class="form-control " name="user_type">
                                    <option   @if($package->user_type=="company")     selected  @endif value="company">Company</option>
                                    <option   @if($package->user_type=="individual")  selected  @endif value="individual">Individual</option>
                                </select>
                                @error('user_type')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Price')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="price" class="form-control  @error('price') is-invalid @enderror" id="price" placeholder="{{__('Price')}}" value="{{ $package->price }}" required>
                                @error('price')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Old Price')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="old_price" class="form-control  @error('old_price') is-invalid @enderror" id="old_price" placeholder="{{__('Old Price')}}" value="{{ $package->old_price }}" >
                                @error('old_price')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="count_day" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Number of Days')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="count_day" class="form-control  @error('count_day') is-invalid @enderror" id="price" placeholder="{{__('Number of Days')}}" value="{{ $package->count_day }}" required>
                                @error('count_day')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="count_day" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Number of show days')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="count_show_day" class="form-control  @error('count_show_day') is-invalid @enderror" id="count_show_day" placeholder="{{__('Number of show days')}}" value="{{ $package->count_show_day }}" required>
                                @error('count_show_day')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="count_day" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Count Advertising')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="count_advertising" class="form-control  @error('count_advertising') is-invalid @enderror" id="count_show_day" placeholder="{{__('Count Normal Advertising')}}" value="{{ $package->count_advertising }}" required>
                                @error('count_advertising')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="count_premium" class="col-sm-3 col-form-label"><span class="text-danger">*</span> {{__('Count Premium')}}</label>
                            <div class="col-sm-6">
                                <input type="text" name="count_premium" class="form-control  @error('count_premium') is-invalid @enderror" id="count_premium" placeholder="{{__('Count Premium Advertising')}}" value="{{$package->count_premium }}" required>
                                @error('count_premium')
                                <div class="help-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class=" form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label"></label>
                            <div class="col">
                                <div class="checkbox">
                                    <input type="checkbox"  @if($package->is_enable==1) checked @endif  name="is_enable" id="is_enable">
                                    <label for="is_enable">Is Enable</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="checkbox">
                                    <input type="checkbox"  @if($package->is_premium==1) checked @endif  name="is_premium" id="is_premium">
                                    <label for="is_premium">Is Premium</label>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                <a href="/admin/staticPackages" class="btn btn-light">{{__('Cancel')}}</a>
            </div>
        </form>
    </div>
@endsection
