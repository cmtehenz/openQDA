<html>
<head>
<title>openQDA</title>

<link rel="stylesheet" type="text/css" href="css/main.css">

<script>
function checkImage() {
  var img = new Image();
  img.src = "sources/" + document.getElementById('name').value;
  img.style = "visibility: hidden;";
  img.onerror = function() {
    // doesn't exist or error loading
    alert('no image: sources/' + document.getElementById('name').value);
    };
  img.onload = function() {
    alert('image OK');
    }
}
</script>

</head>

<body>

<div id="#tudo">

<object data="css/logo.svg" type="image/svg+xml" height=200 width=900></object>

<div id="menu">
<?php include("menu.html"); ?>
</div>

<div id="centro">
    <h2>Include a new image</h2>

    <form method="post" action="doNewImage.php">
    <table border=0>
        <tr><td><span class='fieldname'>file:</span></td><td><input type="text" id="name" name="name" size="40"><input type="button" onclick="checkImage();" value="check"></td></tr>
        <tr><td><span class='fieldname'>owner:</span></td><td><input type="text" id="owner" name="owner" size="20" value="Leo"></td></tr>
        <tr><td><span class='fieldname'>type:</span></td><td><input type="text" id="type" name="type" size="1" value="i"></td></tr>
        <tr><td><span class='fieldname'>status:</span></td><td><input type="text" id="status" name="status" size="5" value="1"></td></tr>
        <tr><td><span class='fieldname'>description:</span></td><td><textarea rows=4 cols=60 id="memo" name="memo" placeholder="Description of the image (remember that you can use attributes)"></textarea></td></tr>

        <tr><td colspan=2><h2>Atributes</h2></td></tr>
        
        <?php
        
        include("connection.php");
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // lista de caixas para os atributos
        $sql = "SELECT id, name, memo FROM attributes";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><span class='fieldname'>".$row["name"] . ":</span></td><td><input type='hidden' name='atributos[]' value='" . $row["id"] . "'><input type='text' name='valorAtributos[]'></td></tr>\n";
            }
        } 

        mysqli_close($conn);
        ?> 
        <tr><td colspan=2><input type="submit" name="submit" value="Send"></form></td></tr>
    </table>

</div>

</div>

</body>
</html>