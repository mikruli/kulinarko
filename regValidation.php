<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Autor prezentacije i alat koji je koristen za izradu prezentacije -->
    <meta name="authors" content="Dragica Radivojevic, Ranko Korlat i Dejan Kumric">
    <meta name="generator" content="Visual Studio Code">

    <!-- Za izradu prezentacije koristi se lokalna kopija Bootstrap-a 4. -->
    <link rel="stylesheet" type="text/css" href="./bootstrap/bootstrap.css">
    <!-- I koristim besplatne Font Awesome fontove za znak brenda. -->
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <!-- Moji stilovi -->
    <link rel="stylesheet" type="text/css" href="./css/nasiStilovi.css">

    <!-- Neophodni skriptovi jQuery, popper.js i bootstrap.js-->
    <script src="./jquery/jquery-3.4.1.js"></script>
    <script src="./popper/popper.js"></script>
    <script src="./js/bootstrap.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Home page </title>
</head>
<body>
    <div class="masthead">
    </div>
    <!-- NAVIGACIONI BAR - Bootswatch - tema Sandstone -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- <a class="navbar-brand" href="#"> Navbar </a> -->
        <a class="navbar-brand" href="index.php"> <i class="fas fa-utensils"></i> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"> Početna <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="glavnaJela.php"> Glavna jela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="predjela.php"> Predjela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="supeIcorbe.php"> Supe i čorbe </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kolaci.php"> Kolači </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="torte.php"> Torte </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="salate.php"> Salate </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="registration.html"> <i class="fas fa-user-plus"></i> Registracija </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html"> <i class="fas fa-check"></i> Prijava </a>
                </li>
            </ul>

            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form> -->
        </div>
    </nav>
    
    <!-- SADRZAJ STRANICE -->
    <div class="container mt-5 pt-5">

    <?php
        // include_once "php/podaciObazi.php";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kulinarko";
        $datatable = "recepti"; // MySQL ime tabele
        $datatable_kor = "korisnici"; // MySQL ime tabele

        $noviUsername = trim($_POST["korisnickoIme"]);
        $noviEmail = trim($_POST["email"]);
        $novoIme = trim($_POST["ime"]);
        $novoPrezime = trim($_POST["prezime"]);
        $noviPassword = trim($_POST["sifra"]);

        // echo "username: ".$noviUsername."<br>";
        // echo "email: ".$noviEmail."<br>";
        // echo "ime: ".$novoIme."<br>";
        // echo "prezime: ".$novoPrezime."<br>";
        // echo "password: ".$noviPassword."<br>";

        // Uspostavi novu konekciju
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Proveri konekciju
        if ( $mysqli->connect_errno ) {
            echo "Error: ".$mysqli->connect_error;
        } else {

            // Postavi UTF8 karakter set kao podrazumevani set za razmenu podataka sa bazom
            $mysqli->set_charset("utf8");

            $query = "SELECT korisnicko_ime FROM ".$datatable_kor;
            $result = $mysqli->query($query);

            $n = $result->num_rows;
            // echo "Broj rezultata = ".$n."<br>"; // sluzi samo za testiranje

            $nalaziSe = FALSE;

            if ( $result == FALSE ) {
                echo "Error: ".$mysqli->error;
            } else {

                while( ($row = $result->fetch_assoc()) && !$nalaziSe ) {
                    
                    // echo "KORISNIK: ".$row["korisnicko_ime"]."<br>";
                    if ( $noviUsername == $row["korisnicko_ime"] ) {
                        $nalaziSe = TRUE;
                    }
                    
                }
                // $_SESSION["postojeci"] = $nalaziSe;
                if ( $nalaziSe ) {
                    echo "<div class='alert alert-danger'>";
                    echo "Registracija nije uspela !!! Korisničko ime već postoji. Izaberite novo korisničko ime i ponovite registraciju !";
                    echo  "</div>";
                } else {

                    // pripremamo podatke za slanje
                    $data = array(
                        'username' => $noviUsername,
                        'firstname' => $novoIme,
                        'lastname' => $novoPrezime,
                        'email' => $noviEmail,
                        'password' => $noviPassword
                    );
                    // pretvaranje podataka u json datoteku
                    $payload = json_encode($data);

                    // pripremamo sve za slanje i podesavamo parametre
                    $url = "http://localhost/kulinarko/jwt-rest-api/api/create_user.php";
                    $client = curl_init($url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($client, CURLINFO_HEADER_OUT, true);
                    curl_setopt($client, CURLOPT_POST, true);
                    curl_setopt($client, CURLOPT_POSTFIELDS, $payload);

                    // Postavljamo HTTP Header za POST request 
                    curl_setopt($client, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($payload))
                    );

                    // Saljemo POST request
                    $response = curl_exec($client);
                    $result = json_decode($response);
                    
                    // I zatvaramo cURL session handle
                    curl_close($client);

                    echo "<div class='alert alert-success'> Uspešna registracija. Molim vas prijavite se ! </div>";
                    // echo $response; // samo u svrhu testiranja
                    // print_r($result); // samo u svrhu testiranja
                }

                
            }
            $mysqli->close();
        }

    ?>   
                
    </div> <!-- /container -->
    
</body>
</html>