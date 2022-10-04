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
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
        <form method="post" action="{{ @route('statistics-get') }}" role="form" class="text-center m-t-20 mb-5">
            {{ @csrf_field() }}
            <div class="form-group">
                <h3>Скорочувач посилань</h3>
                <h4>Переглянути статистику</h4>
                <div class="input-group mt-3">
                    <input name="q" type="text" class="form-control {{ $errors->has('q') ? 'error' : '' }}"
                           placeholder="Посилання або скорочене посилання">
                    <span class="input-group-btn">
                        <button type="submit"
                                class="btn btn-info">Переглянути</button>
                    </span>
                </div>
            </div>
        </form>
        @include('web.components.footer.links')
    </div>
@endsection
