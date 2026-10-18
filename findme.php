<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "f1";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
if(isset($_POST['email'])) {
$email = $_POST['email'];

$sql="SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);


echo "<table style='border:1px solid black'>";
echo "<tr>
        <th style='border:1px solid black;'>Όνομα</th>
        <th style='border:1px solid black;'>Επώνυμο</th>
        <th style='border:1px solid black;'>Email</th>
        <th style='border:1px solid black;'>Φύλο</th>
        <th style='border:1px solid black;'>ημερομηνία</th>
        <th style='border:1px solid black;'>Όροι και προϋποθέσεις</th>
        <th style='border:1px solid black;'>Σχόλια</th>
      </tr>";
while($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>".$row['onoma']."</td>".
"<td>".$row['epitheto']."</td>".
"<td>".$row['email']."</td>".
"<td>".$row['fulo']."</td>".
"<td>".$row['hmeromhnia']."</td>".
"<td>".$row['terms']."</td>".
"<td>".$row['comment']."</td>".
"</tr>";



}

echo "</table>" ;
}




mysqli_close($conn);
?>