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
$onoma = $_POST['onoma'];
$epitheto = $_POST['epitheto'];
$email = $_POST['email'];
$fulo = $_POST['fulo'];
$hmeromhnia = $_POST['hmeromhnia'];
if (isset($_POST['terms'])) {
    $terms = date("Y-m-d H:i:s");
} else {
    $terms = "Δεν αποδέχτηκε";
}
$comment = $_POST['comment'];
$sql = "INSERT INTO users(onoma,epitheto,email,fulo,hmeromhnia,terms,comment) VALUES ('$onoma','$epitheto','$email','$fulo','$hmeromhnia','$terms','$comment');";
$result = mysqli_query($conn, $sql);


mysqli_close($conn);
?>