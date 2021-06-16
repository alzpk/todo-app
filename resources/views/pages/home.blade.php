@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>
                    <div class="card-body">
                        You are logged in, as <strong>{{ auth()->user()->name }}</strong>!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
