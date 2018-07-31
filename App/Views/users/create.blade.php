@extends('partials.layout')
@section('title', $Lang->getTranslation('Create new User'))

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Create new User')}}</h1>
        <a class="button button--primary" href="{{route('users')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>
    <div class="content-box content-box--main">
        @include('includes.errors')
        <form action="{{route('users.store')}}" method="POST">
            {{csrf()}}
            <div class="form-row">
                <input class="form-input" type="email" name="user[email]" placeholder="E-Mail">
            </div>
            <div class="form-row">
                <input class="form-input" type="password" name="user[password]" placeholder="Password">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[username]" placeholder="Username">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[first_name]" placeholder="First Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[last_name]" placeholder="Last Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[phone]" placeholder="Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[mobile_phone]" placeholder="Mobile Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[city]" placeholder="City">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[plz]" placeholder="PLZ">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="user[street]" placeholder="Street">
            </div>
            <div class="form-row">
                <textarea class="form-input" name="user[notes]" placeholder="Notes"></textarea>
            </div>
            <button class="button button--primary button--block">{{$Lang->getTranslation('Create')}}</button>
        </form>
    </div>
@stop