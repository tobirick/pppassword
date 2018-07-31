@extends('partials.layout')
@section('title', $Lang->getTranslation('Client') . ' ' . $client->name . '"')

@section('content')
    <div class="content-header">
        <div>
            <h1>{{$Lang->getTranslation('Client')}} "{{$client->name}}"</h1>
            <a class="ml-1" title="{{$Lang->getTranslation('Edit')}} {{$client->name}}" href="{{route('clients.edit', ['clientId' => $client->id])}}"><i class="fal fa-user-edit"></i></a>
        </div>
        <a class="button button--primary" href="{{route('clients')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>

    <div class="content-box content-box--main">
        <div>
            <strong>E-Mail:</strong> {{$client->email}}
        </div>
        <div>
            <strong>Name:</strong> {{$client->name}}
        </div>
        <div>
            <strong>Phone Number:</strong> {{$client->phone}}
        </div>
        <div>
            <strong>Mobile Phone Number:</strong> {{$client->mobile_phone}}
        </div>
        <div>
            <strong>City:</strong> {{$client->city}}
        </div>
        <div>
            <strong>PLZ:</strong> {{$client->plz}}
        </div>
        <div>
            <strong>Street:</strong> {{$client->street}}
        </div>
        <div>
            <strong>Notes:</strong> {{$client->notes}}
        </div>

    </div>
@stop