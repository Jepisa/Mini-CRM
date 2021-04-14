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
    <form class="p-2 w-100 w-xs-50 m-auto" action="{{ route('employee.update',['employeeName' => $employee->slug ]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-between">
            <h2>{{ __('Edit employee') }}</h2>
            <a href="{{ route('employee.index') }}">{{ __('Back') }}</a>
        </div>
        @if ($employee->company->logo != null)
            <div class="d-flex justify-content-center w-full"><img style="width: 60px" src="{{ asset('storage/' . $employee->company->logo) }}"></div>
        @endif
        <div class="row g-3 p-1">
            <div class="col">
                <input required name="name" type="text" class="form-control" placeholder="name" aria-label="name"
                value="{{ (old('name')) ? old('name') : $employee->name }}"
                >
            </div>
            <div class="col">
                <input required name="lastname" type="text" class="form-control" placeholder="{{ __('Last Name') }}" aria-label="{{ __('Last Name') }}"
                value="{{ (old('lastname')) ? old('lastname') : $employee->lastname }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <input  name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}"
                value="{{ (old('email')) ? old('email') : $employee->email }}"
                >
            </div>
            <div class="col">
                <input name="phone" type="tel" class="form-control" placeholder="{{ __('Phone') }}" aria-label="{{ __('Phone') }}"
                    value="{{ (old('phone')) ? old('phone') : $employee->phone }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <select name="company_id" placeholder="{{ __('Company') }}">
                    @foreach ($companies as $company)
                        @if ( old('company_id') && old('company_id') == $company->id)
                            <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                        @else
                            @if ($company->name == $employee->company->name)
                                <option value="{{ $company->id }}" selected>{{ $company->name }}</option>
                            @else
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endif
                        @endif
                        
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </div>
    </form>
@endsection