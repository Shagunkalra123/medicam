@extends('layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
           
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="meeting_today">0</h3>

                <p>Meetings</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              @can('isAdmin')
              <a href="{{route('meeting_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="followup_today">0</h3>

                <p>Follow ups</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              @can('isAdmin')
              <a href="{{ route('followup_list') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="im_enq">0</h3>

                <p>IndiaMart Enquiries</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
               @can('isAdmin')
              <a href="{{route('indiamart_list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="ebay_orders">0</h3>

                <p>Ebay Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              @can('isAdmin')
              <a href="{{route('ebaylisting_page')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                @endcan
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            
            <!-- /.card -->

            <!-- DIRECT CHAT -->
           
            <!--/.direct-chat -->

            <!-- TO DO List -->
            <div class="card">
            
              <!-- /.card-header -->
              
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">India Mart Enquiry</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart1" style="height:230px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
<div class="card">
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Followup</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- Map card -->
            <!--<div class="card bg-primary-gradient">
              <div class="card-header no-border">
                <h3 class="card-title">
                  <i class="fa fa-map-marker mr-1"></i>
                  Ebay
                </h3>
                <!-- card tools
                <div class="card-tools">
                  <button type="button"
                          class="btn btn-primary btn-sm daterange"
                          data-toggle="tooltip"
                          title="Date range">
                    <i class="fa fa-calendar"></i>
                  </button>
                  <button type="button"
                          class="btn btn-primary btn-sm"
                          data-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body
              <div class="card-footer bg-transparent">
                <div class="row">
                  
                  <!-- ./col
                  
                  <!-- ./col
                  
                  <!-- ./col
                </div>
                <!-- /.row
              </div>
            </div>-->
            <!-- /.card -->

            <!-- solid sales graph -->
           <!-- <div class="card bg-info-gradient">
           
            <!-- /.card

            <!-- Calendar
         
              <!-- /.card-body
            </div>-->
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div>
@endsection
@section('javascript')

  
<script>
  

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$( document ).ready(function() {
  // setInterval(function(){ for_display_orders(); }, 40000);
//  debugger;
  //      $.ajax({
          
  //         url: "/Meeting/counter/",
  //         type: "GET",
  //         processData:false,
  //         contentType:false,
  //         cache:false,
  //         success: function (month_meet) {
            
            
  //         var dates = [];
  //     //  debugger;
  //       var jan=month_meet["01"];
  //       dates.push(jan);
  // var feb=month_meet["02"];
  // dates.push(feb);
  // var mar=month_meet["03"];
  // dates.push(mar);
  // var april=month_meet["04"];
  // dates.push(april);
  // var may=month_meet["05"];
  // dates.push(may);
  // var june=month_meet["06"];
  // dates.push(june);
  // var july=month_meet["07"];
  // dates.push(july);
  // var august=month_meet["08"];
  // dates.push(august);
  // var sept=month_meet["09"];
  // dates.push(sept);
  // var oct=month_meet["10"];
  // dates.push(oct);

  // var nov=month_meet["11"];
  // dates.push(nov);
  // var dec=month_meet["12"];
  // dates.push(dec);
  // test(dates); 

      
  //         },
  //     }); 
  //follow counter 
      $.ajax({          
          url: "/Followup/counter_true/",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (follow_Data) {
             var dates_followup = [];
                      var jan=follow_Data["01"];
                                  dates_followup.push(jan);
                            var feb=follow_Data["02"];
                            dates_followup.push(feb);
                            var mar=follow_Data["03"];
                            dates_followup.push(mar);
                            var april=follow_Data["04"];
                            dates_followup.push(april);
                            var may=follow_Data["05"];
                            dates_followup.push(may);
                            var june=follow_Data["06"];
                            dates_followup.push(june);
                            var july=follow_Data["07"];
                            dates_followup.push(july);
                            var august=follow_Data["08"];
                            dates_followup.push(august);
                            var sept=follow_Data["09"];
                            dates_followup.push(sept);
                            var oct=follow_Data["10"];
                            dates_followup.push(oct);

                            var nov=follow_Data["11"];
                            dates_followup.push(nov);
                            var dec=follow_Data["12"];
                            dates_followup.push(dec);
              test(dates_followup);         
          },
      });
      $.ajax({
          
          url: "/india_mart/counter_true/",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (follow_Data) {
            console.log(follow_Data);
             var dates_followup = [];
                      var jan=follow_Data["01"];
                                  dates_followup.push(jan);
                            var feb=follow_Data["02"];
                            dates_followup.push(feb);
                            var mar=follow_Data["03"];
                            dates_followup.push(mar);
                            var april=follow_Data["04"];
                            dates_followup.push(april);
                            var may=follow_Data["05"];
                            dates_followup.push(may);
                            var june=follow_Data["06"];
                            dates_followup.push(june);
                            var july=follow_Data["07"];
                            dates_followup.push(july);
                            var august=follow_Data["08"];
                            dates_followup.push(august);
                            var sept=follow_Data["09"];
                            dates_followup.push(sept);
                            var oct=follow_Data["10"];
                            dates_followup.push(oct);

                            var nov=follow_Data["11"];
                            dates_followup.push(nov);
                            var dec=follow_Data["12"];
                            dates_followup.push(dec);    
              test2(dates_followup);

            //setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });

////////order count for display
       $.ajax({
          
          url: "/display_count",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_today_date) {
            get_created_at(data_today_date);
            

            //setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
///////////////////////////////////////////////////////////////////////
 $.ajax({
          
          url: "/indiamart/today",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
          document.getElementById("im_enq").innerHTML = data;
          

            //setTimeout(function() { location.reload(); }, 2000); 
         
         },
          
         
      });
        
});

function test2(month_meet)
{
  var data_true=month_meet;
  $(function () {
   var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','november','december'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : []
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(67,155,188,0.9)',
          strokeColor         : 'rgba(65,14,188,0.8)',
          pointColor          : '#ffbf00 ',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_true
        }
      ]
    }
    var barChartCanvas                   = $('#barChart1').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
   
 
  
}

function test(month_meet)
{
  var data_true=month_meet;
  $(function () {
   var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','november','december'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : []
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(67,155,188,0.9)',
          strokeColor         : 'rgba(65,14,188,0.8)',
          pointColor          : '#ffbf00 ',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_true
        }
      ]
    }
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
    

}
 function for_display_orders()
    {
       $.ajax({
          
          url: "/indiamart",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data) {
           //show_indiamart_notification(data);
           document.getElementById("ebay_orders").innerHTML = data_count;

            //setTimeout(function() { location.reload(); }, 2000); 
         
         },
          
         
      });

      
  
    }
    function get_created_at(data_today_date)
    {
      // debugger;
      var createdat_count=0;
  for (i = 0; i < data_today_date.length; i++) { 
 var date_in_loop= data_today_date[i]['created_at'];
 var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes();

today = yyyy + '-' + mm + '-' + dd;
var loop_date= date_in_loop.split(" ");
if(today==loop_date[0])
{
  createdat_count++;


}
}

document.getElementById("ebay_orders").innerHTML = createdat_count;
//show_ebay_notification(data);
    }

    function show_ebay_notification(data_count)
    {
      if (data_count!=0)
      {
      toastr.success("There are "+data_count+" new Orders in Ebay <br/> <a class='close-toastr'> Ok </a>", "", {
    tapToDismiss: false
    , timeOut: 0
    , extendedTimeOut: 0
    , allowHtml: true
    , preventDuplicates: true
    , preventOpenDuplicates: true
    , newestOnTop: true
    });
    
    }



$('.close-toastr').on('click', function () {
    toastr.clear($(this).closest('.toast'));
});
    }

    function orders_count(){

     
$.ajax({
          
          url: "/order_count",
          type: "GET",
          processData:false,
          contentType:false,
          cache:false,
          success: function (data_count) {
           show_ebay_notification(data_count);
           

            //setTimeout(function() { location.reload(); }, 2000); 
         
          },
          
         
      });
     }

  

function parse_date(data)
{ 
  
  var meeting_count=0;
  for (i = 0; i < data.length; i++) { 
 var date_in_loop= data[i]['meeting_date'];
 var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes();

today = yyyy  + '-' + mm + '-' + dd;
if(today==date_in_loop)
{
  meeting_count++;
}
}
document.getElementById("meeting_today").innerHTML = meeting_count;

}

function parse_followup(data)
{ 
  // debugger;
  var Followup_count=0;
  for (i = 0; i < data.length; i++) { 
 var date_in_loop= data[i]['rem_date'];
 var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes();

today = yyyy + '-' + mm + '-' + dd;
if(today==date_in_loop)
{
  Followup_count++;
}
}

document.getElementById("followup_today").innerHTML = Followup_count;

}
$.get("/Meeting/showall/", function (data) {
         parse_date(data);
});
$.get("/followup/showall/", function (data) {
  parse_followup(data);
});
</script>

@endsection