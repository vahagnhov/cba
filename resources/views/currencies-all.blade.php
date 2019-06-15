@extends('layouts.layout')

@section('title')ALL ISO CODES @endsection

@section('content')
    <section class="section">

        <div class="container">
            <h2>ISO codes Table By Date In The Range</h2>

            <form method="POST" action="{{ route('parseCurrenciesByDate') }}">
                @csrf

                <input type="hidden" name="currencies" id="currencies" value="">
                <input type="hidden" name="count" id="count" value="0">

                <div class="row">
                    <div class='col-sm-3'>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" id="start_date" name="start_date" class="form-control">
                        </div>
                    </div>

                    <div class='col-sm-3'>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="text" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class='col-sm-3'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Details</button>
                        </div>
                    </div>
                </div>

            </form>

            @if(count($currencies))
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ISO(code)</th>
                        <th>Rates in Armenian dram</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($currencies as $currency)
                        <tr>
                            <td><span>{{$currency->currency}}</span></td>
                            <td><input type="checkbox" class="checkbox_check" data-id="{{$currency->currency}}"/></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>ISO codes table is empty now!</p>
            @endif
        </div>

        <script>
            $(document).ready(function () {

                $("input.checkbox_check").change(function () {

                    var currency = $(this).attr("data-id");
                    var currencies = $('#currencies').val();
                    var firstCurrency = currencies.substring(0, 3);
                    var count = parseInt($('#count').val());

                    var diff = currencies.replace("," + currency, '');

                    if (this.checked) {
                        $('#count').val(count + 1);
                        if (currencies == '') {
                            $('#currencies').val(currency);
                        } else {
                            $('#currencies').val(currencies + "," + currency);
                        }
                    } else {
                        $('#count').val(count - 1);
                        if (currency == currencies) {
                            $('#currencies').val('');
                        } else if (currency != currencies && currency == firstCurrency) {
                            $('#currencies').val(currencies.substring(4));
                        } else {
                            $('#currencies').val(diff);
                        }
                    }
                });


                $(function () {
                    $("#start_date").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    }).datepicker("setDate", new Date(new Date().getFullYear(), 0, 1, 0, 0, 0)).on('changeDate', function (selected) {
                        var startDate = new Date(selected.date.valueOf());
                        $('#end_date').datepicker('setStartDate', startDate);
                    }).on('clearDate', function (selected) {
                        $('#end_date').datepicker('setStartDate', null);
                    });
                    $("#end_date").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    }).datepicker("setDate", new Date()).on('changeDate', function (selected) {
                        var endDate = new Date(selected.date.valueOf());
                        $('#start_date').datepicker('setEndDate', endDate);
                    }).on('clearDate', function (selected) {
                        $('#start_date').datepicker('setEndDate', null);
                    });

                });
            });

        </script>

    </section>
@endsection
