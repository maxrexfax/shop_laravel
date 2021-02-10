@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.promocodes_list') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('promocode.create')}}">
                <span class="addButton" title="{{ __('actions.add_new') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('actions.promocode_id') }}</th>
                    <th>{{ __('actions.promocode_name') }}</th>
                    <th>{{ __('actions.promocode_value') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promocodes->sortBy('id') as $promocode)
                    <tr>
                        <td>{{$promocode->id}}</td>
                        <td>{{$promocode->promocode_name}}</td>
                        <td>{{$promocode->promocode_value}}</td>
                        <td>
                            <a href="{{route('promocode.create', ['id' => isset($promocode) ? $promocode->id : ''])}}"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{route('promocode.delete', ['id'=>$promocode->id])}}" title="{{__('actions.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btn-delete-promocode">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($promocodes))
                {{ $promocodes->links() }}
            @endif
        </div>
    </div>
@endsection
