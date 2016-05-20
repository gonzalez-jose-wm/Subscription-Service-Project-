<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- tell internet to use the latest rendering engine -->
    <meta http-eqiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial- scle = 1">
    <title>Posting</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Start.ico">
    <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">

    $('.wide').click(function(e) {
    e.preventDefault();
    var img_to_load = $(this).find('img')[0].src,
        imgWindow = window.open(img_to_load);
});

    </script>
</head>
<body>
<div class="topbar">
    <div class="casing">

        <a href="Home.php"><img src="StartCoding.png" style="height:62px;"></a>
        <li class="navactive"><a href="Posting.php" style="color: #ec8b2b;">Posting</a></li>
        <li><a href="Coding.html" style="color: #ec8b2b;">Coding</a></li>
        <li><a href="Home.php" style="color: #ec8b2b;">Home</a></li>
        </ul>

    </div>
</div>

<div class="homecover">
    <div class="casing">
    <h1>Start Posting</h1>
        
        <div class="line"></div>
<div class="caption">
    <p><div class="enjoy-css" style="float:right;"> <a href="Submission.php" class="startbtn">Start</a></div>
    <b><i>Start Posting</i></b> your awesome work and projects with the countless of others that created unique code like yourself! 
    <b><i>Start Coding</i></b> is a great way to start learning HTML and PHP giving you basic understanding of coding. Remember to give a well description of what you post and in a later update users can leave comments!  </p>
    <!-- font family cursive, monospace -->

</div>
        <div class="wide">
        <?php

        define('GW_UPLOADPATH', 'images/');

        // Connect to the database
        $dbh = new PDO('mysql:host=localhost:3306;dbname=startcodingdb', 'root', '');

        // Retrieve the score data from MySQL

        $query = "SELECT * FROM startposting ORDER BY date DESC";


        $stmt = $dbh->prepare($query);

        $stmt->execute();

        $description = $stmt->fetchAll();


        echo '<table>';

        $i = 0;

        // Display the score data
        foreach ($description as $row) {

            if ( $i == 0 ) {

                echo '<tr><td colspan="2" class="topheader" class="description"> Look what '. '<i>' .$row['name']. '</i>'.' posted! </td></tr>';

            }
            // Display the score data
            echo '<tr><td class="description">';


            echo '<strong><u>Name</u>:</strong> ' . $row['name'] . '<br />';

            echo '<strong><u>Description</u>:</strong> '  . $row['description'] . '</span><br />';

            echo '<strong><u>Date</u>:</strong> ' . $row['date'] . '</td>';

            if (is_file(GW_UPLOADPATH. $row['screenshot']) && filesize(GW_UPLOADPATH. $row['screenshot']) > 0) {
                echo '<td class="description"><img src="'.GW_UPLOADPATH. $row['screenshot']. '" alt ="screenshot image" /> </td></tr>';
            }

            else {
                echo '<td class="description"><img src="unverified.gif" alt="Unverified" /></td>';
            }

            $i++;

        }

        echo '</table>';

        ?>
</div>
</div>
</div>

</body>

</body>
</html>
