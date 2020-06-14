
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
        $r1sc = $number_list[0]['1starCount'];
        $r2sc = $number_list[0]['2starCount'];
        $r3sc = $number_list[0]['3starCount'];
        $r4sc = $number_list[0]['4starCount'];
        $r5sc = $number_list[0]['5starCount'];
        $rating = round( $number_list[0]['movieRating'], 1);

        // create the data table for google charts
        echo "[";
        echo '["label", "Rating", { role: "annotation" }],';
        echo '["1 star",' . $r1sc . ',"' . $r1sc . ' votes"],';
        echo '["2 star",' . $r2sc . ',"' . $r2sc . ' votes"],';
        echo '["3 star",' . $r3sc . ',"' . $r3sc . ' votes"],';
        echo '["4 star",' . $r4sc . ',"' . $r4sc . ' votes"],';
        echo '["5 star",' . $r5sc . ',"' . $r5sc . ' votes"]';
        echo "]";

    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }
}

?>
