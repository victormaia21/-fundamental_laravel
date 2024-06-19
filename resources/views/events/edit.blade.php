@extends('layouts.main')

@section('title', 'Editando ' . $event->title . '');

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando: {{ $event->title }}</h1>
        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem do evento:</label>
                <input type="file" id="image" name="image" class="from-control-file">
                <img src="/img/events/{{ $event->image }}" alt="img-preview" class="img-preview">
                @error('image')
                    <p class="msg-erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Data do evento:</label>
                <input type="date" class="form-control" id="title" placeholder="Data do evento" name="date"
                    value="{{ $event->date }}">
                @error('date')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" placeholder="Nome do evento" name="title"
                    value="{{ $event->title }}">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Cidade:</label>
                <input type="text" class="form-control" id="city" placeholder="Local do evento" name="city"
                    value="{{ $event->city }}">
                @error('city')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">O evento é privado:</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" value="{{ $event->private == 1 ? "selected='selected'" : '' }}">Sim</option>
                </select>
                @error('private')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Descrição do evento:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Descrição do evento">{{ $event->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Adicione itens de insfraestrutura</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cadeiras"> Cadeira
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco"> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cerveja gratis"> Cerveja gratís
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open food"> Open Food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Brindes"> Brindes
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Editar evento">
        </form>
    </div>

@endsection
