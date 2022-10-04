<div class="mt-5">
    @if(Request::route()->getName() !== 'statistics-index')
        <a href="{{ route('statistics-index') }}">Статистика</a>
    @endif
    @if(Request::route()->getName() !== 'home')
        <a href="{{ route('home') }}">Головна</a>
    @endif
</div>
