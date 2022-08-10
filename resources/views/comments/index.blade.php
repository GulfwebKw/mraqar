@extends('layouts.admin', ['crumbs' => [
    'Comments' => route('comments.index')],
    'title' => __('Comments')
])
@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('List of Comments')}}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('User')}}</th>
                            <th scope="col">{{__('Advertising')}}</th>
                            <th scope="col">{{__('Path')}}</th>
                            <th scope="col">{{__('Message')}}</th>
                            {{--                                <th scope="col">{{__('Status')}}</th>--}}
                            <th scope="col">{{__('Date')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{optional($item->user)->name}}</td>
                                <td>{{optional($item->advertising)->title_en}}</td>
                                <td>{{optional($item->advertising)->city->name_en }} -->  {{optional($item->advertising)->area->name_en }} --> {{optional($item->advertising)->type  }} --> {{optional($item->advertising)->venue_type}} --> {{optional($item->advertising)->purpose}}  </td>
                                <td>{{$item->comment}}</td>
                                {{--                                    <td>{{$item->status}}</td>--}}
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-secondary-2x dropdown-toggle" data-toggle="dropdown" aria-haspopup="truFe" aria-expanded="false">{{__('Actions')}}</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-danger" href="#" onclick='event.preventDefault(); destroy({{$item->id}});' ><i class="fa fa-fw fa-trash"></i> {{__('Delete')}}</a>

                                    </div>
                                    <form id="destroy-form-{{$item->id}}" method="post" action="{{route('comments.destroy',$item->id)}}" style="display:none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <br>
                    {!! $list->links()!!}

                </div>
            </div>


      </div>

@endsection
@section('scripts')
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
    </script>
@endsection
