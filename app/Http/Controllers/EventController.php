<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function index()
    {
        $search = request('search');

        if ($search) {
            $events = Events::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Events::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    function event()
    {
        return view('events.create');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'city' => 'required',
                'private' => 'required',
                'description' => 'required',
                'image' => 'required',
                'date' => 'required',
            ],
            [
                'title.required' => 'Titulo obrigatorio',
                'city.required' => 'Cidade obrigatoria',
                'private.required' => 'Tipo de privacidade obrigatoria',
                'description.required' => 'Descrição obrigatoria',
                'image.required' => 'Imagem obrigatoria',
                'date.required' => 'Data do evento obrigatoria',
            ]
        );
        $event = new Events;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->date = $request->date;
        $event->description = $request->description;
        $event->items = $request->items;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');
    }

    public function show($id)
    {
        $event = Events::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id)
    {
        Events::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso');
    }

    public function edit($id)
    {
        $event = Events::findOrFail($id);

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Events::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso');
    }

    public function joinEvent($id)
    {
        $user = auth()->user();

        $user->eventAsParticipant->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }
}
