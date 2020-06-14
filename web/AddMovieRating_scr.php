
<?php
    // Web Programming
    // Name: Alan Pedersen
    // ID: P225139
    // Date: 3/04/2020
    // Project 
    // script to set a user movie rating

// check if the rating form has been posted
if (isset($_POST['setRating'])) {
    postRating();
    
}

function postRating() 
{
    try {
        // connect to the database
        include "connect.pdo.php";

        // testing flag
        $testingFlag = true;

        // construct the select conditions
        // initialise the strings
        $filter = "";
        $searchTitle = "";
        
        if( $testingFlag) {
            echo "post: " . print_r($_POST);
            echo "title: " . $_POST['rateTitle'];
            echo "rating: " . $_POST['rate'];
        }

            // test that the two required values are set
        if( isset($_POST['rateTitle']) && isset($_POST['rate'])) {
            // clean the movie title string
            $searchTitle = $_POST["rateTitle"];

            // make the search string
            $filter = 'WHERE Title = "' . $searchTitle . '"';

            // echo the filter
            if ($testingFlag) { 
                echo "filter title: " . $filter . "<br>";
            }

            // create the sql commands 
            $sqlCommand = "UPDATE vwTitleRating SET " . 
                $_POST['rate'] . "starCount = " . $_POST['rate'] . 
                "starCount + 1 ". $filter;

            // echo the command
            if ($testingFlag) { 
                echo "sql: " . $sqlCommand . "<br>";
            }

            // prepare the SQL command to list movies
            $sql = $conn->prepare($sqlCommand);

            // run the SQL command
            $sql->execute();
        }

        // close the connection
        $conn = null;

    }
    catch(PDOException $e)
    {
        echo "Database error: " . $e->getMessage();
    }

}

header("Location: MovieDetails.php?selectedTitle=" . $_POST['rateTitle']);

?>
