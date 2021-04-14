@extends('layouts.app')

@section('content')
    <div style="max-width: 22rem; margin:auto;">
        <div class="d-flex justify-content-end">
            <a href="{{ route('company.index') }}">{{ __('Back') }}</a>
        </div>
        <div class="card" >
            @if ($company->logo)
                <img src="{{ asset('storage/'.$company->logo) }}" class="card-img-top" style="box-shadow: 2px 5px 5px 2px;" alt="...">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $company->name }}</h2>
                <p class="card-text "><span class="font-weight-bold">{{__('Email')}}:</span> {{ $company->email }}</p>
                <p class="card-text"><span class="font-weight-bold">{{__('WebSite')}}:</span> <a target="_blank" href="{{ $company->website }}">{{ $company->website }}</a></p>
                <p class="card-text"><span class="font-weight-bold">{{__('Employees')}}: </span>{{ $company->employees->count() }}</p>
                <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                    <a class="btn btn-primary" href="{{ route('company.edit',['companyName' => $company->slug]) }}">{{ __('Edit') }}</a>
                    <form class="" style="min-width: 20px; text-align:center; margin: 5px 0;" method="POST" action="{{ route('company.destroy', ['companyName' => $company->slug]) }}">
                        @csrf
                        @method('DELETE')
                        <a type="submit" href="{{route('company.destroy', ['companyName' => $company->slug])}}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();" class="btn btn-danger">
                        {{ __('Delete') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection