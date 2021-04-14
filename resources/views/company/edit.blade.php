@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <!-- Validation Errors -->
        <div class="mb-4" :errors="$errors">
            <div class="font-medium text-red-600">
                {{ __('Whoops! Something went wrong.') }}
            </div>

            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="p-2 w-100 w-xs-50 m-auto" action="{{ route('company.update', ['companyName' => $company->slug ]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-between">
            <h2>{{ __('Edit company') }}</h2>
            <a href="{{ route('company.index') }}">{{ __('Back') }}</a>
        </div>
        @if ($company->logo != null)
            <div class="d-flex justify-content-center w-full"><img style="width: 60px" src="{{ asset('storage/' . $company->logo) }}"></div>
        @endif
        <div class="row g-3 p-1">
            <div class="col">
                <input name="name" type="text" class="form-control" placeholder="name" aria-label="name"
                    value="{{ (old('name')) ? old('name') : $company->name }}"
                >
            </div>
            <div class="col">
                <input name="email" type="text" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}"
                    value="{{ (old('email')) ? old('email') : $company->email }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            
            <input class=" col" name="logo" type="file" class="form-control" placeholder="name" aria-label="name">
            <div class="col">
                <input name="website" type="text" class="form-control" placeholder="{{ __('WebSite') }}" aria-label="{{ __('WebSite') }}"
                    value="{{ (old('website')) ? old('website') : $company->website }}"
                >
            </div>
        </div>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </div>
    </form>
@endsection