@extends('partials.layout')
@section('title', $Lang->getTranslation('Clients'))

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Clients')}}</h1>
        <a class="button button--primary" href="{{route('clients.create')}}">{{$Lang->getTranslation('Create new Client')}}</a>
    </div>
    <div class="content-box content-box--main">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->name}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->phone}}</td>
                    <td class="table__actions">
                        <a title="{{$Lang->getTranslation('View')}} {{$client->name}}" href="{{route('clients.show', ['clientId' => $client->id])}}"><i class="fal fa-eye"></i></a>
                        <a title="{{$Lang->getTranslation('Edit')}} {{$client->name}}" href="{{route('clients.edit', ['clientId' => $client->id])}}"><i class="fal fa-user-edit"></i></a>
                        <form action="{{route('clients.delete', ['clientId' => $client->id])}}" method="POST">
                            {{csrf()}}
                            {{method('DELETE')}}
                            <button title="{{$Lang->getTranslation('Delete')}} {{$client->name}}"><i class="fal fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@stop