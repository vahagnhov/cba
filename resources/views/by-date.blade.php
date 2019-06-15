@extends('layouts.layout')

@section('title')RATES BY DATE @endsection

@section('content')
    <section class="section">
        <div class="container">
            <br/> <br/>
            <h2>Show Rates By Date And ISO</h2>
            <br/><br/>
            <h1>Iso Code - {{$currencies}}</h1>
            <h1>Date - {{$date}}</h1>
            <h1 style="color: green;">Rate - {{$rate}}</h1>
        </div>
    </section>
@endsection




