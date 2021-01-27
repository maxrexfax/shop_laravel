@extends('admin.index')
@section('admin.content')
<div class="card">
    <div class="card-header text-center">
        {{__('Edit phone list for ')}}{{$store->store_name}}
    <a href="{{route('phone.create', ['store_id' => $store->id])}}" title="Add new phone" class="float-right btn btn-secondary">{{__('Add phone')}}<i class="fa fa-plus-square fa-lg ml-2" aria-hidden="true"></i></a>
    </div>
    <div class="d-flex justify-content-between flex-wrap">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>{{__('Phone number')}}</th>
                    <th>{{__('Information')}}</th>
                    <th>{{__('Edit')}}</th>
                    <th>{{__('Delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phones as $phone)
                <tr>
                    <td>{{$phone->phone_number}}</td>
                    <td>{{$phone->phone_info}}</td>
                    <td>
                        <a title="Edit this phone"  class="btn btn-primary" href="{{route('phone.create', ['store_id' => $store->id, 'phone_id'=>$phone->id])}}">
                            <i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{route('phone.delete', ['id'=>$phone->id])}}" title="Delete this phone" onclick="return confirm('Really delete?')" class="btn btn-secondary float-right url_no_decoration">
                            <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
