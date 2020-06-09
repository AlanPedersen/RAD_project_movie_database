<!DOCTYPE html>
<html lang="en">
<!--
    Web Programming
    Name: Alan Pedersen
    ID: P225139
    Date: 3/04/2020
    Project 
    Movie Search Page
-->

<head>
    <meta charset="UTF-8">
    <title>Movie Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import compiled and minified CSS -->
    <link rel="stylesheet" href="bootstrap.min.css">

    <style type="text/css">    
        * {
            margin: 10;
            padding: 10;

        }
        
        nav {
            margin-top: 10px;
        }
    
        nav ul {
            display: flex;
            list-style: none;
            align-items: left;
            justify-content: center;    
        }
    
        nav a {
            color: black;
            font-weight: bold;
            display: block;
            padding: 15px;
            text-decoration: none;
        }

        nav a:hover {
            color: red;
        }
        
        body {
            background-color: lightblue;
        }
        
        h1 {
            color: black;
            text-align: left;
        }
        
        h2 {
            text-align: left;
            font-size: 16px;
        }
        
        p {
            font-family: verdana;
            font-size: 12px;

        }

        ul {
            font-family: verdana;
            font-size: 16px;
            list-style-type: none;
            margin: 10;
            padding: 20;
            background-color: #dddddd;
            width: 400px;

        }

        .searchBlock, 
        .unsubButton {
            padding: 5px;
            margin: 5px;
        }

        @media (min-width: 600px) and (max-width: 799px) {
            .searchBlocks {
                display: grid;
                grid-template-columns: 275px 155px;
            }
        }

        @media (min-width: 800px) {
            .searchBlocks {
                display: grid;
                grid-template-columns: 275px 155px 155px 155px;
            }
        }
    </style>

</head>

<body>
    <header>
        <H1>Acme Entertainment</H1>
    </header>

    <nav>
        <ul>
            <li><a href="../SearchMovies.php">search form</a></li>
            <li><a href="../Top10.php">top 10 movies</a></li>
			<li><a href="../SignUp.php">sign up</a></li>
            <li class="active"><a href="UnsubscribeUsers.php">unsubscribe</a></li>
        </ul>
    </nav>

    <section>
        <form  name="unsubForm"  autocomplete="off"  
               action="UnsubscribeUsers.php" method="post">
        <section class="searchBlocks">
            <div class="searchBlock">
                <h1>Unsubscribe Users</h1>
                <div>
                    <label for="emailFilter">Email Filter:</label>
                    <input type="text" name="emailFilter" id="emailFilter" size="25"
                    value="<?php if (isset($_POST["emailFilter"])) echo $_POST["emailFilter"];?>" 
                    title="enter part of the email to search for" 
                    onkeyup="unsubForm.submit()" autofocus>
                </div>
            </div>

            <div class="searchBlock">
                <label for="email">Email:</label><br>
                <select name="email[]" id="email" 
                        size="10" style="width: 200px;"
                        title="select one or more email records" multiple
                        onchange="unsubForm.submit()">
                    <?php require 'movie_list_usersEmails_scr.php'; ?>
                </select>
           </div>

        </section>

            <div class="unsubButton">
                <input type="submit" value="unsubscribe" name="unsubscribe"
                <?php if (!isset($_POST["email"])) echo "disabled";?>>
            </div>

        </form>

    </section>

</body>

</html>

