@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('actions.list_of_users') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('user.create')}}">
                <span class="addButton" title="{{__('actions.add_new')}}">+</span>
            </a>
        </div>
        <div class="text-center">
            @if(!empty($message))
                <div class="bg-error">{{$message}}</div>
            @endif
        </div>
        <div class="col-12 p-0 overflow-auto">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>{{ __('actions.user_login') }}</th>
                    <th>{{ __('actions.user_first_name') }}</th>
                    <th>{{ __('actions.user_second_name') }}</th>
                    <th>{{ __('actions.user_last_name') }}</th>
                    <th>{{ __('actions.user_email') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                    <th>{{ __('actions.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users->sortBy('id') as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->login}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->second_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="{{route('user.create')}}/{{$user->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td>
                            <a href="{{route('user.destroy', ['id'=>$user->id])}}" title="{{__('text.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-2 class-text-center">
            @if(!empty($users))
                {{ $users->links() }}
            @endif
        </div>
    </div>
@endsection
