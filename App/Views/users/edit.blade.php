@extends('partials.layout')
@section('title', $Lang->getTranslation('Edit User') . '"' . $user->first_name . ' ' . $user->last_name . '"' )

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Edit User')}} "{{$user->first_name}} {{$user->last_name}}"</h1>
        <a class="button button--primary" href="{{route('users')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>
    <div class="content-box content-box--main">
        @include('includes.errors')
        <form action="{{route('users.update', ['userId' => $user->id])}}" method="POST">
            {{csrf()}}
            {{method('PUT')}}
            <div class="form-row">
                <input class="form-input" type="email" name="user[email]" value="{{$user->email}}" placeholder="E-Mail">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[username]" value="{{$user->username}}" placeholder="Username">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[first_name]" value="{{$user->first_name}}" placeholder="First Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[last_name]" value="{{$user->last_name}}" placeholder="Last Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[phone]" value="{{$user->phone}}" placeholder="Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[mobile_phone]" value="{{$user->mobile_phone}}" placeholder="Mobile Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[city]" value="{{$user->city}}" placeholder="City">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[plz]" value="{{$user->plz}}" placeholder="PLZ">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[street]" value="{{$user->street}}" placeholder="Street">
            </div>
            <div class="form-row">
                <textarea class="form-input" name="user[notes]" placeholder="Notes">{{$user->notes}}</textarea>
            </div>
            <button class="button button--primary button--block">{{$Lang->getTranslation('Update User')}} "{{$user->first_name}} {{$user->last_name}}"</button>
        </form>
    </div>
@stop