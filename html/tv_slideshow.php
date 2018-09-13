<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="icon" href="../../../../favicon.ico">

    <title>Chicken Coop</title>
    <link rel="icon" href="website_images/big-brown-chicken.jpg">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="noscroll.css">
    <!-- Custom styles for this template -->
    <!-- <link href="starter-template.css" rel="stylesheet"> -->

    <script src="jquery-3.3.1.min.js"></script>
    <script src="Chart.bundle.js"></script>

    <!-- Google Chart -->
    <!-- Google Chart API -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- button action -->
    <script type='text/javascript' src='//code.jquery.com/jquery-1.10.1.js'></script>

    <!-- Video Player -->
		<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">

		<!-- If you'd like to support IE8 -->
		<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  </head>

  <body>
  	
  <!-- 	<div class="header container">
        <h1 class="display-4">WESTTOWN LOWER SCHOOL</h1>
        <h2>Chicken Coop</h2>
    </div> -->
    <div class="slideshow">
      <div class="bg">
        <center>
        <div class="overlay"></div>
        <div id="nav" class="menu navbar-default navbar-fixed-top bg-dark">
          <img style="position: static" src="website_images/logo_graphic.png">
        </div>
        <div class="container main">
          <div class="break container">
            <h1 class="black brand">Smart Lower School Chicken Coop</h1>
            <p id="date" class="black"></p>
          </div>
              <!-- Time -->
          <script>
            document.getElementById("date").innerHTML = Date();
          </script>
          <div class="break row">
            <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
              <div class="card black" style="height: 100%">
                <h3 class="card-header">Temp</h3>
                <div class="card-body" style="height: 100%">
                  <!-- <h6 class="card-subtitle mb-2 text-muted">Sensor 1</h6> -->
                  <p id="temp" class="card-text">Processing</p>
                  <div id="chart_temp" style="width: 100%;"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
              <div class="card black" style="height: 100%">
                <h3 class="card-header">Water Temp</h3>
                <div class="card-body" style="height: 100%">
                  <!-- <h6 class="card-subtitle mb-2 text-muted">Sensor 1</h6> -->
                  <p id="water" class="card-text">Processing</p>
                  <div id="chart_wat" style="width: 100%;"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
              <div class="card black" style="height: 100%">
                <h3 class="card-header">Humidity</h3>
                <div class="card-body" style="height: 100%">
                  <p class="card-text" id="humid">Processing</p>
                  <div id="chart_humid" style="width: 100%;"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
              <div class="card black" style="height: 100%">
                <h3 class="card-header">Voltage</h3>
                <div class="card-body">
                  <p class="card-text" id="volt">Processing</p>
                  <div id="chart_volt" style="width: 100%;"></div>
                </div>
              </div>
            </div>
          </div>
      
          <div class="row">
    <!-- Graphs -->
            <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
              <div class="card black">
                <h3 class="card-header">Temperature Record</h3>
                <div class="card-body">
                  <canvas id="chartjs-0" class="chartjs" width="1925" height="962"></canvas>
                </div>
              </div>

            </div>
            <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
              <div class="card black">
                <h3 class="card-header">Humidity Record</h3>
                <div class="card-body">
                  <canvas id="chartjs-1" class="chartjs" width="1925" height="962"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div style="margin-bottom: 100%"></div>
        </div>
      </center>
      </div>
      <div class="video">
        <script src="video.js"></script>
        <script src="videojs-contrib-hls.js"></script>
        <video id=example-video class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls data-setup='{"fluid": true}'>
          <source
             src="hls/stream.m3u8"
             type="application/x-mpegURL">
        </video>
        <script>
        var player = videojs('example-video');
        player.play();
        </script>
      </div>
      <div class="video2">
        <script src="video.js"></script>
        <script src="videojs-contrib-hls.js"></script>
        <video id=example-video2 class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls data-setup='{"fluid": true}'>
          <source
             src="hls/stream2.m3u8"
             type="application/x-mpegURL">
        </video>
        <script>
        var player2 = videojs('example-video2');
        player2.play();
        </script>
      </div>
      
    </div>














    <script type='text/javascript'>
     $(".slideshow > div:gt(0)").hide();

    setInterval(function() {
      player.play();
      player2.play();
      $('.slideshow > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('.slideshow');
    },  12000);

    function water_on(){
      $.ajax({
         type: "POST",
         url: "waterheater_button_action_on.php",
         data: "",
         success: function(msg){
             alert(msg);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Some error occured");
         }
         });

    }
    </script>




    <script type='text/javascript'>
    function water_off(){
      $.ajax({
         type: "POST",
         url: "waterheater_button_action_off.php",
         data: "",
         success: function(msg){
             alert(msg);
         },
         error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Some error occured");
         }
         });

    }
    </script>

    <script type="text/javascript">
      function loadGraph() {
        var dattemp= {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Last 24 hours Temperature Record',
                    data: [],
                    lineTension: 0.1,
                    fill: false,
                    borderColor: '#111111'
                },
                {
                    label: 'Last 24 hours Water Temperature Record',
                    data: [],
                    lineTension: 0.1,
                    fill: false,
                    borderColor: '#002659'
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        position: 'bottom'
                    }]
                },
                duration: 0
            }
        }
        var dathumid= {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Last 24 hours Humidity Record',
                    data: [],
                    lineTension: 0.1,
                    fill: false,
                    borderColor: '#111111'
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        position: 'bottom'
                    }]
                },
                duration: 0
            }
        }
        var scatterTemp;
        var scatterHum;
        Chart.defaults.global.elements.point.radius=0;
        function updateGraph(begin) {
          $.ajax({
            url: "droplet/tempdat.json",
            async: true,
            cache: false,
            success:function(dat) {
              dattemp['data']['datasets'][0]['data']=dat;
              if (begin===0) {
                scatterTemp = new Chart(document.getElementById("chartjs-0"),dattemp);
              }
              else {
                scatterTemp.data.datasets[0].data=dat;
              }
            }
          }).responseText;
          $.ajax({
            url: "droplet/waterdat.json",
            async: true,
            cache: false,
            success:function(dat) {
              dattemp['data']['datasets'][1]['data']=dat;
              if (begin===0) {
                scatterTemp = new Chart(document.getElementById("chartjs-0"),dattemp);
              }
              else {
                scatterTemp.data.datasets[1].data=dat;
              }
            }
          }).responseText;
          $.ajax({
            url: "droplet/humdat.json",
            async: true,
            cache: false,
            success:function(dat) {
              dathumid['data']['datasets'][0]['data']=dat;
              if (begin===0) {
                scatterHum = new Chart(document.getElementById("chartjs-1"),dathumid);
              }
              else {
                scatterHum.data.datasets[0].data=dat;
              }
            }
          }).responseText;
        }
        updateGraph(0);
        setInterval(function(){
            updateGraph(1); // load graph after every x seconds
        }, 10000);
      }
      loadGraph();
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(loadGuage);
      function loadGuage() {
        var temp = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Temperature', 120]
        ]);
        var volt = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Voltage', 120]
        ]);
        var hum = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Humidity', 120]
        ]);
        var wat = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Water T.', 120]
        ]);

        var options = {
          width: 200, height: 200,
          redFrom: 76, redTo: 120,
          greenFrom: 65, greenTo: 76,
          yellowFrom: -42, yellowTo: 65,
          minorTicks: 5, max: 120, min: -42
        };
        var options_v = {
          width: 200, height: 200,
          redFrom: 11, redTo: 11.2,
          yellowFrom: 11.2, yellowTo: 12,
          greenFrom: 12, greenTo: 13.4,
          minorTicks: 5, min: 11, max: 13.4,
        };
        var options_h = {
          width: 200, height: 200,
          redFrom: 70, redTo: 100,
          greenFrom: 50, greenTo: 70,
          yellowFrom: 0, yellowTo: 50,
          minorTicks: 5, max: 100,
        };

        var chart_t = new google.visualization.Gauge(document.getElementById('chart_temp'));
        var chart_w = new google.visualization.Gauge(document.getElementById('chart_wat'));
        var chart_v = new google.visualization.Gauge(document.getElementById('chart_volt'));
        var chart_h = new google.visualization.Gauge(document.getElementById('chart_humid'));

        chart_t.draw(temp, options);
        chart_w.draw(wat, options);
        chart_v.draw(volt, options_v);
        chart_h.draw(hum, options_h);

        function updateGuage(){
          $.ajax({
            url: "droplet/temp.php",
            async: true,
            cache: false,
            success:function(stringData)
            {
              var far=parseFloat(stringData);
              far=far.toFixed(1);
              // alert("Data Loaded: " + temp);
              // $("#temp").load("temp.php");
              temp.setValue(0, 1, far);
              chart_t.draw(temp, options);

              document.getElementById("temp").innerHTML=far+" F";
            }
          }).responseText;
          $.ajax({
            url: "droplet/water_temp.php",
            async: true,
            cache: false,
            success:function(stringData)
            {
              var far=parseFloat(stringData);
              far=far.toFixed(1);
              // alert("Data Loaded: " + temp);
              // $("#temp").load("temp.php");
              temp.setValue(0, 1, far);
              chart_w.draw(temp, options);
              document.getElementById("water").innerHTML=far+" F";
            }
          }).responseText;
          $.ajax({
            url: "droplet/volt.php",
            async: true,
            cache: false,
            success:function(stringData)
            {
              var v=parseFloat(stringData);
              v=v.toFixed(1);
              // alert("Data Loaded: " + temp);
              // $("#temp").load("temp.php");
              volt.setValue(0, 1, v);
              chart_v.draw(volt, options_v);

              document.getElementById("volt").innerHTML=v+" V";
            }
          }).responseText;
          $.ajax({
            url: "droplet/humid.php",
            async: true,
            cache: false,
            success:function(stringData)
            {
              var h=parseFloat(stringData);
              h=h.toFixed(1);
              // alert("Data Loaded: " + temp);
              // $("#temp").load("temp.php");
              hum.setValue(0, 1, h);
              chart_h.draw(hum, options_h);

              document.getElementById("humid").innerHTML=h+" %";
            }
          }).responseText;
        }
        updateGuage();
        setInterval(function(){
            updateGuage() // load temp after every x seconds
        }, 10000);
      }
      setInterval(function(){
        document.getElementById("date").innerHTML=Date();
      }, 1000);

      // loadGuage(); //  on page load
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




  </body>
</html>
