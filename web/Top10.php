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
    <!-- import the nav bar style sheet -->
    <link rel="stylesheet" href="menu_nav.css">
    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- import the base style sheet -->
    <link rel="stylesheet" href="base.css">

    <style type="text/css">    
        .navMenuTop10 {
            background-color: darkgrey;
        }

        .top10chart {
            padding: 5px;
            margin: 5px;
        }

        .chartSmall {
            width: 325px; 
            height: 220px;
        }

        .listSearches,
        .listRatings {
            width: 325px;
            position: relative;
            border: 3px solid #f1f1f1;
            padding: 5px;
            background-color: white;
            display: none;
        }

        .searchListLable {
            cursor: pointer;
        }
        
        .searchListLable:hover {
            color: red;
            text-decoration: underline;
        }

        @media (max-width: 399px) {
            .chartSmall {
                width: 325px;
                height: 220px 
            }
            .listSearches,
            .listRatings {
                width: 325px;
            }
        }

        @media (min-width: 400px)  and (max-width: 599px) {
            .chartSmall {
                width: 400px;
                height: 280px 
            }
            .listSearches,
            .listRatings {
                width: 400px;
            }
        }

        @media (min-width: 600px) {
            .chartSmall {
                width: 600px;
                height: 420px 
            }
            .listSearches,
            .listRatings {
                width: 600px;
            }
        }

    </style>

    <script type="text/javascript" 
        src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" 
        src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        // load the google chart code
        google.charts.load("current", {packages:["corechart"]});
        // set the call to the draw chart function
        google.charts.setOnLoadCallback(drawChart);

        // define the chart drawing function
        function drawChart() {
            var now = new Date();
            var nowDisplay = now.toLocaleTimeString();

            // initialse the data tables for the charts
            var dataRating = new google.visualization.DataTable(); 
            var dataSearch = new google.visualization.DataTable(); 
            // initialise the lists for the data tables
            var listDataSearch = "<ul>";
            var listDataRating = "<ul>";

            $.get("movie_top_10_google_csv_scr.php",  
                function( data) {
                    var dataList = data.split("~");
                    
                    dataSearch.addColumn("string",'number');
                    dataSearch.addColumn("number",'Searches');
                    dataSearch.addColumn({role:'annotation'});

                    dataSearch.addRows(10);

                    for( i = 1; i < 11; i++)
                    {
                        // set the values for this record in the data table
                        dataSearch.setCell( i-1, 0, dataList[i*3]);
                        dataSearch.setCell( i-1, 1, dataList[i*3+1]);
                        dataSearch.setCell( i-1, 2, dataList[i*3+2]);

                        // set the list entry for this record
                        listDataSearch = listDataSearch.concat("<li>", 
                            dataList[i*3], " " , dataList[i*3+2], " with ", 
                            dataList[i*3+1], " search hits</li>");

                    }

                    // finish the search list
                    listDataSearch = listDataSearch.concat("</ul>");

                    var optionsSearch = {
                    title: "top 10 movie searches as at: " + nowDisplay,
                    bar: {groupWidth: "90%"},
                    legend: { position: "none" },
                    vAxis: { textStyle: { fontSize: 10}},
                    hAxis: { minValue: 5000, title: 'number searches'}};

                    // create the search charts
                    // create and draw the small chart
                    var chartSmlSearch = new 
                        google.visualization.BarChart(document.getElementById("chart_sml_search"));
                    chartSmlSearch.draw(dataSearch, optionsSearch);
                    // set the list in the page
                    document.getElementById("list_searches").innerHTML = listDataSearch;

                }
            );

            $.get("movie_top_rating_google_csv_scr.php",  
                function( data) {
                    var dataList = data.split("~");
                    
                    dataRating.addColumn("string",'number');
                    dataRating.addColumn("number",'Rating');
                    dataRating.addColumn({role:'annotation'});

                    dataRating.addRows(10);

                    for( i = 1; i < 11; i++)
                    {
                        dataRating.setCell( i-1, 0, dataList[i*3]);
                        dataRating.setCell( i-1, 1, dataList[i*3+1]);
                        dataRating.setCell( i-1, 2, dataList[i*3+2]);

                        // set the list entry for this record
                        listDataRating = listDataRating.concat("<li>", 
                            dataList[i*3], " " , dataList[i*3+2], 
                            " with an average rating of ", 
                            dataList[i*3+1], "</li>");

                    }

                    // finish the search list
                    listDataRating = listDataRating.concat("</ul>");
            
                    var optionsRating = {
                        title: "top 10 rated movies as at: " + nowDisplay,
                        bar: {groupWidth: "90%"},
                        legend: { position: "none" },
                        vAxis: { textStyle: { fontSize: 10}},
                        hAxis: { minValue: 0, maxValue: 5.5, title: 'viewer rating'}
                    };

                    // create the rating charts
                    // create and draw the small chart
                    var chartSmlRating = new
                        google.visualization.BarChart(document.getElementById("chart_sml_rating"));
                    chartSmlRating.draw(dataRating, optionsRating);
                    // set the list in the page
                    document.getElementById("list_ratings").innerHTML = listDataRating;

                }
            );
        }
    </script>
    <script>
        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("updateChart.php");
            source.onmessage = function(event) {
                drawChart();
                // location.reload();
                // document.getElementById("sse_message").innerHTML += event.data + "<br>";
            };
        } else {
            document.getElementById("sse_message").innerHTML 
            = "Sorry, your browser does not support server-sent events...";
        }
    </script>

    <script>
        function showSearchList() {
            var status = document.getElementById("list_searches").style.display;

            if( status != "block") {
                document.getElementById("list_searches").style.display = "block";
                document.getElementById("search_list_label").innerText = 
                    "Accessible Text Only List (click to hide)";
            }
            else {
                document.getElementById("list_searches").style.display = "none";
                document.getElementById("rating_list_label").innerText = 
                    "Accessible Text Only List (click to display)";
            }
        }

        function showRatingList() {
            var status = document.getElementById("list_ratings").style.display;

            if( status != "block") {
                document.getElementById("list_ratings").style.display = "block";
                document.getElementById("rating_list_label").innerText = 
                    "Accessible Text Only List (click to hide)";
            }
            else {
                document.getElementById("list_ratings").style.display = "none";
                document.getElementById("rating_list_label").innerText = 
                    "Accessible Text Only List (click to display)";
            }
        }
    </script>

</head>

<body>
    <header>
        <H1>Acme Entertainment</H1>
    </header>

    <nav>
        <?php require 'menu_nav_scr.php'; ?>
    </nav>

    <section class="top10chart">
            <h1>Top 10 Movie Searches</h1>
            <div id="chart_sml_search" class="chartSmall" 
                aria-label="chart of top 10 movies ranked by search hits. full details in following section"> 
                <img alt="top 10 movies ranked by search hits. full details in following section"/>
            </div>

            <div>
                <h3 id="search_list_label" class="searchListLable" 
                    onclick = "showSearchList()">
                Accessible Text Only List (click to display)</h3>
            </div>
            
            <div id="list_searches" class="listSearches"
                aria-label="list of top 10 movies ranked by search hits">
            </div>
            
            <h1>Top 10 Rated Movies</h1>
            <div id="chart_sml_rating" class="chartSmall" 
                aria-label="chart of top 10 movies ranked by user ratings">
                <img alt="top 10 movies ranked by user ratings"/>
            </div>

            <div>
                <h3 id="rating_list_label" class="searchListLable" 
                    onclick = "showRatingList()">
                Accessible Text Only List (click to display)</h3>
            </div>
            
            <div id="list_ratings" class="listRatings"
                aria-label="list of top 10 movies ranked by user ratings">
            </div>

            <div id="sse_message"></div>
    </section>

</body>

</html>
