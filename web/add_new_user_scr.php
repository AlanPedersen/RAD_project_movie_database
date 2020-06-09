<?php
/**
 * PHP script to add new user to database
 * 
 * PHP version 5
 * 
 * Zara Duncanson P229768
 */

require "connect.pdo.php";

$fname = $lname = $email = $newletter = $newsflash = "";
$fNameErr = $lNameErr = $emailErr = $checkboxErr = "";
 
if (isset($_POST['subscribe'])) {
    if (empty($_POST["userFirstName"])) {
        $fNameErr = "'First name' is a required field!";
    } else {
        $fname = Test_input($_POST["userFirstName"]);
        //check if fisrt name contains only letters
        if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            $fNameErr = "First name can only be letters";
        }
    }

    if (empty($_POST["userFamilyName"])) {
        $lNameErr = "'Last name' is a required field!";
    } else {
        $lname = Test_input($_POST["userFamilyName"]);
        //check if last name contains only letters
        if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
            $lNameErr = "Last name can only be letters";
        }
    }

    if (empty($_POST["userEmail"])) {
        $emailErr = "'Email' is a required field!";
    } else {
        $email = Test_input($_POST["userEmail"]);
        //check if email is well formatted
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
	
	if ((empty($_POST['newsletter'])) && (empty($_POST['newsflash']))) {
		$checkboxErr = "Error: to subscribe please select either 'Newsletter' or 'Newsflash'";
	} else {
		$active = 1;
		if (!empty($_POST['newsletter'])){
			$newsletter = 1;
		} else {
			$newsletter = 0;
		}
		if (!empty($_POST['newsflash'])){
			$newsflash = 1;
		} else {
			$newsflash = 0;
		}
 		//store values
 		/* checkedArray = array('newsletter','newsflash');
		if (isset($_POST['checkbox'])) {
			$values = array();
			foreach ($_POST['checkbox'] as $selection) {
			if (in_array($selection, $checkedArray)) {
				$values[$selection] = true;
				//echo $values[$selection];
				} else {
				$values[$selection] = false;
				//echo $values[$selection];
				}
			}
		}*/
	}
}
/**
 * A method to simplify data to readable characters
 *  $data is input data
 * 
 * @return
 */
function Test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($fNameErr == "" && $lNameErr == "" && $emailErr == "" && $checkboxErr == "") {

    try{

    $stmt = $conn->prepare(
            "INSERT INTO `tbluserdetails`
			(`userFirstName`, `userFamilyName`, `userEmail`, `newsletter`, `newsflash`, `active`) 
			VALUES 
			(:userFirstName, :userFamilyName, :userEmail, :newsletter, :newsflash, :active)"
        );
        $stmt->bindParam(':userFirstName', $fname);
        $stmt->bindParam(':userFamilyName', $lname);
        $stmt->bindParam(':userEmail', $email);
		$stmt->bindParam(':newsletter', $newsletter); 
		$stmt->bindParam(':newsflash', $newsflash);
		$stmt->bindParam(':active', $active);
        $stmt->execute();
		
        echo "Success! You have subscribed"; //successful message
        echo "<br><br>";
		echo "<a href='SignUp.php'>Back to Sign Up</a>";
		
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
} else {
    echo "<h2>Error!</h2>";
    echo $fNameErr;
    echo "<br>";
    echo $lNameErr;
    echo "<br>";
    echo $emailErr;
	echo "<br>";
    echo $checkboxErr;
    echo "<br><br><br>";
    echo "<a href=index.html>Go Back</a>";
}
?>