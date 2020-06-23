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
    <title>Search Movie Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- import the nav bar style sheet -->
    <link rel="stylesheet" href="menu_nav.css">
    <!-- import the ratings form style sheet -->
    <link rel="stylesheet" href="ratings_formatting.css">
    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <!-- import the base style sheet -->
    <link rel="stylesheet" href="base.css">

    <style type="text/css">    
        .navMenuSearch {
            background-color: darkgrey;
        }

        .searchBlock, 
        .searchButton {
            padding: 5px;
            margin: 5px;
        }

        td, th {
            padding-right: 10px;
            padding-left: 10px;
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
        }

        tr:nth-child(2n) {
            background: white;
        }

        .form-popup {
            display: none;
        }

        @media (min-width: 600px) and (max-width: 799px) {
            .searchBlocks {
                display: grid;
                grid-template-columns: 275px 155px;
            }
        }

        @media (min-width: 800px) {
            .searchBlocks {
                display: grid;
                grid-template-columns: 275px 155px 155px 155px;
            }
        }

    </style>

    <script>
        function openForm(movieRow) {
            movieTitle = document.getElementById("movieTable").rows[movieRow].cells[0].innerText;
            document.getElementById("rateTitle").value = movieTitle;

            // this version to open the pop up form
            // document.getElementById("ratingForm").style.display = "block";
            // this version to open the movie details page
            window.open("MovieDetails.php?selectedTitle=" + movieTitle);

        }

        function closeForm() {
            document.getElementById("ratingForm").style.display = "none";
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

    <section>
        <form  name="searchForm"  autocomplete="off"  
               action="SearchMovies.php" method="post">
        <section class="searchBlocks">
            <div class="searchBlock">
                <h1>Movie Search</h1>
                <div>
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" size="25"
                    value="<?php if (isset($_POST["title"])) echo $_POST["title"];?>" 
                    title="enter part of a title to search for"
                    autofocus>
                </div>
                <div>
                <label for="yearFrom">Year From: </label>
                <input type="number" name="yearFrom" id="yearFrom" 
                        maxlength="4" size="4"
                        <?php require 'movie_year_limits_scr.php'; ?>
                        title="first year in search range"
                        value="<?php if (isset($_POST["yearFrom"])) 
                                echo $_POST["yearFrom"];?>">
                </div>
                <div>
                <label for="yearTo">Year To: </label>
                <input type="number" name="yearTo"  id="yearTo"  
                        maxlength="4" size="4"
                        <?php require 'movie_year_limits_scr.php'; ?>
                        title="last year in search range"
                        value="<?php if (isset($_POST["yearTo"])) 
                                echo $_POST["yearTo"];?>">
                </div>
            </div>

            <div class="searchBlock">
                <label for="genre">Genre:</label><br>
                <select name="genre[]" id="genre" 
                        size="10" style="width: 150px;"
                        title="select one or more genre values" multiple>
                    <?php require 'movie_list_genre_scr.php'; ?>
                </select>
           </div>

           <div class="searchBlock">
               <label for="rating">Rating:</label><br>
                <select name="rating[]" id="rating" 
                        size="10" style="width: 150px;"
                        title="select one or more ratings" multiple>
                    <?php require 'movie_list_rating_scr.php'; ?>
                </select>
           </div>

           <div class="searchBlock">
                <label for="sortBy">Sort By:</label><br>
                <select list="listSortBy" name="sortBy" 
                        id="sortBy" size="10" style="width: 150px;"
                        title="select value to results sort by">
                    <option value="Title" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "Title") 
                            echo "selected";?> 
                        <?php if (!isset($_POST["sortBy"])) 
                            echo "selected";?>> 
                        Title </option>
                    <option value="StudioName" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "StudioName") 
                            echo "selected";?>> 
                        Studio </option>
                    <option value="RecRetPrice" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "RecRetPrice") 
                            echo "selected";?>> 
                        Price </option>
                    <option value="RatingCode" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "RatingCode") 
                            echo "selected";?>> 
                        Rating </option>
                    <option value="Year" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "Year") 
                            echo "selected";?>> 
                        Year </option>
                    <option value="GenreCode" 
                        <?php if (isset($_POST["sortBy"]) 
                            && $_POST["sortBy"] == "GenreCode") 
                            echo "selected";?>> 
                        Genre </option>
                </select>
           </div>

        </section>
            <div class="searchButton">
                <input type="submit" value="search movies" name="search">
            </div>

        </form>

    </section>

    <section>
        <div class="form-popup" id="ratingForm">
            <form class="form-container" name="ratingForm"  
                action="SearchMovies.php" method="post">
                <div>
                    <input type="text" id="rateTitle" name="rateTitle"
                        title="movie to rate">
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
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </div>
            </form>
        </div>
    </section>

    <section>
        <H1>Movie List</H1>
        <?php require 'movie_list_scr.php'; ?>
    </section>
</body>

</html>

