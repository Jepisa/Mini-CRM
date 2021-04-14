@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xs-9">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-baseline">
                <h1 class="display-4">{{ __('Companies') }}</h1> 
                {{ $companies->links() }}
            </div>
            <table class="table table-striped table-bordered table-responsive" style="max-width: max-content; margin: auto;">
                <div>
                    <a class="btn btn-primary m-2" href="{{ route('company.create') }}">{{ __('Create new company') }}</a>
                </div>
                <thead>
                    <tr>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Logo') }}</th>
                    <th scope="col">{{ __('Website') }}</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>  
                            <td><a href="{{ route('company.show', ['companyName' => $company->slug]) }}">{{ $company->name }}</a></td>
                            <td>{{ $company->email }}</td>
                            <td>
                                @if ($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo ) }}" style="width: 60px;">
                                @endif
                                
                            </td>
                            <td>{{ $company->website }}</td>
                            <td class="d-flex flex-column buttons-action">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection
