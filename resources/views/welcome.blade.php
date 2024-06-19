@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    @foreach ($events as $event)
        <div id="search-container" class="col-md-12">
            <h1>Busque um evento</h1>
            <form action="/" method="GET">
                <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
            </form>
        </div>
        <div id="event-container" class="col-md-12">
            @if ($search)
                <h1>Sua pesquisa é: {{ $search }}</h1>
            @else
                <h2 class="subtitle">Proximos Eventos</h2>
                <p>Veja os eventos dos proximos dias</p>
            @endif
            <div class="cards-container rows">
                @foreach ($events as $event)
                    <div class="div card col-md-3">
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                        <div class="car-body">
                            <p class="card-date">
                                {{ date('d/m/Y', strtotime($event->date)) }}
                            </p>
                            <h5 class="card-title">
                                {{ $event->title }}
                            </h5>
                            <p class="card-participants">
                                x participantes
                            </p>
                            <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @if (count($events) == 0)
        <p>Não há eventos disponíveis</p>
    @endif
@endsection
