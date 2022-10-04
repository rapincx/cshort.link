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
                {{Session::get('status')}}
            </div>
        @endif
        <div class="form-group">
            <h3 class="text-center">Скорочувач посилань</h3>
            <div class="input-group mt-3">
                <input name="link" type="text" data-copy-text="1" class="form-control" disabled placeholder="Посилання"
                       value="{{ $link->getVisitLink() }}">
                <span class="input-group-btn">
                        <button type="button"
                                class="btn btn-info js-copy-btn" data-text="1">Скопіювати</button>
                    </span>
            </div>
        </div>
        @include('web.components.footer.links')
    </div>
@endsection
