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

        .searchBlock, 
        .searchButton {
            padding: 5px;
            margin: 5px;
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
			<li><a href="./admin/UnsubscribeUsers.php">admin</a></li>>
        </ul>
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
                    title="enter part of a title to search for">
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
        <H1>Movie List</H1>
        <?php require 'movie_list_scr.php'; ?>
    </section>

</body>

</html>

