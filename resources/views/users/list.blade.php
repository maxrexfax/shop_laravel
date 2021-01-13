@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card col-12 p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>User roles</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->login}}</td>
                            <td>
                        @foreach($user->roles as $role)
                            {{$role->role_name}}
                        @endforeach
                            </td>
                        </tr>
                    @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
