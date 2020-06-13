<!DOCTYPE html>
<html lang="en">
<!--
    Web Programming
    Name: Alan Pedersen
    ID: P225139
    Date: 3/04/2020
    Project 
    Movie Search Page
-->

<head>
    <meta charset="UTF-8">
    <title>Movie Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <style type="text/css">    
        * {
            margin: 10;
            padding: 10;

        }
        
        nav {
            margin-top: 10px;
        }
    
        nav ul {
            display: flex;
            list-style: none;
            align-items: left;
            justify-content: center;    
        }
    
        nav a {
            color: black;
            font-weight: bold;
            display: block;
            padding: 15px;
            text-decoration: none;
        }

        nav a:hover {
        	color: red;
        }

        body {
            background-color: lightblue;
        }
        
        h1 {
            color: black;
            text-align: left;
        }
        
        h2 {
            text-align: left;
            font-size: 16px;
        }
        
        p {
            font-family: verdana;
            font-size: 12px;

        }

        ul {
            font-family: verdana;
            font-size: 16px;
            list-style-type: none;
            margin: 10;
            padding: 20;
            background-color: #dddddd;
            width: 400px;

        }

        .top10chart {
            padding: 5px;
            margin: 5px;
        }

        .chartSmall {
            width: 325px; 
            height: 220px;
        }

        .chartMedium {
            width: 400px; 
            height: 280px;
        }

        .chartLarge {
            width: 600px; 
            height: 420px;
        }

        @media (max-width: 399px) {
            .chartSmall {
                display: flow; 
            }
            .chartMedium {
                display: none; 
            }
            .chartLarge {
                display: none; 
            }

        }

        @media (min-width: 400px)  and (max-width: 599px) {
            .chartSmall {
                display: none; 
            }
            .chartMedium {
                display: flow; 
            }
            .chartLarge {
                display: none; 
            }
        }

        @media (min-width: 600px) {
            .chartSmall {
                display: none; 
            }
            .chartMedium {
                display: none; 
            }
            .chartLarge {
                display: flow; 
            }
        }

    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // load the google chart code
        google.charts.load("current", {packages:["corechart"]});
        // set the call to the draw chart function
        google.charts.setOnLoadCallback(drawChart);
        // define the chart drawing function
        function drawChart() {
            var now = new Date();
            var nowDisplay = now.toLocaleTimeString();
            var dataSearch = google.visualization.arrayToDataTable(
                <?php require 'movie_top_10_google_data_scr.php'; ?>);
            var optionsSearch = {
                title: "top 10 movie searches as at: " + nowDisplay,
                bar: {groupWidth: "90%"},
                legend: { position: "none" },
                vAxis: { textStyle: { fontSize: 10}},
                hAxis: { minValue: 5000, title: 'number searches'}};

            var dataRating = google.visualization.arrayToDataTable(
                <?php require 'movie_top_rating_google_data_scr.php'; ?>);
            var optionsRating = {
                title: "top 10 rated movies as at: " + nowDisplay,
                bar: {groupWidth: "90%"},
                legend: { position: "none" },
                vAxis: { textStyle: { fontSize: 10}},
                hAxis: { minValue: 0, maxValue: 5.5, title: 'viewer rating'}};

          // create the search charts
          // create and draw the small chart
          var chartSmlSearch = new google.visualization.BarChart(document.getElementById("chart_sml_search"));
          chartSmlSearch.draw(dataSearch, optionsSearch);
          // create and draw the medium chart
          var chartMedSearch = new google.visualization.BarChart(document.getElementById("chart_med_search"));
          chartMedSearch.draw(dataSearch, optionsSearch);
          // create and draw the large chart
          var chartMedSearch = new google.visualization.BarChart(document.getElementById("chart_lge_search"));
          chartMedSearch.draw(dataSearch, optionsSearch);

          // create the rating charts
          // create and draw the small chart
          var chartSmlRating = new google.visualization.BarChart(document.getElementById("chart_sml_rating"));
          chartSmlRating.draw(dataRating, optionsRating);
          // create and draw the medium chart
          var chartMedRating = new google.visualization.BarChart(document.getElementById("chart_med_rating"));
          chartMedRating.draw(dataRating, optionsRating);
          // create and draw the large chart
          var chartMedRating = new google.visualization.BarChart(document.getElementById("chart_lge_rating"));
          chartMedRating.draw(dataRating, optionsRating);
        }
    </script>
    <script>
        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("updateChart.php");
            source.onmessage = function(event) {
                drawChart();
                // document.getElementById("sse_message").innerHTML += event.data + "<br>";
            };
        } else {
            document.getElementById("sse_message").innerHTML 
            = "Sorry, your browser does not support server-sent events...";
        }
    </script>

</head>

<body>
<header>
        <H1>Acme Entertainment</H1>
    </header>

    <nav>
        <ul>
            <li class="active"><a href="SearchMovies.php">search form</a></li>
            <li><a href="Top10.php">top 10 movies</a></li>
			<li><a href="SignUp.php">sign up</a></li>
			<li><a href="./admin/UnsubscribeUsers.php">admin</a></li>
        </ul>
    </nav>

    <section class="top10chart">
            <h1>Top 10 Movie Searches</h1>
            <div id="chart_sml_search" class="chartSmall"></div>
            <div id="chart_med_search" class="chartMedium"></div>
            <div id="chart_lge_search" class="chartLarge"></div>
            <h1>Top 10 Rated Movies</h1>
            <div id="chart_sml_rating" class="chartSmall"></div>
            <div id="chart_med_rating" class="chartMedium"></div>
            <div id="chart_lge_rating" class="chartLarge"></div>
            <div id="sse_message"></div>
    </section>

</body>

</html>
