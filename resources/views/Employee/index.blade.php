@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xs-9">

            <h1 class="display-4">{{ __('Employees') }}</h1>
            <table class="table table-striped table-bordered table-responsive" style="max-width: max-content; margin: auto;">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-baseline">
                    <a class="btn btn-primary m-2" href="{{ route('employee.create') }}">
                        {{ __('Create new employee') }}
                    </a>
                    {{ $employees->links() }}
                </div>
                <thead>
                    <tr>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Last Name') }}</th>
                    <th scope="col">{{ __('Employee') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Phone') }}</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->lastname }}</td>
                            <td>{{ $employee->company->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td class="d-flex flex-column buttons-action">
                                <a class="btn btn-primary" href="{{ route('employee.edit',['employeeName' => $employee->slug]) }}">{{ __('Edit') }}</a>
                    
                                <form class="" style="min-width: 20px; text-align:center; margin: 5px 0;" method="POST" action="{{ route('employee.destroy',['employeeName' => $employee->slug]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a  type="submit" href="{{route('employee.destroy', ['employeeName' => $employee->slug])}}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();" class="btn btn-danger delete">
                                    {{ __('Delete') }}
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
                  {{ $employees->links() }}
            </div>
    </div>
</div>
@endsection
