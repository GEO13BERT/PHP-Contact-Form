<!DOCTYPE html>

<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΓΓΡΑΦΗ ΠΑΝΕΠΙΣΤΗΜΙΟ ΠΕΙΡΑΙΩΣ</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="header-container">
    
    <h1>ΦΟΡΜΑ ΕΓΓΡΑΦΗΣ ΠΑΝΕΠΙΣΤΗΜΙΟΥ ΠΕΙΡΑΙΩΣ &#9731;</h1>
    <img src="papei-xmas.png" class="header-logo" alt="logo">
    
</div>


    <form id="f1" method="post" action="mydata.php">
        

            
         
        </div>
        <div class="form-row">
            <label for="onoma"> Όνομα:</label>
            <input type="text" name="onoma" id="onoma" required placeholder="π.χ. Γεώργιος">
        </div>
        <div class="form-row">
            <label for="epitheto"> Επώνυμο:</label>
            <input type="text" name="epitheto" id="epitheto" required placeholder="π.χ. Μπερτάκης">
        </div>







        <div class="form-row">
            <label for="fulo"> Φύλο:</label>
            <input type="radio" name="fulo" value="antras" required>Άντρας
            <input type="radio" name="fulo" value="gunaika" required>Γυναίκα
            <input type="radio" name="fulo" value="allo" required>Άλλο
        </div>
        <div class="form-row">
            <label for="email"> E-mail:</label>
            <input type="text" name="email" id="email" placeholder="π.χ. p25120@unipi.gr">
        </div>
        <div class="form-row">
            <label for="hmeromhnia"> Ημερομηνία Γέννησης:</label>
            <input type="date" name="hmeromhnia" id="hmeromhnia" required>
        </div>
        <div class="form-row">
            <label for="terms"> Έχω διαβάσει τους όρους και τις προϋποθέσεις</label>
            <input type="checkbox" id="terms" name="terms">
        </div>
        <div class="form-row">
            <label for="comment">Αφήστε τα σχόλια σας εδώ:</label><br>
            <textarea id="comment" name="comment" rows="5" cols="90" placeholder="Γράψτε εδώ:"></textarea>
        </div>
        <div class="form-row">
            <input type="submit" id="submit" value="Αποθήκευση">
            <input type="reset" value="Καθαρισμός">
        </div>
    </form>




    <hr>
    <br><br><br>
    <form method="post" action="p25120_erg6.php" id="findme">
        <label for="user">Αναζήτηση σύμφωνα με το E-Mail: </label>
        <input type="text" id="s_email" name="email">
        <input type="submit" name="mybtn" id="mybtn" value="Αναζήτηση">
        <br><br>
    </form>
</body>

<script>
    const sbmtbutton = document.getElementById("submit");


    sbmtbutton.addEventListener("click", function (event) {
        const firstname = document.getElementById("onoma");
        const onoma = firstname.value;
        let lathos = 0;
        let flag = false;
        let mhnuma = "";



        function checkfirstname() {
            if (/^[α-ωΑ-ΩΩΆΉΊΎΈΌάόίήύέώϊϋΐΰ]+$/.test(onoma)) {
                firstname.style.border = "";
            }

            else {

                lathos += 1;

                mhnuma = "Το όνομα σας πρέπει να περιέχει ελληνικούς χαρακτήρες.";

                firstname.style.border = "2px solid red";
                flag = true;

            }
        }


        const lastname = document.getElementById("epitheto");
        const epitheto = lastname.value;
        function checklastname() {
            if (epitheto.length <= 50) {
                lastname.style.border = "";
            } else {

                lathos += 1;
                mhnuma = "Το επίθετο σας πρέπει να περιλαμβάνει εώς 50 χαρακτήρες.";
                lastname.style.border = "2px solid red";
                flag = true;

            }

        }
        function checkemail() {
            const email = document.getElementById("email");
            const mail = email.value;
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(mail)) {
                email.style.border = "";
            } else {
                lathos += 1;
                mhnuma = "Ο τύπος E-mail δεν είναι έγκυρος."
                email.style.border = "2px solid red";
                flag = true;
            }



        }
        function checkdate() {
            const date = document.getElementById("hmeromhnia");
            const hmeromhnia = date.value;
            const genethlia = new Date(hmeromhnia);
            const shmerinhHmeromhnia = new Date();
            const orio = new Date(shmerinhHmeromhnia.getFullYear() - 18, shmerinhHmeromhnia.getMonth(), shmerinhHmeromhnia.getDate());
            if (genethlia <= orio) {
                date.style.border = "";
            } else {
                flag = true;
                lathos += 1;
                mhnuma = ("Πρέπει να είστε πάνω απο 18 χρονών ώστε να μπορείτε να υποβάλλετε την φόρμα.");
                date.style.border = "2px solid red";
            }

        }


        checkfirstname();
        checklastname();
        checkemail();
        checkdate();
        if (flag === true) {





            event.preventDefault();
            if (lathos > 1) {
                alert("Υπάρχουν  λάθη που πρέπει να διορθώσετε, τα οποία έχουν κόκκινο περίγραμμα");
                lastname.style.border = "2px solid red";
                firstname.style.border = "2px solid red";
                date.style.border = "2px solid red";
                email.style.border = "2px solid red";

            }
            else if (lathos == 1) {
                alert(mhnuma);
            }

            if (lathos == 0) {
                document.getElementById("f1").submit();
            }


        }
    });

























</script>
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
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email='$email'";
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
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['onoma'] . "</td>" .
            "<td>" . $row['epitheto'] . "</td>" .
            "<td>" . $row['email'] . "</td>" .
            "<td>" . $row['fulo'] . "</td>" .
            "<td>" . $row['hmeromhnia'] . "</td>" .
            "<td>" . $row['terms'] . "</td>" .
            "<td>" . $row['comment'] . "</td>" .
            "</tr>";



    }

    echo "</table>";
}




mysqli_close($conn);
?>