
<?php

// RAD Sprint 3
// Name: Alan Pedersen
// ID: P225139
// Date: 31/05/2020
// Project code
// Create the rating chart data for the selected movie
// used to populate the google chart

// test for a posted movie title
if(isset($_GET['selectedTitle']))
{
    try {
        // connect to the database
        include "connect.pdo.php";

        // get the movie title from the get posing
        $movieTitle = $_GET['selectedTitle'];

        // create the sql commands 
        $sqlCommand = 'SELECT * FROM vwTitleRating WHERE Title = "'
            . $movieTitle . '"';

        // prepare the SQL command to list movies
        $sql = $conn->prepare($sqlCommand);

        // run the SQL command
        $sql->execute();

        // get the results from the query
        $number_list = $sql->fetchAll();

        // get the number of votes
        $r1sc = number_format($number_list[0]['1starCount']);
        $r2sc = number_format($number_list[0]['2starCount']);
        $r3sc = number_format($number_list[0]['3starCount']);
        $r4sc = number_format($number_list[0]['4starCount']);
        $r5sc = number_format($number_list[0]['5starCount']);
        $rating = round( $number_list[0]['movieRating'], 1);

        echo "<ul>";
        echo "<li>average user rating " . $rating . "</li>";
        echo "<li>" . $r1sc . " users assigned a 1 star rating</li>";
        echo "<li>" . $r2sc . " users assigned a 2 star rating</li>";
        echo "<li>" . $r3sc . " users assigned a 3 star rating</li>";
        echo "<li>" . $r4sc . " users assigned a 4 star rating</li>";
        echo "<li>" . $r5sc . " users assigned a 5 star rating</li>";
        echo "</ul>";

    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }
}

?>
