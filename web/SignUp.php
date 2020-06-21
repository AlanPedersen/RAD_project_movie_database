<!DOCTYPE html>
<html lang="en">
<!--
    RAD
    Group members names: Alan Pedersen, David Perry, Zara Duncanson, 
    Respective Student ID's: P225139, 30010019, P229768
    Date: 07/06/2020
	User Sign up page
-->

<head>
    <meta charset="UTF-8">
    <title>Member Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- import the base style sheet -->
    <link rel="stylesheet" href="base.css">
    <!-- import the nav bar style sheet -->
    <link rel="stylesheet" href="menu_nav.css">
	
	<style type="text/css">    
        .navMenuSignUp {
            background-color: darkgrey;
        }

		/* Style inputs, select elements and textareas */
		input[type=text],input[type=email], select, textarea{
		  width: 50%;
		  padding: 6px;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		  resize: vertical;
		}

		/* Style the label to display next to the inputs */
		label {
		  padding: 10px 10px 10px 0px;
		  display: inline-block;
		}

		/* Style the submit buttons */
		input[class=subscribe] {
		  background-color: darkblue;
		  color: white;
		  padding: 12px 20px;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		  float: left;
		  margin-top: 12px;
		}

		input[class=unsubscribe] {
		  background-color: darkred;
		  color: white;
		  padding: 12px 20px;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		  float: left;
		  margin-top: 12px;
		}

		/* Style the container */
		.userSignUp {
		  border-radius: 5px;
		  background-color: #lightblue;
		  padding: 20px;
		}

		/* Floating column for labels: 25% width */
		.col-25 {
		  float: left;
		  width: 25%;
		  margin-top: 0px;
		}

		/* Floating column for inputs: 75% width */
		.col-75 {
		  float: left;
		  width: 75%;
		  margin-top: 6px;
		}

		/* Responsive layout - when the screen is less than 600px wide, make the two columns stack */
		@media screen and (max-width: 600px) {
		  .col-25, .col-75, input[type=submit] {
			width: 100%;
			margin-top: 0;
		  }
		}

		/* error style */
		.error {
		  color: red;
		}

		</style>
	</head>

	<body>
		<header>
			<H1>Acme Entertainment</H1>
		</header>

		<nav>
    	    <?php require 'menu_nav_scr.php'; ?>
	    </nav>

	<section class="userSignUp">
		<form action="add_new_user_scr.php" method="post">
			<h1> Member Sign Up</h1>
			<div class="row">
				<div class="col-75">
					<h2> Subscribe to our newsletter to recieve updates or
					subscribe to our newsflash to get breaking notifications!</h2>
					<p><span class="error"> * = Required Field</span></p><!--required fields-->
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="userFirstName">First Name:</label>
				</div>
				<div class="col-75">
					<input type="text" name="userFirstName" required, autofocus>
					<span class="error">*</span>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="userFamilyName">Last Name:</label>
				</div>
				<div class="col-75">
					<input type="text" name="userFamilyName">
					<span class="error">*</span>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="userEmail">Email:</label>
				</div>
				<div class="col-75">
					<input type="email" name="userEmail">
					<span class="error">*</span>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label>
						<input type="checkbox" checked="checked" name="newsletter" value="1">Monthly Newsletter
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label>
						<input type="checkbox" checked="checked" name="newsflash" value="1">Newsflash Notifications
					</label>
					<span class="error"><br>* Please select at least one</span>
				</div>
			</div>
			<!-- Button for submit form -->
			<div class="row">
				<div class="col-25">
					<input class="subscribe" type="submit" name="subscribe" value="Subscribe">
				</div>
			</div>
		</form>
	</section>
	<section class="userSignUp">
		<form action="user_unsubscribe_request_scr.php" method="post">
			<h1> Unsubscribe</h1>
			<div class="row">
				<div class="col-75">
					<h2> To unsubscibe please enter your email address:</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label for="userEmailUnsub">Email:</label>
				</div>
				<div class="col-75">
					<input type="email" name="userEmailUnsub">
					<span class="error">*</span>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label>
						<input type="checkbox" name="newsletterUnsub" value="1">Monthly Newsletter
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-25">
					<label>
						<input type="checkbox" name="newsflashUnsub" value="1">Newsflash Notifications
					</label>
					<span class="message"><br>Please select what you would like to unsubscribe from.</span>
				</div>
			</div>
			<!-- Button for submit form -->
			<div class="row">
				<div class="col-25">
					<input class="unsubscribe" type="submit" name="unsubscribe" value="Unsubscribe">
				</div>
			</div>
		</form>
	</section>
</main>

</body>
</html>
