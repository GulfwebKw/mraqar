@extends('site_old2.template')

@section('content')

    @include('site_old2.sections.profile.searchOverlay')
    @include('site_old2.sections.profile.pageTitle')
    @include('site_old2.sections.profile.profileHeader')
    @include('site_old2.sections.profile.buyPackage')
    @include('site_old2.sections.profile.profileFooter')

@endsection
@section('scripts')
    <script>
        $('input[type=radio][name="packtype"]').on('change', function () {
            if (this.value === 'normal') {
                $("#normal-div").removeClass('d-none').addClass('d-block');
                $("#static-div").removeClass('d-block').addClass('d-none');
            }
            if (this.value === 'static') {
                $("#normal-div").removeClass('d-block').addClass('d-none');
                $("#static-div").removeClass('d-none').addClass('d-block');
            }
        });
    </script>
@endsection
