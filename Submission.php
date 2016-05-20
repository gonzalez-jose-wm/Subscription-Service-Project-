<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- tell internet to use the latest rendering engine -->
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial- scle = 1">
    <title>Submission</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Start.ico">
    <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
    
    
</head>
<body>
    <div class="topbar" style="position: relative;">
    <div class="casing">

        <a href="Home.php"><img src="StartCoding.png" style="height:62px;"></a>
        <li><a href="Posting.php" style="color: #ec8b2b;">Posting</a></li>
        <li><a href="Coding.html" style="color: #ec8b2b;">Coding</a></li>
        <li><a href="Home.php" style="color: #ec8b2b;">Home</a></li>
        </ul>

    </div>
</div>
<div class="casing">

<?php

define('GW_UPLOADPATH', 'images/');
define('GW_MAXFILESIZE', '66000000');

if (isset($_POST['submit'])) {

    // Grab the score data from the POST

    $name = $_POST['name'];
    $description = $_POST['description'];
    $screenshot = $_FILES['screenshot']['name'];

    $screenshot_type = $_FILES['screenshot']['type'];
    $screenshot_size = $_FILES['screenshot']['size'];

    if (!empty($name) && !empty($description && !empty($screenshot))) {

        if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') ||
                ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png')) &&
            ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)
        ) {

            if (1 == 1) {

                $target = GW_UPLOADPATH . $screenshot;

                // Connect to the database

                if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {

                    $name = $_POST['name'];

                    $description = $_POST['description'];

                    if (!empty($name) && !empty($description)) {


                        $dbc = new PDO('mysql:host=localhost:3306;dbname=startcodingdb', 'root', '');

                        // Write the data to the database

                        $query = "INSERT INTO startposting VALUES (0, NOW(), :name, :description, :screenshot)";

                        $stmt = $dbc->prepare($query);

                        $stmt->execute(

                            array(
                                'name' => $name,
                                'description' => $description,
                                'screenshot' => $screenshot,
                            ));

                        // Confirm success with the user
                        echo '<p>Thanks for adding your new high score!</p>';
                        echo '<p><strong>Name:</strong> ' . $name . '<br />';
                        echo '<strong>Score:</strong> ' . $description . '</p>';
                        echo '<p><a href="Posting.php">&lt;&lt; Back to high scores</a></p>';
                        // Clear the score data to clear the form
                        $name = "";
                        $description = "";
                    }
                    else {
                        echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';

                    }
                }
                else{
                    echo '<p class="error">A file with that name already exists.</p>';
                }
                @unlink($_FILES['screenshot']['tmp_name']);
            }
        }
        else {
            echo '<p class="error">The screen shot must be a GIF, JPEG or PNG image file no ' .
                'greater than ' . (GW_MAXFILESIZE / 1024) . ' KB IN SIZE. </p>';
        }
    }
    else {
        echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
}


?>

<div class="formfix">


<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="66000000" />
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
    <br />
    <label for="description">description:</label>
    <input type="text" id="description" name="description" value="<?php if (!empty($description)) echo $description; ?>" />
    <br />
    <label for="screenshot">Screen shot:</label>
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input type="submit" value="Add" name="submit" />
</form>
<p> <a href="Posting.php"> Go back </a></p>
</div>
</div>
</html>
