
<?php
    // Web Programming
    // Name: Alan Pedersen
    // ID: P225139
    // Date: 3/04/2020
    // Project 
    //
    // flag the selected emails as inactive
    //
    // script to user emails
    // return list for selection in form

// use the connection to the database
require "connect.pdo.php";

// wrap the database code in an error trap
try {
    // test if we arrived here via a post command
    // from the unsubscribe button
    if (isset($_POST['unsubscribe'])) {
        // echo "in the post command";
        // build the query to flag the data
        $flagQuery = "UPDATE tbluserdetails SET newsletter=false, newsflash=false, active=false WHERE ";
        $flagQuery .= buildInList("userEmail", $_POST["email"]);

        // show the SQL to run
        // echo $flagQuery;

        // prepare the query
        $sql = $conn->prepare($flagQuery);

        // submit the SQL command
        $sql->execute();

    }    
    
    // build the query to get the list of email addresses
    $getData = "SELECT userEmail FROM tblUserDetails where active = true";

    // if there is a filter string set
    // add this to the query
    if(isset($_POST["emailFilter"])) {
        $getData .= " and userEmail like '%" . $_POST["emailFilter"] . "%'";
    }

    // echo $getData;
    // prepare the query
    $sql = $conn->prepare($getData);

    // submit the SQL command
    $sql->execute();

    // count the number of records found
    $numRecs = $sql->rowCount();
    
    // initialise the variables
    $emailList = "";
    // $emailList .= '<option value="xxxx">filter: ' . $_POST["emailFilter"] . '</option>';

    if($numRecs == 0) {
        $emailList .= '<option value="none">no records found</option>';

    }
    elseif($numRecs < 20) {
        // output the email records
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            // start the email address record
            $emailList .= '<option value="' . $row["userEmail"] . '"';

            // has the form been posted and this value selected
            if (isset($_POST["email"]) 
                && (array_search($row["userEmail"], $_POST["email"]) !== false)) {
                    $emailList .= " selected ";

            }

            // finish the email address record
            $emailList .= ">". $row["userEmail"] . "</option>";

        }
    }
    else {
        $emailList .= '<option value="tooMany">too many records</option>';

    }
    
    // add the list to the form
    echo $emailList;

}
catch(PDOException $e)
{
    echo "Database error: " . $e->getMessage();
}

// close the connection
$conn = null;


// clean up input data
function cleanInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'", "''", $data);
    return $data;
}

// make the list of value for the IN filter
function buildInList($field, $inList)
{
    // count of number of values
    $count = 0;
    // initialise the any flag
    $anyFound = false;
    // initialise the list of values
    $searchList = $field . " IN ( ";

    // loop through values list
    foreach ($inList as $li) {
        // clean the value
        $value = cleanInput($li);

        // add each value
        // test for the second and subsequent values
        if ($count > 0) {
            // subsequent values add a comma to seperate the list items
            $searchList .= ",";

        }

        // add the value
        $searchList .= "'" . $value . "'";

        // increment the counter
        $count++;
        
    }

    // finish the search string
    $searchList .= ")";

    // return the finshed string
    return $searchList;

}

?>
