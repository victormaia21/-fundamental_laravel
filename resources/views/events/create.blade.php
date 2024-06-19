@extends("layouts.main")

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="image">Imagem do evento:</label>
            <input type="file" id="image" name="image" class="from-control-file">
            @error('image')
                <p class="msg-erro">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="title" placeholder="Data do evento" name="date">
            @error('date')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" placeholder="Nome do evento" name="title">
            @error('title')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" placeholder="Local do evento" name="city">
            @error('city')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">O evento é privado:</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
            @error('private')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Descrição do evento:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do evento"></textarea>
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
        <input type="submit" class="btn btn-primary" value="Criar evento">
    </form>
</div>
    
@endsection