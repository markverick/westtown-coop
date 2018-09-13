<?php
#start session
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js'></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="navigation.css">

    <!-- CSS for Slider -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.css"> -->
    <!-- Slider JS -->
    <!--     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>
 -->
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

<body id="body" class="bg">
    <center>
        <div id="mySidenav" class="sidenav" style="min-height: 100vh; height: 100vh;">
            <div class="overlay"></div>
            <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
            <div id="navcontent" style="visibility: visible" class="container">
                <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                <meta name="google-signin-scope" content="profile email">
                <meta name="google-signin-client_id" content="391964544081-9i54pv48394r04gsc6398slnafogsarp.apps.googleusercontent.com">
                <script src="https://apis.google.com/js/platform.js" async defer></script>
                <script src="http://www.google.com/jsapi"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <h5 class="card-title" id="message">Sign in to continue</h5>

                <div style="display: inline-block" class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                <div id="logout" style="display: none;" onclick="logout()">
                    <div style="height:36px;width:120px;background-color: #c82333;" class="abcRioButton abcRioButtonBlue">
                        <div class="abcRioButtonContentWrapper"><span id="logouttxt" style="font-size:13px;line-height:34px;" class="abcRioButtonContents">Sign out</span></div>
                    </div>

                </div>
                <!-- <a class="black" id="logout" href="#logout" onclick="logout()" style="display: none;"></a> -->
                <hr>
                <p id="email" style="display: none;"></p>
                <div class="row">
                    <div id="content" class="col-lg-6 col-xl-6 col-md-6 col-sm-6">

                    </div>
                    <div id="perm" class="col-lg-6 col-xl-6 col-md-6 col-sm-6">

                    </div>
                </div>
                <div id="table">

                </div>
                <script>
                    //Sign in module
                    var id_token, profile;

                    function onSignIn(googleUser) {
                        // Useful data for your client-side scripts:
                        profile = googleUser.getBasicProfile();
                        // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                        // console.log('Full Name: ' + profile.getName());
                        // console.log('Given Name: ' + profile.getGivenName());
                        // console.log('Family Name: ' + profile.getFamilyName());
                        // console.log("Image URL: " + profile.getImageUrl());
                        // console.log("Email: " + profile.getEmail());

                        // The ID token you need to pass to your backend:
                        id_token = googleUser.getAuthResponse().id_token;

                        // console.log("ID Token: " + id_token);
                        var x = document.getElementsByClassName("name");
                        var i;
                        for (i = 0; i < x.length; i++) {
                            x[i].innerHTML = profile.getGivenName();
                        }
                        // document.getElementById("email").innerHTML = profile.getEmail();
                        document.getElementById("logouttxt").innerHTML = "Sign out";
                        document.getElementById("logout").style.display = "inline-block";
                        document.getElementById("email").innerHTML = profile.getEmail();
                        var email = document.getElementById("email").innerHTML;
                        console.log(email);
                        console.log("");
                        // if(document.getElementById("page").innerHTML=="Profile"&&""=="")
                        // {
                        //   console.log("aa");
                        //   document.location = "profile.php?user="+email;
                        // }
                        x = document.getElementsByClassName("profilePic");
                        var i;
                        for (i = 0; i < x.length; i++) {
                            x[i].src = profile.getImageUrl();
                        }
                        $.ajax({
                            type: 'POST',
                            url: 'php_scripts/auth.php',
                            data: {
                                email: profile.getEmail()
                            },
                            success: function(data) {
                                //alert("Rank = " + data);
								
                                if (data == "10") {
                                    document.getElementById("message").innerHTML = "Welcome admin " + profile.getGivenName() + " !";
                                    $("#content").load("php_scripts/panel.php");
                                    $("#perm").load("php_scripts/panelperm.php");
                                    $("#table").load("php_scripts/table.php");
									
                                } else if (data == "9") {
                                    document.getElementById("message").innerHTML = "Welcome moderator " + profile.getGivenName() + " !";
                                    $("#content").load("php_scripts/panel.php");
                                    $("#table").load("php_scripts/table.php");
									
                                } else {
                                    document.getElementById("message").innerHTML = "Welcome user " + profile.getGivenName() + " !";
                                    $("#content").load("php_scripts/denied.php");
									
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest);
                                alert(textStatus);
                                alert(errorThrown);
                            }
                        });
                    };
                    //Sign out
                    function logout() {
                        document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=" + location.href;
                        document.getElementByID("logout").style.display = "none";
                    }
                </script>
            </div>
        </div>
    </center>
    <div class="overlay"></div>
    <div id="nav" class="menu navbar-default navbar-fixed-top bg-dark">
        <button style="position: absolute; margin: 4.5px; margin-left: 12px;" class="btn btn-primary" id="sidebar" onclick="toggle_nav()" type="button">Open Control Panel</button>
        <center>
            <img style="position: static" src="website_images/logo_graphic.png">
        </center>
    </div>
    <center>
        <!--  <div class="header container">
        <h1 class="display-4">WESTTOWN LOWER SCHOOL</h1>
        <h2>Chicken Coop</h2>
    </div> -->

        <div id="main" class="main container">
            <div class="break container">
                <p class="black brand">Smart Lower School Chicken Coop</p>
                <p id="date" class="black"></p>
                <a href="tv_slideshow.php">Enter Slideshow</a>
                <!-- <p class="black">Raspberry pi is down and the door is closed until tomorrow morning (I crashed the pi)</p> -->
                <!-- <p>Good news is the video delay might be gone tomorrow</p> -->
            </div>
            <!-- Time -->
            <script>
                document.getElementById("date").innerHTML = Date();
            </script>
            <div class="row">
                <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <script src="video.js"></script>
                    <script src="videojs-contrib-hls.js"></script>
                    <video id=example-video class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls data-setup='{"fluid": true}'>
            <source
               src="hls/stream.m3u8"
               type="application/x-mpegURL">
          </video>
                </div>
                <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <video id=example-video2 class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls data-setup='{"fluid": true}'>
            <source
               src="hls/stream2.m3u8"
               type="application/x-mpegURL">
          </video>
                </div>
                <script>
                    var player2 = videojs('example-video2');
                    player2.play();
                    var player = videojs('example-video');
                    player.play();
                </script>
            </div>
            <p id="warningdisplay">No issues now</p>
            <div class="row">
                <div class="break col-lg-8 col-xl-8 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
                            <div class="card black" style="height: 220px">
                                <h5 class="card-header" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Hens tend to lay the most eggs when the temperature is anywhere from 45 degrees to 80 degrees. Anywhere below that, and the chickens will bunker up for the cold!">Temp</h5>
                                <div class="card-body" style="height: 100%">
                                    <!-- <h6 class="card-subtitle mb-2 text-muted">Sensor 1</h6> -->
                                    <p id="temp" class="card-text">Processing</p>
                                    <div id="chart_temp" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
                            <div class="card black" style="height: 220px">
                                <h5 class="card-header" data-toggle="tooltip" data-placement="top" title="Work in Progress">Water Temp</h5>
                                <div class="card-body" style="height: 100%">
                                    <!-- <h6 class="card-subtitle mb-2 text-muted">Sensor 1</h6> -->
                                    <p id="water" class="card-text">Processing</p>
                                    <div id="chart_wat" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
                            <div class="card black" style="height: 220px">
                                <h5 class="card-header" data-toggle="tooltip" data-placement="top" title="High humidity and high temperature can reduce egg production. Higher humidity and low tempertaure can easily cause frostbite.">Humidity</h5>
                                <div class="card-body" style="height: 100%">
                                    <p class="card-text" id="humid">Processing</p>
                                    <div id="chart_humid" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-6 col-sm-12">
                            <div class="card black" style="height: 220px">
                                <h5 class="card-header" data-toggle="tooltip" data-placement="top" title="Work in Progress">Voltage</h5>
                                <div class="card-body">
                                    <p class="card-text" id="volt">Processing</p>
                                    <div id="chart_volt" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="break col-lg-4 col-xl-4 col-md-12 col-sm-12">
                    <div class="card black" style="height: 220px">
                        <h5 class="card-header">Module Status</h5>
                        <div class="card-body" style="height: 100%;">
                            <table class="table">
                                <!-- <thead>
                <tr>
                  <th scope="col">Module</th>
                  <th scope="col">Status</th>
                </tr>
              </thead> -->
                                <tbody>
                                    <tr>
                                        <th scope="row">Door</th>
                                        <td id="door_status">Processing</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Water Heater</th>
                                        <td id="heater_status">Processing</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fan</th>
                                        <td id="fan_status">Processing</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- Graphs -->
                <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="card black" style="height: 100%">
                        <h5 class="card-header">Temperature Record</h5>
                        <div class="card-body">
                            <canvas id="chartjs-0" class="chartjs" width="1925" height="962"></canvas>
                        </div>
                    </div>

                </div>
                <div class="break col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="card black" style="height: 100%">
                        <h5 class="card-header">Humidity Record</h5>
                        <div class="card-body">
                            <canvas id="chartjs-1" class="chartjs" width="1925" height="962"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div id="footer" class="container white footer">

        <div class="row">
            <div class="break col-lg-4 col-xl-4 col-md-4 col-sm-4">
                <!-- <h6 class="card-subtitle mb-2 text-muted">Sensor 1</h6> -->
                Thanks to: Tom L. Gilbert, Larry J. Dech, Claire W. McLear<br> Project Managers: Omelet Theeranantachai'18 and Yiheng Xie'18<br> &copy; Copyright 2018 Computer Science 1
            </div>
            <div class="break col-lg-4 col-xl-4 col-md-4 col-sm-4">
                Contacts:<br><a href="mailto:yiheng.xie@westtown.edu">yiheng.xie@westtown.edu</a><br>484-402-6202<br><a href="mailto:omelet.theeranantachai@westtown.edu">omelet.theeranantachai@westtown.edu</a><br>484-995-9756
            </div>

            <div class="break col-lg-4 col-xl-4 col-md-4 col-sm-4">
                The smart Lower School Chicken Coop is a Computer Science Project completed in Spring 2018 by Omelet and Yiheng with the generous support from the above faculty. Major funding provided by Program and Innovation Team. Please contact project managers if
                technical issues incur.
            </div>
        </div>
    </div>



    <script type='text/javascript'>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $("#navcontent").fadeOut(0);

        function toggle_nav() {
            if (document.getElementById('sidebar').classList.contains('active')) {
                $("#navcontent").fadeOut(100);
                closeNav();
            } else {
                openNav();
                $("#navcontent").fadeIn(1000);
            }
        }

        /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
        function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
            document.getElementById("body").style.overflow = "hidden";
            document.getElementById('sidebar').classList.add('active');
            document.getElementById('sidebar').innerHTML = "Close Control Panel";
            document.getElementById('footer').display = "none";

        }

        /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("body").style.overflow = "visible";
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('sidebar').innerHTML = "Open Control Panel";
            document.getElementById('footer').display = "block";

        }
    </script>
    <!-- Script for door control -->
    <script type='text/javascript'>
        function door_open() {
            $.ajax({
                type: "POST",
                url: "door_button_open.php",
                data: "",
                success: function(msg) {
                    alert(msg);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Some error occured");
                }
            });

        }
    </script>

    <script type='text/javascript'>
        function door_close() {
            $.ajax({
                type: "POST",
                url: "door_button_close.php",
                data: "",
                success: function(msg) {
                    alert(msg);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Some error occured");
                }
            });

        }
    </script>

    <!-- Script for water heater control -->
    <script type='text/javascript'>
        var rot = 0;
        // setInterval(function(){
        //     document.getElementById("fanimg").style.transform = "rotate("+rot+"deg)";
        //     rot=rot+document.getElementById('ex1').value/30;
        // }, 10);


        function water_on() {
            $.ajax({
                type: "POST",
                url: "waterheater_button_action_on.php",
                data: "",
                success: function(msg) {
                    alert(msg);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Some error occured");
                }
            });

        }
    </script>

    <script type='text/javascript'>
        function water_off() {
            $.ajax({
                type: "POST",
                url: "waterheater_button_action_off.php",
                data: "",
                success: function(msg) {
                    alert(msg);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Some error occured");
                }
            });

        }
    </script>

    <!--Script for warning-->
    <script type="text/javascript">
        function warning() {
            document.getElementById("sidebar").style.backgroundColor = "red";
            document.getElementById("sidebar").style.borderColor = "red";
        }

        function updateWarning() {
            $.ajax({
                url: "droplet/volt.php",
                async: true,
                cache: false,
                success: function(stringData) {
                    var v = parseFloat(stringData);
                    v = v.toFixed(1);
                    if (v <= 12.2) {
                        document.getElementById("warningdisplay").innerHTML = "Voltage is low! Please check coop";
                        warning();
                    }
                }
            }).responseText;
            $.ajax({
                url: "droplet/door_status.php",
                async: true,
                cahce: false,
                success: function(stringData) {
                    if (stringData != "open" && stringData != "close") {
                        document.getElementById("warningdisplay").innerHTML = "Door issues! Please check coop";
                        warning();
                    }
                }

            }).responseText;
        }

        updateWarning();
        setInterval(function() {
            updateWarning()
        }, 1000);
    </script>


    <script type="text/javascript">
        function loadGraph() {
            var dattemp = {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Last 24 hours Temperature Record',
                        data: [],
                        lineTension: 0.1,
                        fill: false,
                        borderColor: '#111111'
                    }, {
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
            var dathumid = {
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
            Chart.defaults.global.elements.point.radius = 0;

            function updateGraph(begin) {
                $.ajax({
                    url: "droplet/tempdat.json",
                    async: true,
                    cache: false,
                    success: function(dat) {
                        dattemp['data']['datasets'][0]['data'] = dat;
                        if (begin === 0) {
                            scatterTemp = new Chart(document.getElementById("chartjs-0"), dattemp);
                        } else {
                            scatterTemp.data.datasets[0].data = dat;
                        }
                    }
                }).responseText;
                $.ajax({
                    url: "droplet/waterdat.json",
                    async: true,
                    cache: false,
                    success: function(dat) {
                        dattemp['data']['datasets'][1]['data'] = dat;
                        if (begin === 0) {
                            scatterTemp = new Chart(document.getElementById("chartjs-0"), dattemp);
                        } else {
                            scatterTemp.data.datasets[1].data = dat;
                        }
                    }
                }).responseText;
                $.ajax({
                    url: "droplet/humdat.json",
                    async: true,
                    cache: false,
                    success: function(dat) {
                        dathumid['data']['datasets'][0]['data'] = dat;
                        if (begin === 0) {
                            scatterHum = new Chart(document.getElementById("chartjs-1"), dathumid);
                        } else {
                            scatterHum.data.datasets[0].data = dat;
                        }
                    }
                }).responseText;
            }
            updateGraph(0);
            setInterval(function() {
                updateGraph(1); // load graph after every x seconds
            }, 10000);
        }
        loadGraph();
        google.charts.load('current', {
            'packages': ['gauge']
        });
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
                width: 120,
                height: 120,
                redFrom: 76,
                redTo: 120,
                greenFrom: 65,
                greenTo: 76,
                yellowFrom: -42,
                yellowTo: 65,
                minorTicks: 5,
                max: 120,
                min: -42
            };
            var options_v = {
                width: 120,
                height: 120,
                redFrom: 11,
                redTo: 11.2,
                yellowFrom: 11.2,
                yellowTo: 12,
                greenFrom: 12,
                greenTo: 13.4,
                minorTicks: 5,
                min: 11,
                max: 13.4,
            };
            var options_h = {
                width: 120,
                height: 120,
                redFrom: 70,
                redTo: 100,
                greenFrom: 50,
                greenTo: 70,
                yellowFrom: 0,
                yellowTo: 50,
                minorTicks: 5,
                max: 100,
            };

            var chart_t = new google.visualization.Gauge(document.getElementById('chart_temp'));
            var chart_w = new google.visualization.Gauge(document.getElementById('chart_wat'));
            var chart_v = new google.visualization.Gauge(document.getElementById('chart_volt'));
            var chart_h = new google.visualization.Gauge(document.getElementById('chart_humid'));

            chart_t.draw(temp, options);
            chart_w.draw(wat, options);
            chart_v.draw(volt, options_v);
            chart_h.draw(hum, options_h);

            function updateGuage() {
                $.ajax({
                    url: "droplet/temp.php",
                    async: true,
                    cache: false,
                    success: function(stringData) {
                        var far = parseFloat(stringData);
                        far = far.toFixed(1);
                        // alert("Data Loaded: " + temp);
                        // $("#temp").load("temp.php");
                        temp.setValue(0, 1, far);
                        chart_t.draw(temp, options);

                        document.getElementById("temp").innerHTML = far + " F";
                    }
                }).responseText;
                $.ajax({
                    url: "droplet/water_temp.php",
                    async: true,
                    cache: false,
                    success: function(stringData) {
                        var far = parseFloat(stringData);
                        far = far.toFixed(1);
                        // alert("Data Loaded: " + temp);
                        // $("#temp").load("temp.php");
                        temp.setValue(0, 1, far);
                        chart_w.draw(temp, options);
                        document.getElementById("water").innerHTML = far + " F";
                    }
                }).responseText;
                $.ajax({
                    url: "volt.php",
                    async: true,
                    cache: false,
                    success: function(stringData) {
                        var v = parseFloat(stringData);
                        v = v.toFixed(1);
                        // alert("Data Loaded: " + temp);
                        // $("#temp").load("temp.php");
                        volt.setValue(0, 1, v);
                        chart_v.draw(volt, options_v);
                        document.getElementById("volt").innerHTML = v + " V";
                    }
                }).responseText;
                $.ajax({
                    url: "droplet/humid.php",
                    async: true,
                    cache: false,
                    success: function(stringData) {
                        var h = parseFloat(stringData);
                        h = h.toFixed(1);
                        // alert("Data Loaded: " + temp);
                        // $("#temp").load("temp.php");
                        hum.setValue(0, 1, h);
                        chart_h.draw(hum, options_h);

                        document.getElementById("humid").innerHTML = h + " %";
                    }
                }).responseText;
            }
            updateGuage();
            setInterval(function() {
                updateGuage() // load temp after every x seconds
            }, 10000);
        }
        setInterval(function() {
            document.getElementById("date").innerHTML = Date();
        }, 1000);
        setInterval(function() {
            $.ajax({
                url: "droplet/door_status.php",
                async: true,
                cache: false,
                success: function(stringData) {
                    document.getElementById("door_status").innerHTML = stringData;
                }
            }).responseText;
            $.ajax({
                url: "droplet/water_heater_status.php",
                async: true,
                cache: false,
                success: function(stringData) {
                    document.getElementById("heater_status").innerHTML = stringData;
                }
            }).responseText;
            $.ajax({
                url: "droplet/fan_status.php",
                async: true,
                cache: false,
                success: function(stringData) {
                    document.getElementById("fan_status").innerHTML = stringData;
                }
            }).responseText;
        }, 1000);

        // loadGuage(); //  on page load
    </script>
    </main>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




</body>

</html>