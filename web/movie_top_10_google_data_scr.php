
<?php

// RAD Sprint 1
// Name: Alan Pedersen
// ID: P225139
// Date: 31/05/2020
// Project code
// Create the Top 10 chart data for google charts

try {
    // connect to the database
    include "connect.pdo.php";

    // create the sql commands 
    $sqlCommand = "SELECT * FROM vwGetTop10records ";

    // prepare the SQL command to list movies
    $sql = $conn->prepare($sqlCommand);

    // run the SQL command
    $sql->execute();

    // get the results from the query
    $number_list = $sql->fetchAll();

    // create the data table for google charts
    echo "[";
    echo '["number", "Searches", { role: "annotation" }]';
    for ( $i = 0; $i < 10; $i++) {
        $rec = $i + 1;
        echo ',["No: ' . $rec . '", ' . $number_list[$i]['SearchCount'] .
             ', "' . $number_list[$i]['Title'] . '"]'; 

    }
    echo "]";

}
catch(PDOException $e)
{
    echo "Database error: " . $e->getMessage();
}


?>
