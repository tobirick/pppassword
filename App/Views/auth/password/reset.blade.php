@extends('partials.layout')
@section('title', 'Reset Password')

@section('content')
<div class="container center-h-flex center-v-flex h-100">
    <div class="col-8">
        <div class="content-box">
            <div class="content-box__title"><h1>{{$Lang->getTranslation('Reset your password')}}</h1></div>
            @include('includes.errors')
            <form action="{{ route('password.reset') }}" method="POST">
                {{ csrf() }}
                <input type="hidden" name="_password_reset_token" value="{{ $_password_reset_token }}">
                <div class="form-row">
                    <input class="form-input" type="password" placeholder="New Password" name="user[password]">
                </div>
                <div class="form-row">
                    <button class="button button--primary" type="Submit">{{$Lang->getTranslation('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop