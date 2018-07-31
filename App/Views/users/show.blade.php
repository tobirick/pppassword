@extends('partials.layout')
@section('title', $Lang->getTranslation('User') . ' ' . $user->first_name . ' ' . $user->last_name . '"' )

@section('content')
    <div class="content-header">
        <div>
            <h1>{{$Lang->getTranslation('User')}} "{{$user->first_name}} {{$user->last_name}}"</h1>
            <a class="ml-1" title="{{$Lang->getTranslation('Edit')}} {{$user->first_name}} {{$user->last_name}}" href="{{route('users.edit', ['userId' => $user->id])}}"><i class="fal fa-user-edit"></i></a>
        </div>
        <a class="button button--primary" href="{{route('users')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>

    <div class="content-box content-box--main">
        <div>
            <strong>E-Mail:</strong> {{$user->email}}
        </div>
        <div>
            <strong>Username:</strong> {{$user->username}}
        </div>
        <div>
            <strong>First Name:</strong> {{$user->first_name}}
        </div>
        <div>
            <strong>Last Name:</strong> {{$user->last_name}}
        </div>
        <div>
            <strong>Phone Number:</strong> {{$user->phone}}
        </div>
        <div>
            <strong>Mobile Phone Number:</strong> {{$user->mobile_phone}}
        </div>
        <div>
            <strong>City:</strong> {{$user->city}}
        </div>
        <div>
            <strong>PLZ:</strong> {{$user->plz}}
        </div>
        <div>
            <strong>Street:</strong> {{$user->street}}
        </div>
        <div>
            <strong>Notes:</strong> {{$user->notes}}
        </div>

    </div>
@stop