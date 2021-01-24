@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('List of users') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('user.create')}}">
                <span class="addButton" title="Add New">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('User id') }}</th>
                    <th>{{ __('User image') }}</th>
                    <th>{{ __('User first name') }}</th>
                    <th>{{ __('User second name') }}</th>
                    <th>{{ __('User last name') }}</th>
                    <th>{{ __('User email') }}</th>
                    <th>{{ __('Edit') }}</th>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($users))
                {{ $users->links() }}
            @endif
        </div>
    </div>
@endsection
