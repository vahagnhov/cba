@extends('layouts.layout')

@section('title')Charts @endsection

@section('content')
    <section class="section">
        <div class="container">
            <form method="POST" action="{{ route('getRatesByDate') }}">
                @csrf
                <div class='col-sm-3'>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" id="date" name="date" class="form-control">
                    </div>
                </div>

                <button id="renderBtn">
                    Render
                </button>
                <div class="container">
                    <canvas id="myChart"></canvas>
                </div>
            </form>
        </div>
    </section>
    <script>
        function renderChart(data, labels) {

            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'This week',
                        data: data,
                    }]
                },
            });
        }

        $("#renderBtn").click(
            function () {
                data = [20000, 14000, 12000, 15000, 18000, 19000, 22000];
                labels = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
                renderChart(data, labels);
            }
        );
    </script>
    <script>
        $(document).ready(function () {

            $(function () {
                $("#date").datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                }).datepicker("setDate", new Date());

            });
        });

    </script>
@endsection
