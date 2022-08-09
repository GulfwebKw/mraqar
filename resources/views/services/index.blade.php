@extends('layouts.admin', ['crumbs' => [
    'Services' => route('services.index')],
    'title' => __('services_title')
])

@section('content')

@if((session('status')) == 'success')
    <div class="alert alert-success">
        <strong>{{__('success_title')}}!</strong> {{__('service_success')}} !
    </div>
@elseif((session('status')) == 'unsuccess')
    <div class="alert alert-danger">
        <strong>{{__('un_success_title')}}!</strong> {{__('service_unsuccess')}} !
    </div>
@elseif((session('status')) == 'successedit')
    <div class="alert alert-success">
        <strong>{{__('success_title')}}!</strong> {{__('service_success_edit')}} !
    </div>
@elseif((session('status')) == 'unsuccessedit')
    <div class="alert alert-danger">
        <strong>{{__('un_success_title')}}!</strong> {{__('service_unsuccess_edit')}} !
    </div>
@endif

<div id="result"></div>

<div class=" col-md-12">
    <div class="card">
        <tr class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('image')}}</th>
                    <th scope="col" style="width: 70%">{{__('Title')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td class="align-middle">{{($loop->index)+1}}</td>
                        <td class="align-middle"><img src="{{$service->image}}" style="width: 100px;height: 100px"></td>
                        <td class="align-middle">{{$service->title}}</td>
                        <td class="align-middle">
                            <a href="/admin/services/edit/{{$service->id}}" ><i class="fa fa-fw fa-pencil text-success"  title="Edit" style="cursor: pointer;"></i></a>
                            {{--<button class="btn btn-xs btn-outline-success-2x" type="button" data-toggle="modal" data-target="#editModal-area-{{$area->id}}"><i class="fa fa-fw fa-pencil"></i> Edit</button>--}}
                            <i class="fa fa-fw fa-remove text-danger" onclick="deleteService('{{$service->id}}')" title="Delete" style="cursor: pointer;"></i>
                            {{--<button class="btn btn-xs btn-outline-danger-2x" type="button" onclick="deleteArea('{{$area->id}}')"><i class="fa fa-fw fa-remove"></i> Delete</button>--}}
                            <form id="destroy-form-service-{{$service->id}}" method="post" action="{{route('services.destroy', $service->id)}}" style="display:none">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</div>

@endsection


<script>
    {{--function editService(id) {--}}
    {{--    let city = $("#area-"+id+"-city").val();--}}
    {{--    let newName = $("#area-"+id+"-new-name_en").val();--}}
    {{--    let newNamear = $("#area-"+id+"-new-name_ar").val();--}}
    {{--    if (!newName) {--}}
    {{--        swal({"title": "Enter New Name", "icon": "warning"});--}}
    {{--    } else {--}}
    {{--        $.ajax({--}}
    {{--            url: "{{route('areas.update')}}",--}}
    {{--            method: "post",--}}
    {{--            data: {--}}
    {{--                _token: "{{csrf_token()}}",--}}
    {{--                area: id,--}}
    {{--                name_en: newName,--}}
    {{--                name_ar:newNamear,--}}
    {{--                city_id:city,--}}
    {{--            }--}}
    {{--        }).done(function (response) {--}}
    {{--            window.location.href="/admin/area";--}}
    {{--            if (response.success) {--}}
    {{--                $("#area-"+id+"-name_en").html(newName);--}}
    {{--                $("#area-"+id+"-name_ar").html(newNamear);--}}
    {{--                $("#area-"+id+"-city_title").html(newNamear);--}}

    {{--                $("#editModal-area-"+id).modal("hide");--}}
    {{--            } else {--}}
    {{--                swal({"title": "Unable to update!", "icon": "error"});--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }--}}
    {{--}--}}
    function deleteService(id) {
        swal({
            title: "{{__('Are you sure you want to delete this item?')}}",
            text: "{{__('Be aware that deletion process is non-returnable')}}",
            icon: "warning",
            buttons: ["{{__('Cancel')}}", "{{__('Delete')}}"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('destroy-form-service-'+id).submit();
            }
        });
    }
    function searchService(cityId,nameEn,nameAr) {
        var page="{{request()->page}}";
        var path="/admin/area?cityId="+cityId+"&name_en="+nameEn+"&name_ar="+nameAr;
        if(page!=null||page!==undefined){
            path+="&page="+page;
        }
        window.location.href=path;
    }
    function refreshPage() {
        var path="/admin/area";
        window.location.href=path;
    }

</script>
