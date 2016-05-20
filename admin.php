<?php
require_once('authorize.php');
?>
<!DOCTYPE>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=startcodingdb', 'root', '');
// Retrieve the score data from MySQL
$query = "SELECT * FROM startposting ";
$stmt= $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
// Loop through the array of score data, formatting it as HTML
echo '<table>';
foreach ($result as $row) {
    // Display the score data
    echo '<tr><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['screenshot'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td><a href="removeMovie.php?id=' . $row['id'] .
        '&amp;name=' . $row['name'] . '&amp;description=' . $row['description'] .
        '&amp;screenshot=' . $row['screenshot'] . '">Remove</a></td>';
    if( $row['approve'] == '0'){
        echo '<td> / <a href="Posting.php?id='. $row['id'] .
            '&amp;name='. $row['name']. '&amp;description='. $row['description'] . '&amp;screenshot=' .
            $row['screenshot'] . '">Approve</a></td></tr>';
    }
}
echo '</table>';
?>
​
</body>
</html>