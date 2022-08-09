@extends('layouts.admin', ['crumbs' => [
    'Services' => route('services.index')],
    'title' => __('services_edit')
])


@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('fancybox/source/jquery.fancybox.css')}}">
    <style>
        .select2 {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
@endsection



@section('content')

    <div class=" col-md-12">
        <div class="card">

            <form method="post" action="{{route('services.update')}}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col">

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label"><span class="text-danger"></span> {{__('Title')}}</label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" value="{{$service->title}}" class="form-control  @error('title') is-invalid @enderror" id="title" required>
                                    @error('title')
                                    <div class="help-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-sm-2 col-form-label" style="margin-top: 20px"><span class="text-danger"></span> {{__('Description')}}</label>
                                <div class="col-sm-6">
                                    <textarea  name="body"  class="form-control  @error('body') is-invalid @enderror" rows="10" >{{ $service->body }}</textarea>
                                    @error('body')
                                    <div class="help-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="main_image" class="col-sm-2 col-form-label" style="margin-top: 100px"><span class="text-danger"></span> {{__('Main Image')}}</label>
                                <div class="col-sm-6">
                                    <img id="main_image_path" style="margin: 20px 0;border: 8px double #ccc;"  src="{{ $service->image }}"   >
                                    <br>
                                    <a href="/filemanager/dialog.php?type=1&field_id=main_image" data-fancybox-type="iframe" class="btn btn-info fancy">Select Image</a>
                                    <button onclick="clearImage('main');" type="button" class="btn btn-danger">Remove Image</button>
                                    <input type="hidden"  value="{{ $service->image }}" name="main_image" id="main_image" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="serviceid" value="{{$service->id}}">
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    <a href="{{route('services.index')}}" class="btn btn-light">{{__('Cancel')}}</a>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{asset('fancybox/source/jquery.fancybox.js')}}" ></script>

    <script>
        function destroy(itemId) {
            swal({
                title: "{{__('Are you sure you want to delete this item?')}}",
                text: "{{__('Be aware that deletion process is non-returnable')}}",
                icon: "warning",
                buttons: ["{{__('Cancel')}}", "{{__('Delete')}}"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('destroy-form-'+itemId).submit();
                }
            });
        }
        function accept(id) {
            swal({
                title: "{{__('Are you sure you want to accept item?')}}",
                text: "{{__('Be aware that deletion process is non-returnable')}}",
                icon: "warning",
                buttons: ["{{__('Cancel')}}", "{{__('Accept')}}"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('accept-form-'+id).submit();
                }
            });
        }
        function responsive_filemanager_callback(field_id){

            var url=jQuery('#'+field_id).val().split(",");
            if (Array.isArray(url)) {
                url= url[0].replace("[","")
                url= url.replace("\"","");
                url= url.replace("\"","");
                $("#"+field_id+"_path").attr('src', url);
            } else {
                $("#"+field_id+"_path").attr('src', url);
            }

        }
        function clearImage(type) {
            var url = "/images/main/panel/noimage.png";
            $("#" + type + "_image_path").attr('src', url);
            $("#main_image").attr('value',url);

        }
        function clearVideo(){
            $("#video").val("");
        }
        $(function () {

            $("#area").select2();
            $("#city").select2();
            $("#user").select2();

            $('.fancy').fancybox({
                'width'		: 900,
                'height'	: 600,
                'type'		: 'iframe',
                'autoScale'    	: false
            });
            $("#amenities").select2();
            $("#status").on("change",function () {
                if($(this).prop("checked")){
                    $("#message_reject_box").hide();
                }else{
                    $("#message_reject_box").show();
                }
            });
            $("._type").on("change",function () {
                var v=$(this).val();
                $.ajax({
                    url: "/admin/getVenueTypeByType/"+v,
                    method: 'get',
                    success: function(result){
                        $("#venue_type").empty();
                        $.each(result, function(key,item) {
                            $('#venue_type')
                                .append($("<option></option>")
                                    .attr("value",item.title_en)
                                    .text(item.title_en));
                        });
                    }});
            });
        });
    </script>
@endsection
