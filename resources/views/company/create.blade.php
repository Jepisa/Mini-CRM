@extends('layouts.app')

@section('content')
@if ($errors->any())
    <!-- Validation Errors -->
    <div class="mb-4 m-auto w-50" :errors="$errors">
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
    <form class="p-2 w-100 w-xs-50 m-auto" action="{{ route('company.store', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-between">
            <h2>{{ __('Create new company') }}</h2>
            <a href="{{ route('company.index', app()->getLocale()) }}">{{ __('Back') }}</a>
        </div>
        <div class="row g-3 p-1">
            <div class="col">
                <input required name="name" type="text" class="form-control" placeholder="name" aria-label="name"
                    value="{{ old('name') }}"
                >
            </div>
            <div class="col">
                <input name="email" type="email" class="form-control" placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}"
                    value="{{ old('email') }}"
                >
            </div>
        </div>
        <div class="row g-3 p-1">
            
            <input class=" col" name="logo" type="file" class="form-control" placeholder="name" aria-label="name">
            <div class="col">
                <input name="website" type="text" class="form-control" placeholder="{{ __('WebSite') }}" aria-label="{{ __('WebSite') }}"
                    value="{{ old('website') }}"
                >
            </div>
        </div>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </div>
    </form>

@if(Session()->exists('notification'))
    <div id="notification" class="d-flex bg-info text-white max-w-sm md:max-w-md mb-4" style="display:none; cursor:pointer; right: -150vw; top:5px; position:fixed; transition: right 2s;">
        <div class="w-16 bg-green-400">
            <div class="p-4 display-4">
                !
            </div>
        </div>
        <div class="w-auto text-gray-500 align-items-center p-4">
            <span class="text-lg font-bold pb-4">
                {{ __('Notification!') }}
            </span>
            <p class="leading-tight">
                {{ __(Session()->get('notification')) }}
            </p>
        </div>
    </div>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
    var notification = document.querySelector('#notification');

    if (notification) 
    {

        notification.style.display = "flex";
        
        setTimeout(() => {
            notification.style.right = "10px";
        }, 500);
        setTimeout(() => {
            notification.style.transition = "right 0.5s";
            notification.style.right = "1px";
        }, 2500);

        setTimeout(() => {
            sacarLaNotificacion();
        }, 7000);

        notification.addEventListener('click', (event) => {
            sacarLaNotificacion();
        });


        function sacarLaNotificacion()
        {
            notification.style.pointerEvents = "none";
            setTimeout(() => {
                notification.style.right = "10px";
            }, 500);
            setTimeout(() => {
                notification.style.transition = "right 2s";
                notification.style.right = "-150vw";
            }, 1000);
            setTimeout(() => {
                notification.remove();
            }, 3500);
        }

    }
});
</script>    
@endif
@endsection