@extends('layouts.app')

@section('content')
    <div style="max-width: 22rem; margin:auto;">
        <div class="d-flex justify-content-end">
            <a href="{{ route('company.index') }}">{{ __('Back') }}</a>
        </div>
        <div class="card" >
            @if ($employee->company->logo)
                <img src="{{ asset('storage/'.$employee->company->logo) }}" class="card-img-top" style="box-shadow: 2px 5px 5px 2px;" alt="...">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $employee->name }}</h2>
                <p class="card-text "><span class="font-weight-bold">{{__('Email')}}:</span> {{ $employee->email }}</p>
                <p class="card-text"><span class="font-weight-bold">{{__('Last Name')}}: </span>{{ $employee->lastname }}</p>
                <div class="d-flex flex-column flex-md-row justify-content-around align-items-center">
                    <a class="btn btn-primary" href="{{ route('employee.edit',['employeeName' => $employee->slug]) }}">{{ __('Edit') }}</a>
                    <form class="" style="min-width: 20px; text-align:center; margin: 5px 0;" method="POST" action="{{ route('employee.destroy', ['employeeName' => $employee->slug]) }}">
                        @csrf
                        @method('DELETE')
                        <a type="submit" href="{{route('employee.destroy', ['employeeName' => $employee->slug])}}"
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