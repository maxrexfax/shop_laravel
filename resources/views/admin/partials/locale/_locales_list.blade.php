@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('List of locales') }}
            <a class="url_in_accordion ml-2 mb-0 float-right" href="{{route('locale.create')}}">
                <span class="addButton" title="Add New">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('Locale id') }}</th>
                    <th>{{ __('Locale logo image') }}</th>
                    <th>{{ __('Locale name') }}</th>
                    <th>{{ __('Locale code') }}</th>
                    <th>{{ __('Edit') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($locales->sortBy('id') as $locale)
                    <tr>
                        <td>{{$locale->id}}</td>
                        <td>
                            @if($locale->locale_logo)
                                <img height="30px" src="{{ asset('/img/logo/' . $locale->locale_logo) }}" alt="{{$locale->locale_name}}"/>
                            @else
                                <img height="30px" src="{{ asset('/img/logo/empty_logo.jpg') }}" alt="No logo"/>
                            @endif
                        </td>
                        <td>{{$locale->locale_name}}</td>
                        <td>{{$locale->locale_code}}</td>
                        <td><a href="{{route('locale.create')}}/{{$locale->id}}"><i class="fas fa-pencil-alt"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            @if(!empty($locales))
                {{ $locales->links() }}
            @endif
        </div>
    </div>
@endsection
