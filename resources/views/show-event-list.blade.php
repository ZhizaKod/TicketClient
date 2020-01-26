@extends('layouts.default')

@section('content')

            <h2><a href="/">Show list</a> > Show #{{$showId}} Event list </h2>
            @foreach ($events as $item)
                <div class="row">
                    <div class="card mt-1 mb-1">
                        <a href="/event/{{$item->id}}">
                            <div class="card-body border-1">
                                @foreach ($item->properties as $property)
                                    <p><span class="text-muted">{{$property->name}}: </span>{{$property->value}}</p>
                                @endforeach
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @stop


