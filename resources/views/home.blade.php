@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div> --}}

                <style>
                    .buttons-action button{
                        width: max-content ;
                        padding: 2px;
                        border: 1px solid rgba(128, 128, 128, 0.782);
                        margin: 2px;
                    }
                </style>
                <table class="table table-striped table-bordered">
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
                      <tr>
                          {{-- <td>una</td>
                          <td>una</td>
                          <td>una</td>
                        <td>una</td> --}}
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $company->logo ) }}" style="width: 60px;">
                        </td>
                        <td>{{ $company->website }}</td>
                        <td class="d-flex flex-column buttons-action">
                            <button type="button" class="btn ">{{ __('Edit') }}</button>
                            <button type="button" class="btn btn-danger">{{ __('Delete') }}</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
