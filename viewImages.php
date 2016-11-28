<html>
<head>
<title>openQDA</title>

<link rel="stylesheet" type="text/css" href="css/main.css">

<style>
img {
    float: left;
    margin: 0 20px 10px 0;
    width: 150px;
    }
.item {
    }
</style>

</head>

<body>

<div id="#tudo">

<object data="css/logo.svg" type="image/svg+xml" height=200 width=900></object>

<div id="menu">
<?php include("menu.html"); ?>
</div>

<div id="centro">

<h2>Registered images</h2>

<?php
include("connection.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//getting the lastest date
$sql = "SELECT date FROM sources ORDER BY date DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$d = $row["date"];
echo "<br>" . $d . "<br>";

//getting the registers inserted at the same date as the latest
$sql = "SELECT id, name, memo, date FROM sources WHERE date='" . $d . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //basic info from the sources table
        echo "<div class='item'>";
        echo "<img src='sources/" . $row["name"]. "'>\n";
        echo "<span class='fieldname'>ID: </span>" . $row["id"]. "<br/><span class='fieldname'>Description: </span>" . $row["memo"]. "<br/>";
        //getting and showing the attributes
        $result2 = mysqli_query($conn, "SELECT * FROM (SELECT sourceAttributes.value, attributes.name, sourceAttributes.source_id FROM sourceAttributes INNER JOIN attributes ON sourceAttributes.attributes_id=attributes.id)fusao WHERE source_id=" . $row["id"]);
        echo "<span class='fieldname'>Atributes:</span>";
        while($row2 = mysqli_fetch_assoc($result2)) {
            echo $row2["name"] . "=" . $row2["value"] . ", ";
        }
        echo "\n<br>\n<br>\n<span class='fieldname'>actions:</span><a href='viewImagewithBites.php?idImage=" . $row["id"] . "'>View</a> | <a href='editAttributes.php?idImage=" . $row["id"] . "'>Edit attributes</a> | <a href='applyCodes.php?idImage=" . $row["id"] . "'>Apply code</a>";
        echo "\n<div style='clear: both;'><!-- --></div></div>\n";
    }
} else {
    echo "0 results";
}


mysqli_close($conn);
?> 

</div>
</div>

</body>
</html>