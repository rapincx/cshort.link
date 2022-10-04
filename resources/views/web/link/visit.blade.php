@extends('web.layout')
@section('title')
    CShort.link
@endsection
@section('content')
    <div class="wrapper-page bootstrap snippets bootdeys">
        <div class="text-center">
            <a href="#" class="logo logo-lg">
                <img class="logo-img" src="/assets/img/logo.png" alt="logo">
                <span>CShort</span>
            </a>
        </div>
        @if(Session::has('status'))
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        @endif
        <div class="form-group">
            <h3 class="text-center">Скорочувач посилань</h3>
            <p>Посилання не діюче або такого не існує.</p>
            <a href="{{ route('home') }}">Створити посилання</a>
        </div>
        @include('web.components.footer.links')
    </div>
@endsection
