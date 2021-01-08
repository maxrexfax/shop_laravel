@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <table>
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
