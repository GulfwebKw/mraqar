@extends('layouts.admin', ['crumbs' => [
    __('Notifications') => route('notifications.index')]
,'title' => __('List of Notifications')])
@section('content')
    <div class=" col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{route('notifications.create')}}">
                            <i class="fa fa-fw fa-plus"></i>
                            {{__('Create New Notification')}}
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('User')}}</th>
                                    <th scope="col">{{__('TitleEn')}}</th>
                                    <th scope="col">{{__('TitleAr')}}</th>
                                    <th scope="col">{{__('MessageEn')}}</th>
                                    <th scope="col">{{__('MessageAr')}}</th>
                                    <th scope="col">{{__('Date')}}</th>
                                    <th scope="col">{{__('Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $row = 1; ?>
                                @foreach($list as $item)
                                    <tr>

                                        <th scope="row">{{$row}}</th>
                                        <td> {{optional($item->user)->name}} </td>
                                        <td> {{$item->title_en}} </td>
                                        <td> {{$item->title_ar}} </td>
                                        <td> {{$item->message_en}} </td>
                                        <td> {{$item->message_ar}} </td>
                                        <td> {{$item->created_at}} </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-secondary-2x dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Actions')}}</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-danger" href="#" onclick='event.preventDefault(); destroyByForm({{$item->id}});' ><i class="fa fa-fw fa-trash"></i> {{__('Delete')}}</a>
                                                <form id="destroy-form-{{$item->id}}" method="post" action="{{route("notifications.destroy",$item->id)}}" style="display:none">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $row++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {!! $list->links() !!}
                </div>
            </div>

        </div>
@endsection


