@extends('layouts.layout')

@section('title')ISO CODES @endsection

@section('content')
    <section class="section">
        <div class="container">
            @if(count($errors))
                <div class="alert alert-success">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ISO(code)</th>
                            <th>Amount</th>
                            <th>Rate</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>@if ($errors->has('ISO')) {{ $errors->first('ISO') }}@endif</td>
                            <td>@if ($errors->has('amount')) {{ $errors->first('amount') }}@endif</td>
                            <td>@if ($errors->has('rate')) {{ $errors->first('rate') }}@endif</td>
                            <td>@if ($errors->has('date')) {{ $errors->first('date') }}@endif</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            @endif
            <br>
            <h1>Select date and ISO for getting rate (By SOAP) </h1>
            <br>
            <form method="POST" action="{{ route('getRates') }}">
                @csrf
                <input type="hidden" name="currency" id="currency" value="USD">

                <div class='col-sm-3'>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" id="date" name="date" class="form-control">
                    </div>
                </div>

                <div class='col-sm-3'>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Details</button>
                    </div>
                </div>

            </form>
            <h2>ISO Codes (By SOAP)</h2>
            @if(count($currencies))
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>N</th>
                        <th>ISO(code)</th>
                        <th>Rates in Armenian dram</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $key=>$currency)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$currency}}</td>
                            <td><input type="radio" @if($currency=='USD') checked="checked" @endif name="radio[]"
                                       class="checkbox_check" data-id="{{$currency}}"/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>ISO Codes table is empty now!</p>
            @endif
        </div>
        <script>
            $(document).ready(function () {

                $("input.checkbox_check").change(function () {

                    var currency = $(this).attr("data-id");

                    if (this.checked) {
                        $('#currency').val(currency);
                    } else {
                        $('#currency').val();
                    }
                });

                $(function () {
                    $("#date").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                    }).datepicker("setDate", new Date());

                });
            });

        </script>
    </section>
@endsection
