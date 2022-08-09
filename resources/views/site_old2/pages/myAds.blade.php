@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.profile.searchOverlay')
    @include('site_old2.sections.profile.pageTitle')
    @include('site_old2.sections.profile.profileHeader')
    @include('site_old2.sections.profile.myAds')
    @include('site_old2.sections.profile.profileFooter')

@endsection
@section('scripts')
    <script>
        var advertiseId = '';

        function showModal(id) {
            $('#confirmDelete').modal('show')
            advertiseId = id;
        }

        $('#delete').on('click', function () {
            $('#delete-form-' + advertiseId).submit()

        })
    </script>
@endsection
