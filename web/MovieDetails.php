<!DOCTYPE html>
<html lang="en">
<!--
    RAD
    Name: Alan Pedersen
    ID: P225139
    Date: 14/06/2020
    Project 
    Display details of one movie
-->

<head>
    <meta charset="UTF-8">
    <title>Movie Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- import the base style sheet -->
    <link rel="stylesheet" href="base.css">
    <!-- import the nav bar style sheet -->
    <link rel="stylesheet" href="menu_nav.css">
    <!-- import the ratings form style sheet -->
    <link rel="stylesheet" href="ratings_formatting.css">

    <style type="text/css">    
        .navMenuSearch {
            background-color: darkgrey;
        }

        .movieDetails,
        .ratingChart,
        .form-popup {
            padding: 5px;
            margin: 5px;
        }

        .chartSmall {
            width: 325px; 
            height: 220px;
        }

        .form-popup {
            display: block;
        }

        th {
            text-align: right;
        }

        .listRatings {
            width: 325px;
            position: relative;
            border: 3px solid #f1f1f1;
            padding: 5px;
            background-color: white;
            display: none;
        }

        .ratingListLable {
            cursor: pointer;
        }
        
        .ratingListLable:hover {
            color: red;
            text-decoration: underline;
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

            var dataRating = google.visualization.arrayToDataTable(
                <?php require 'movie_1_rating_google_data_scr.php'; ?>);

            var optionsRating = {
                title: <?php echo '"' . $_GET['selectedTitle'] . ' average rating: ' . $rating . '"' ?>,
                bar: {groupWidth: "90%"},
                legend: { position: "none" },
                vAxis: { textStyle: { fontSize: 12}},
                hAxis: { title: 'viewer rating'}};

          // create the rating charts
          // create and draw the small chart
          var chartSmlRating = new google.visualization.BarChart(document.getElementById("chart_sml_rating"));
          chartSmlRating.draw(dataRating, optionsRating);
        }
    </script>

    <script>
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

    <section class="movieDetails">
            <h1>Movie Details: <?php echo $_GET['selectedTitle'] ?></h1>
            <?php require 'movie_1_details_google_data_scr.php'; ?>
    </section>

    <section class="ratingChart">
            <h1>Viewer Ratings: <?php echo $_GET['selectedTitle'] ?></h1>
            <div id="chart_sml_rating" class="chartSmall" 
                aria-label="chart of user ratings">
                <img alt="chart of user ratings"/>
            </div>
    </section>

    <section>
        <button type="button" 
            id="rating_list_label" class="ratingListLable" 
            onclick = "showRatingList()">
            Accessible Text Only List (click to display)</button>

        <div id="list_ratings" class="listRatings"
            aria-label="list of user ratings">
            <?php require 'movie_1_rating_list_data_scr.php'; ?>
        </div>

    </section>

    <section>
        <h1>Your Rating: <?php echo $_GET['selectedTitle'] ?></h1>
        <div class="form-popup" id="ratingForm">
            <form class="form-container" name="ratingForm"  
                action="AddMovieRating_scr.php" method="post">
                <div>
                    <input type="text" id="rateTitle" name="rateTitle"
                        title="movie to rate"
                        value= <?php echo '"' . $_GET['selectedTitle'] . '"' ?>
                        hidden>
                </div>
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="5 stars">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="4 stars">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="3 stars">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="2 stars">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="1 star">1 star</label>
                </div>
                <div>
                    <button type="submit" name="setRating" class="btn">Rate Movie</button>
                </div>
            </form>
        </div>
    </section>

</body>

</html>
