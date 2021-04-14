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
    <form class="p-2 w-100 w-xs-50 m-auto" action="{{ route('employee.store', app()->getLocale()) }}" method="POST" >
        @csrf
        <div class="d-flex justify-content-between">
            <h2>{{ __('Create new employee') }}</h2>
            <a href="{{ route('employee.index') }}">{{ __('Back') }}</a>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <input required name="name" type="text" class="form-control" placeholder="name" aria-label="name"
                    value="{{ old('name') }}"
                >
            </div>
            <div class="col">
                <input required name="lastname" type="text" class="form-control" placeholder="{{ __('Last Name') }}" aria-label="{{ __('Last Name') }}"
                    value="{{ old('lastname') }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <input name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}"
                    value="{{ old('email') }}"
                >
            </div>
            <div class="col">
                <input name="phone" type="tel" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}"
                    value="{{ old('phone') }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <select name="company_id" placeholder="{{ __('Company') }}">
                    <option disabled>{{ __('Company') }}</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>
@endsection