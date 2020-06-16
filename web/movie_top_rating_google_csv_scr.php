
<?php
// RAD Sprint 1
// Name: Alan Pedersen
// ID: P225139
// Date: 31/05/2020
// Project code
// Create the Top 10 rating chart data for google charts

try {
    // connect to the database
    include "connect.pdo.php";

    // create the sql commands 
    $sqlCommand = "SELECT * FROM vwGetTop10ratings ";

    // prepare the SQL command to list movies
    $sql = $conn->prepare($sqlCommand);

    // run the SQL command
    $sql->execute();

    // get the results from the query
    $number_list = $sql->fetchAll();

    echo "number~Rating~{role:'annotation'}";
    for ( $i = 0; $i < 10; $i++) {
        $rec = $i + 1;
        echo '~No: ' . $rec . '~' . $number_list[$i]['movieRating'] .
             '~' . $number_list[$i]['Title']; 

    }

}
catch(PDOException $e)
{
    echo "Database error: " . $e->getMessage();
}

?>
