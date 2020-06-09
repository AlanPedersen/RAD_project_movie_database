<?php
/**
 * PHP script to send email to administrator to request unsubsciption from
 * newsletter and/or newsflash
 *
 * PHP version 5
 * 
 * Zara Duncanson P229768
 */

require "connect.pdo.php";

$email = $emailErr = "";
$newletterUnsub = $newsflashUnsub = $checkboxErr = "";
 
if (isset($_POST['unsubscribe'])) {
    if (empty($_POST["userEmailUnsub"])) {
        $emailErr = "'Email' is a required field to unsubscribe!";
    } else {
        $email = Test_input($_POST["userEmailUnsub"]);
        //check if email is well formatted
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
	//determine what the user wants to unsubscribe from
	if ((empty($_POST['newsletterUnsub'])) && (empty($_POST['newsflashUnsub']))) {
		$checkboxErr = "Error: to unsubscribe please select either 'Newsletter' or 'Newsflash'";
	} else if ((isset($_POST['newsletterUnsub'])) && (isset($_POST['newsflashUnsub']))) {
		$newletter = $newsflash = $active = "yes";
		//return;
	}
	if (empty($_POST['newsletterUnsub'])){
		$newsletter = "no";
		$active = "no";
	} else {
		$newsletter = "yes";
		$active = "yes";
	}
	if (empty($_POST['newsflashUnsub'])){
		$newsflash = "no";
		$active = "no";
	} else {
		$newsflash = "yes";
		$active = "yes";
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
//if no errors
if ($emailErr == "" && $checkboxErr == "") {
	
	//prepare an email to the administrator
    try {
		//Email information
		$adminEmail = "no-reply@acme.com";
		//$testEmail = "P229768@tafe.wa.edu.au";
		$subject = "Unsubscribe user";
		$comment = "<p>User email '$email' has requested to be unsubscribed from:<br>";
		//tells admin what user wants to unsubscribe
		$comment .= "Newsletter: '$newsletter'<br>Newsflash: '$newsflash'</p>";
		$header = "From: noreply@moviedatabase.com";
		
		//check if email address is present in database
		$stmt = $conn->prepare(
            "SELECT userEmail FROM tblUserDetails WHERE userEmail = '$email'"
        );
		$stmt->bindParam(':userEmail', $email);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//if no result, error
		if (! $row){
			echo "Error: the email you have entered has not subscribed";
			echo "<br><br>";
			echo "<a href='SignUp.php'>Back to Sign Up</a>";
		//else send email
		} else {
			
			//echo $newsletter; //for testing
			//echo $newsflash;
			  
			$unsubEmail = mail($adminEmail, $subject, $comment, $header);  
			if ($unsubEmail == true) {
				//print statements if sent/not sent
				echo "Success! An email has been sent to the administrator for unsubscription"; //successful message
				echo "<br><br>";
				echo "<a href='SignUp.php'>Back to Sign Up</a>";
			} else {
				echo "Message could not be sent...";
				echo "<br><br>";
				echo "<a href='SignUp.php'>Back to Sign Up</a>";
			}
		}
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
} else {
    echo "<h2>Error!</h2>";
    echo $emailErr;
	echo "<br>";
    echo $checkboxErr;
    echo "<br><br><br>";
    echo "<a href=index.html>Go Back</a>";
}
?>