<?php
    session_start();
?>

<?php

    $username = $_POST["imeNaloga"];
    $password = $_POST["sifra"];

    // pripremamo podatke za slanje
    $data = array(
        'username' => $username,
        'password' => $password
    );
    // pretvaranje podataka u json datoteku
    $payload = json_encode($data);

    // pripremamo sve za slanje i podesavamo parametre
    $url = "http://localhost/kulinarko/jwt-rest-api/login.php";
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

    // echo "RESPONSE: <br>";
    // echo $response."<br>";
    // echo "DECODED RESULT: <br>";
    // print_r($result);
    // echo "<br>";
    $_SESSION["jwt"] = $result->jwt;
    // echo "OVO JE SAMO JWT: ".$_SESSION["jwt"];

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

            <?php
                if ( !isset($_SESSION["jwt"]) ) {
            ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="registration.html"> <i class="fas fa-user-plus"></i> Registracija </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html"> <i class="fas fa-check"></i> Prijava </a>
                </li>
            </ul>
            <?php
                } else {
            ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="controlPanel.php"> <i class="fas fa-user"></i> Nalog </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"> <i class="fas fa-power-off"></i> Odjava </a>
                </li>
            </ul>
            <?php
                }
            ?>

            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form> -->
        </div>
    </nav>
    
    <!-- SADRZAJ STRANICE -->
    <div class="container mt-5 pt-5">
        
    <?php
        if ( !$_SESSION["jwt"] ) {
    ?>
            <div class='alert alert-danger'> Pogrešna lozinka ili korisničko ime. Pokušajte ponovo. </div>
    <?php
        } else {
    ?>
            <div class='alert alert-success'> Uspešno prijavljivanje. </div>
            <div class="card border-secondary mb-3">
                <div class="card-header"> Dobro došli! </div>
                <div class="card-body">
                    <h4 class="card-title"> Sada ste prijavljeni. </h4>
                    <p class="card-text"> Samo prijavljeni korisnici mogu da dodaju recepte ! </p>
                </div>
            </div>
    <?php
        }
    ?>
      
                
    </div> <!-- /container -->
    
</body>
</html>