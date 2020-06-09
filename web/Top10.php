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
            var data = google.visualization.arrayToDataTable(
                <?php require 'movie_top_10_google_data_scr.php'; ?>);
            var options = {
                title: "top 10 movie searches",
                bar: {groupWidth: "90%"},
                legend: { position: "none" },
                vAxis: { textStyle: { fontSize: 10}},
                hAxis: { minValue: 5000, title: 'number searches'}
          };
          // create and draw the small chart
          var chartSml = new google.visualization.BarChart(document.getElementById("chart_sml"));
          chartSml.draw(data, options);
          // create and draw the medium chart
          var chartMed = new google.visualization.BarChart(document.getElementById("chart_med"));
          chartMed.draw(data, options);
          // create and draw the large chart
          var chartMed = new google.visualization.BarChart(document.getElementById("chart_lge"));
          chartMed.draw(data, options);
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
            <div id="chart_sml" class="chartSmall"></div>
            <div id="chart_med" class="chartMedium"></div>
            <div id="chart_lge" class="chartLarge"></div>

    </section>

</body>

</html>
