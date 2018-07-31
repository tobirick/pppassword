@extends('partials.layout')
@section('title', $Lang->getTranslation('Edit Client') . '"' . $client->name . '"' )

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Edit Client')}} "{{$client->name}}"</h1>
        <a class="button button--primary" href="{{route('clients')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>
    <div class="content-box content-box--main">
        @include('includes.errors')
        <form action="{{route('clients.update', ['clientId' => $client->id])}}" method="POST">
            {{csrf()}}
            {{method('PUT')}}
            <div class="form-row">
                <input class="form-input" type="email" name="client[email]" value="{{$client->email}}" placeholder="E-Mail">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[name]" value="{{$client->name}}" placeholder="Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[phone]" value="{{$client->phone}}" placeholder="Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[mobile_phone]" value="{{$client->mobile_phone}}" placeholder="Mobile Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[city]" value="{{$client->city}}" placeholder="City">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[plz]" value="{{$client->plz}}" placeholder="PLZ">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[street]" value="{{$client->street}}" placeholder="Street">
            </div>
            <div class="form-row">
                <textarea class="form-input" name="client[notes]" placeholder="Notes">{{$client->notes}}</textarea>
            </div>
            <button class="button button--primary button--block">{{$Lang->getTranslation('Update Client')}} "{{$client->name}}"</button>
        </form>
    </div>
@stop