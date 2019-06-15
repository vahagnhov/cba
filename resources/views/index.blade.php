@extends('layouts.layout')

@section('title')HOME @endsection

@section('content')
    <section class="section">
        <div class="container">
            <form method="POST" action="{{ route('iso-codes') }}">
                @csrf
                <div>
                    <button type="submit" class="btn btn-success">Get Iso Codes by SOAP</button>
                </div>
            </form>

            <br/><br/>

            <form method="POST" action="{{ route('parseCurrencies') }}">
                @csrf
                @if (session('error-message'))
                    <div class="alert alert-danger">
                        {{ session('error-message') }}
                    </div>
                @endif
                @if (session('success-message'))
                    <div class="alert alert-success">
                        {{ session('success-message') }}
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-success">Scrap Iso Codes, rates and amount and INSERT DB</button>
                </div>
            </form>

            <br/><br/>
        </div>

        <div class="container">
            <h2>ISO Codes Table Today (By Scrap) ({{$date}})</h2>
            @if(count($currencies))
                <table class="table table-bordered">

                    <thead>
                    <tr>
                        <th>ISO(code)</th>
                        <th>Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr>
                            <td><span>{{$currency->currency}}</span><span class="unit">{{$currency->unit}}</span></td>
                            <td>{{$currency->rate}}</td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            @else
                <p>Iso Codes table is empty now!</p>
            @endif
        </div>

    </section>
@endsection
