@extends('layouts.app')
@extends('layouts.sidebaradmin')



@section('content')
<h1 style="margin-left:100px">Data Anak Posyandu Kabupaten Bantul</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome ') }} {{ Auth::user()->name }} !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
