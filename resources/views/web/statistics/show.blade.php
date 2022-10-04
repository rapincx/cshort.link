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
        <div class="form-group">
            <h3>Скорочувач посилань</h3>
            <p>Посилання - {{ $link->link }}</p>
            <p>Ідентифікатор - {{ $link->code }}</p>
            <p>Відвідувань - {{ $link->visited }}</p>
        </div>
        @include('web.components.footer.links')
    </div>
@endsection
