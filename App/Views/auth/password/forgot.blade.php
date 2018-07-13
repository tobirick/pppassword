@extends('partials.layout')
@section('title', 'Forgot Password')

@section('content')
<div class="container center-h-flex center-v-flex h-100">
    <div class="col-8">
        <div class="content-box">
            <div class="content-box__title"><h1>{{$Lang->getTranslation('Forgot your password?')}}</h1></div>
            @include('includes.errors')
            <form action="{{ route('password.forgot') }}" method="POST">
                {{ csrf() }}
                <div class="form-row">
                    <input class="form-input" type="email" placeholder="E-Mail" name="user[email]">
                </div>
                <div class="form-row">
                    <button class="button button--primary" type="Submit">{{$Lang->getTranslation('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop