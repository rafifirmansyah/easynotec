@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary"><h5 class="pt-2 text-white">Welcome {{ Auth::User()->name }}</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center">EasyNote C</h3>
                    <br>
                    <div class="logo text-center" >
                        <img src="images/note.png"style="width:230px;" alt="">
                    </div>
                    <br>
                    <h5 class="text-center">Makes it Easy to Save Your Credentials in Notes</h5>

                    <br>
                    <a href="{{ route('note.index') }}" class="btn btn-success">Let's Write Note</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
