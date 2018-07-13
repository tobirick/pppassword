@extends('partials.layout')
@section('title', 'Register')

@section('content')
<div class="container center-h-flex center-v-flex h-100">
    <div class="col-8">
        <div class="content-box">
            <div class="content-box__title"><h1>{{$Lang->getTranslation('Register')}}</h1></div>
            @include('includes.errors')
            <form action="{{ route('register') }}" method="POST">
                {{ csrf() }}
                <div class="form-row">
                    <input class="form-input" type="email" placeholder="E-Mail" name="user[email]">
                </div>
                <div class="form-row">
                    <input class="form-input" type="password" placeholder="Password" name="user[password]">
                </div>
                <div class="form-row">
                    <button class="button button--primary button--block" type="Submit">{{$Lang->getTranslation('Send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop