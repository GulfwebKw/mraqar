
<div class="card-header">
    <div class="row">
        <div class="col-sm-2">
            <a  href="#addModal" data-toggle="modal" data-target="#addModal"   class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> {{__('Add')}}</a>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-12">

                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Type Title En..." required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="title_ar" name="title_ar" placeholder="Type Title Ar..." required>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="type" name="type" required>
                            <option >Select Type</option>
                            <option value="Residential">Residential</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Industrial">Industrial</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success" onclick="search($('#title_en').val(),$('#title_ar').val());"><i class="fa fa-fw fa-search"></i> {{__('Search venueType')}}</button>
                        <button type="button" class="btn btn-light" onclick="refreshPage();"><i class="fa fa-fw fa-close"></i> {{__('Cancel')}}</button>
                    </div>
                </div>
        </div>
    </div>

</div>
<div class="card-body">
    <table class="table table-striped table-hover">
        <thead class="thead-light" >
        <tr>
            <th>{{__('TitleEn')}}</th>
            <th>{{__('TitleAr')}}</th>
            <th>{{__('Type')}}</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="areas-list">
        @foreach($venueType as $item)
            <tr>
                <td id="area-{{$item->id}}-name_en">{{$item->title_en}}</td>
                <td id="area-{{$item->id}}-name_ar">{{$item->title_ar}}</td>
                <td id="area-{{$item->id}}-type">{{$item->type}}</td>
                <td>
                    <i class="fa fa-fw fa-pencil text-success" data-toggle="modal" data-target="#editModal-area-{{$item->id}}" title="Edit" style="cursor: pointer;"></i>
                    {{--<button class="btn btn-xs btn-outline-success-2x" type="button" data-toggle="modal" data-target="#editModal-area-{{$area->id}}"><i class="fa fa-fw fa-pencil"></i> Edit</button>--}}
                    &nbsp;
                    <i class="fa fa-fw fa-remove text-danger" onclick="deleteVenueType('{{$item->id}}')" title="Delete" style="cursor: pointer;"></i>
                    {{--<button class="btn btn-xs btn-outline-danger-2x" type="button" onclick="deleteArea('{{$area->id}}')"><i class="fa fa-fw fa-remove"></i> Delete</button>--}}
                    <form id="destroy-form-area-{{$item->id}}" method="post" action="{{route('venueType.destroy', $item->id)}}" style="display:none">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                </td>

                    <!-- Edit Modal -->
                    <div class="modal" id="editModal-area-{{$item->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{__('Edit VenueType')}}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="name_en" id="area-{{$item->id}}-new-name_en" value="{{$item->title_en}}" >
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="name_ar" id="area-{{$item->id}}-new-name_ar" value="{{$item->title_ar}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-control" name="type" id="area-{{$item->id}}-new-type"  >
                                                <option @if($item->type=="Residential") selected @endif value="Residential">Residential</option>
                                                <option @if($item->type=="Commercial") selected @endif value="Commercial">Commercial</option>
                                                <option @if($item->type=="Industrial") selected @endif value="Industrial">Industrial</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-secondary" onclick="editArea('{{$item->id}}')">{{__('Confirm')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $venueType->links() !!}

    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Add Venue Type')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route('venueType.store')}}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text"  placeholder="Title En..." class="form-control" required name="name_en">
                            </div>
                            <div class="col-sm-4">
                                <input type="text"  placeholder="Type Title Ar..." class="form-control" required name="name_ar">
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="type"   >
                                    <option @if($item->type=="Residential") selected @endif value="Residential">Residential</option>
                                    <option @if($item->type=="Commercial") selected @endif value="Commercial">Commercial</option>
                                    <option @if($item->type=="Industrial") selected @endif value="Industrial">Industrial</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >{{__('Add')}}</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>


<script>
    function editArea(id) {
        let newName = $("#area-"+id+"-new-name_en").val();
        let newNamear = $("#area-"+id+"-new-name_ar").val();
        let newType = $("#area-"+id+"-new-type").val();
        if (!newName) {
            swal({"title": "Enter New Name", "icon": "warning"});
        } else {
            $.ajax({
                url: "{{route('venueType.update')}}",
                method: "post",
                data: {
                    _token: "{{csrf_token()}}",
                    venueType: id,
                    title_en: newName,
                    title_ar:newNamear,
                    type:newType
                }
            }).done(function (response) {
                if (response.success) {
                    $("#area-"+id+"-name_en").html(newName);
                    $("#area-"+id+"-name_ar").html(newNamear);
                    $("#area-"+id+"-type").html(newType);
                    $("#editModal-area-"+id).modal("hide");
                } else {
                    swal({"title": "Unable to update!", "icon": "error"});
                }
            });
        }
    }
    function deleteVenueType(id) {
        swal({
            title: "{{__('Are you sure you want to delete this item?')}}",
            text: "{{__('Be aware that deletion process is non-returnable')}}",
            icon: "warning",
            buttons: ["{{__('Cancel')}}", "{{__('Delete')}}"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('destroy-form-area-'+id).submit();
            }
        });
    }
    function search(nameEn,nameAr) {
        var page="{{request()->page}}";
        var path="/admin/venue-type?title_en="+nameEn+"&title_ar="+nameAr;
        if(page!=null||page!==undefined){
            path+="&page="+page;
        }
        window.location.href=path;
    }
    function refreshPage() {
        var path="/admin/venue-type";
        window.location.href=path;
    }

</script>
