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
        <form method="post" action="{{ @route('link-store') }}" role="form" class="text-center m-t-20 mb-5">
            {{ @csrf_field() }}
            <div class="form-group">
                <h3>Скорочувач посилань</h3>
                <div class="input-group mt-3">
                    <input name="link" type="text" class="form-control {{ $errors->has('link') ? 'error' : '' }}"
                           placeholder="Посилання">
                    <span class="input-group-btn">
                        <button type="submit"
                                class="btn btn-info">Згенерувати</button>
                    </span>
                </div>
                <div class="text-sm-start">
                    @if ($errors->has('link'))
                        <div class="error">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <p class="text-muted">Введіть посилання</p>
                </div>
                <div class="mt-3 text-sm-start">
                    <input name="code" type="text" class="form-control {{ $errors->has('code') ? 'error' : '' }}"
                           placeholder="Введіть коротку тезу за бажанням">
                    @if ($errors->has('code'))
                        <div class="error">
                            {{ $errors->first('code') }}
                        </div>
                    @endif
                    <p class="text-muted">Тезу буде переведено в трансліт</p>
                </div>
                <div class="mt-3 text-sm-start">
                    <input name="expired_date" id="datetimepicker" type="text"
                           class="form-control {{ $errors->has('expired_date') ? 'error' : '' }}" required
                           placeholder="Виберіть дату та час">
                    @if ($errors->has('expired_date'))
                        <div class="error">
                            {{ $errors->first('expired_date') }}
                        </div>
                    @endif
                    <p class="text-muted">Мінімальна дата +1 час, максимальна +1 місяць</p>
                </div>
            </div>
        </form>
        @include('web.components.footer.links')
    </div>
@endsection
