@extends('layouts.app')

@section('content')
<div class="col m-auto d-flex flex-row justify-content-center" style="max-width: 720px;">
    
    <form class="form-horizontal col" id="form_graph">
        <legend>Category graph</legend>
        <fieldset>
            <div class="form-group">
                <label class="col control-label" for="date1">Posts created/updated at</label>
                <div class="col">
                    <input id="date1" required name="date1" type="date" class="form-control input-md" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col">
                    <input id="date2" required name="date2" type="date" class="form-control input-md" value="{{ date('Y-m-d') }}">
                </div> 
            </div>
        </fieldset>
        <button type="submit"  class="btn btn-primary">Search</button>
    </form> 

<div class='col' id="chart-container"><canvas id="myChart" width="400" height="400"></canvas></div>



</div>
@endsection

@push('scripts')

<script>
    var url = "/reports/generate/category_graph";
    
    $(document).ready(function(){
        $("#form_graph").on("submit", function(e){
            e.preventDefault();
            $("#myChart").remove();
            $("#chart-container").append('<canvas id="myChart" width="400" height="400"></canvas>');
            $.get(url, {"date1": $("#date1").val(), "date2": $("#date2").val()},function(response){
                var Categories = new Array();
                var Labels = new Array();
                var Posts = new Array();
                response = JSON.parse(response);
                response.forEach(function(data){
                    Categories.push(data.name);
                    Labels.push(data.name);
                    Posts.push(data.nof_posts);
                });
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:Categories,
                        datasets: [{
                            label: 'Nº of Posts',
                            data: Posts,
                            borderWidth: 1,
                            backgroundColor: "#3490dc"
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                    max: 10
                                }
                            }]
                        }
                    }
                });
                
            });
        });
    });
    
    // var myChart = new Chart(ctx, {
    //     type: 'pie',
    //     data: {
    //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    //         datasets: [{
    //             label: '# of Votes',
    //             data: [12, 19, 3, 5, 2, 3],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255, 99, 132, 1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });
    // $(document).ready(function(){
    //     console.log("passo");
    // })
    </script>
@endpush
