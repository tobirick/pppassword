@extends('partials.layout')
@section('title', $Lang->getTranslation('Users'))

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Users')}}</h1>
        <a class="button button--primary" href="{{route('users.create')}}">{{$Lang->getTranslation('Create new User')}}</a>
    </div>
    <div class="content-box content-box--main">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>E-Mail</th>
                <th>Phone</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td class="table__actions">
                        <a title="{{$Lang->getTranslation('View')}} {{$user->first_name}} {{$user->last_name}}" href="{{route('users.show', ['userId' => $user->id])}}"><i class="fal fa-eye"></i></a>
                        <a title="{{$Lang->getTranslation('Edit')}} {{$user->first_name}} {{$user->last_name}}" href="{{route('users.edit', ['userId' => $user->id])}}"><i class="fal fa-user-edit"></i></a>
                        <form action="{{route('users.delete', ['userId' => $user->id])}}" method="POST">
                            {{csrf()}}
                            {{method('DELETE')}}
                            <button title="{{$Lang->getTranslation('Delete')}} {{$user->first_name}} {{$user->last_name}}"><i class="fal fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@stop