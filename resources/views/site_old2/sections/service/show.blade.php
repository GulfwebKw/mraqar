<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3">
    <div class="container">
        <div class="page-title-content">
            <h2>{{ $service->title }}</h2>
        </div>
    </div>
</div>
<!-- End Page Title Area -->



<div class="container-fluid" style="padding: 0; margin: 0">
    <div class="row" style="margin: 0;padding: 0">
        <div class="col-md-6 col-sm-12" style="padding-left: 0">
            <div>
                <img src="{{ $service->image }}" style="width: 100%">
            </div>
        </div>
        <div class="col-md-6 col-sm-12" >
            <div>
                <div style="padding: 50px">
                    {{ $service->body }}
                </div>
            </div>
        </div>
    </div>
</div>