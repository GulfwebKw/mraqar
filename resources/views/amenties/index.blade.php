@extends('layouts.admin', ['crumbs' => [
    'Settings' => route('amenties')],
    'title' => __('Amenties')
])
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @component('components.amenties', ['amenties' => $amenties])@endcomponent
            </div>
        </div>

    </div>

@endsection
