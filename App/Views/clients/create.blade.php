@extends('partials.layout')
@section('title', $Lang->getTranslation('Create new Client'))

@section('content')
    <div class="content-header">
        <h1>{{$Lang->getTranslation('Create new Client')}}</h1>
        <a class="button button--primary" href="{{route('clients')}}">{{$Lang->getTranslation('Go back')}}</a>
    </div>
    <div class="content-box content-box--main">
        @include('includes.errors')
        <form action="{{route('clients.store')}}" method="POST">
            {{csrf()}}
            <div class="form-row">
                <input class="form-input" type="email" name="client[email]" placeholder="E-Mail">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[name]" placeholder="Name">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[phone]" placeholder="Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[mobile_phone]" placeholder="Mobile Phone Number">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[city]" placeholder="City">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[plz]" placeholder="PLZ">
            </div>
            <div class="form-row">
                <input class="form-input" type="text" name="client[street]" placeholder="Street">
            </div>
            <div class="form-row">
                <textarea class="form-input" name="client[notes]" placeholder="Notes"></textarea>
            </div>
            <button class="button button--primary button--block">{{$Lang->getTranslation('Create')}}</button>
        </form>
    </div>
@stop