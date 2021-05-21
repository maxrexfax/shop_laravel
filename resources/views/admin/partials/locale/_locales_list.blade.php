@extends('admin.index')
@section('admin.content')
    <div class="card">
        <div class="card-header text-center">
            {{ __('text.list_of_locales') }}
            <a id="btnCreateLocale" class="url_in_accordion ml-2 mb-0 float-right" href="{{route('locale.create')}}">
                <span class="addButton" title="{{ __('actions.add_new') }}">+</span>
            </a>
        </div>
        <div class="col-12 p-0">
            <table class="table table-striped w-100">
                <thead class="thead-dark">
                <tr>
                    <th>{{ __('actions.locale_id') }}</th>
                    <th>{{ __('actions.locale_logo_image') }}</th>
                    <th>{{ __('actions.locale_name') }}</th>
                    <th>{{ __('actions.locale_code') }}</th>
                    <th>{{ __('actions.edit') }}</th>
                    <th class="text-right">{{ __('actions.delete') }}</th>
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
                                <img height="30px" src="{{ asset('/img/logo/empty_logo.jpg') }}" alt="{{ __('actions.no_logo') }}"/>
                            @endif
                        </td>
                        <td>{{$locale->locale_name}}</td>
                        <td>{{$locale->locale_code}}</td>
                        <td><a href="{{route('locale.edit', ['id'=>$locale->id])}}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td>
                            <a href="{{route('locale.destroy', ['id'=>$locale->id])}}" title="{{__('text.delete')}}" data-confirm="{{__('actions.really_delete?')}}" class="btn btn-secondary float-right url-no-decoration btnToDeletePhone">
                                <span><i class="fa fa-trash fa-lg" aria-hidden="true"></i></span>
                            </a>
                        </td>
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
