
<?php

// RAD Sprint 3
// Name: Alan Pedersen
// ID: P225139
// Date: 31/05/2020
// Project code
// get the details for one movie

// test for a posted movie title
if(isset($_GET['selectedTitle']))
{
    try {
        // connect to the database
        include "connect.pdo.php";

        // get the movie title from the get posing
        $movieTitle = $_GET['selectedTitle'];

        // create the sql commands 
        $sqlCommand = 'SELECT * FROM vwMovieList WHERE Title = "'
            . $movieTitle . '"';

        // prepare the SQL command to list movies
        $sql = $conn->prepare($sqlCommand);

        // run the SQL command
        $sql->execute();

        // get the results from the query
        $number_list = $sql->fetchAll();

        // get the number of votes
        $studio = $number_list[0]['StudioName'];
        $price = $number_list[0]['RecRetPrice'];
        $rating = $number_list[0]['RatingCode'];
        $year = $number_list[0]['Year'];
        $genre = $number_list[0]['GenreCode'];

        // create the data table for display
        echo "<table>";
        echo "<tr><td><B>Title: </B></td><td>" . $movieTitle . "</td></tr>";
        echo "<tr><td><B>Studio: </B></td><td>" . $studio . "</td></tr>";
        echo "<tr><td><B>RRP: </B></td><td>" . $price . "</td></tr>";
        echo "<tr><td><B>Rating: </B></td><td>" . $rating . "</td></tr>";
        echo "<tr><td><B>Year: </B></td><td>" . $year . "</td></tr>";
        echo "<tr><td><B>Genre: </B></td><td>" . $genre . "</td></tr>";
        echo "</table>";

    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }
}

?>
