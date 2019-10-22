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
    <title> Detaljno </title>
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
                    <a class="nav-link" href="#"> Glavna jela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Predjela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Supe i čorbe </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Kolači </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Torte </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Salate </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="registration.html"> Registracija </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.html"> Prijava </a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form> -->
        </div>
    </nav>

    <div class="container mt-2 pt-2">

        <?php
        
        // include "./php/podaciObazi.php";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kulinarko";
        $datatable = "recepti"; // MySQL ime tabele
        $datatable_kor = "korisnici"; // MySQL ime tabele

        $brStrane = $_POST["thisPage"];
        $brRecepta = $_POST["thisReceipt"];

        // echo "BROJ STRANE JE: ".$brStrane."<br>"; // samo za testiranje programa
        // echo "BROJ RECEPTA JE: ".$brRecepta."<br>"; // samo za testiranje programa

        // Uspostavi novu konekciju
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Proveri konekciju
        if ( $mysqli->connect_errno ) {
            echo "Error: ".$mysqli->connect_error;
        } else {

            // Postavi UTF8 karakter set kao podrazumevani set za razmenu podataka sa bazom
            $mysqli->set_charset("utf8");

            // pravimo upit u bazu za recept kome zelimo da saznamo sve detalje
            $query = "SELECT * FROM ".$datatable." WHERE recept_id = ".$brRecepta;
            $result = $mysqli->query($query);

            $n = $result->num_rows;
            // echo "Broj rezultata = ".$n; // sluzi samo za testiranje

            if ( $result == FALSE ) {
                echo "Error: ".$mysqli->error;
            } else {

                $row = $result->fetch_assoc();

                // pretvara timestap iz baze mySql baze u format datuma u php-u
                $timestamp = strtotime($row["datum_unosa"]);
                $date = date('d-m-Y', $timestamp);
                
                // upit za trazenje imena autora recepta na osnovu korisnickog imena
                $query_imeAutora = "SELECT * FROM ".$datatable_kor." WHERE korisnicko_ime = '".$row["autor_recepta"]."'";
                $result_imeAutora = $mysqli->query($query_imeAutora);
                $broj_redova = $result_imeAutora->num_rows; // rezultat moze da bude samo jedan
                // echo "\n BROJ REDOVA JE: ".$broj_redova; // sluzi samo za testiranje

                if ( $result_imeAutora == FALSE ) {
                    $imeAutora = $row["autor_recepta"]; // ako se desila greska stavi korisnicko ime
                } else {
                    $row_users = $result_imeAutora->fetch_assoc();
                    $imeAutora = $row_users["ime"];
                }

                echo "<div class='row mt-2'>";
                echo "<h2 class='col-12 border-bottom'> <strong>".$row["naziv_recepta"]."</strong> </h2>";
                echo "</div>";
                echo "<div class='row'>";
                echo "<p class='col-12 text-capitalize'> <h6> <i class='fas fa-user ml-3 mr-1'></i>".$imeAutora." <i class='far fa-clock ml-2 mr-1'></i>".$date."</h6> </p>";
                echo "</div>";
                echo "<div class='row'>";
                echo "<img src='".$row["slika_jela"]."' alt='Ime slike' class='col-8 rounded float-left mx-auto'>";
                echo "</div>";
                echo "<div class='row'>";
                echo "<p clas='col-12'>";
                echo "<div class='d-flex flex-column mt-4 mb-3 col-12'>";
                echo "<div class='p-2 text-justify'>";
                echo "<h4> Sastojci: </h4>";
                echo "<ul class='list-group col-12 col-md-5'>";

                // ispis sastojaka svakog u novom redu
                $sastojci = explode(",", $row["sastojci"]);
                // var_dump($sastojci); // samo za testiranje
                foreach ($sastojci as $sastojak) {
                    $sastojak = trim($sastojak);
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>".$sastojak."</li>";
                }

                echo "</ul>";
                echo "<h4 class='mt-4'> Način pripreme: </h4>";
                echo "<div class='card bg-light mb-3 mt-3'>";
                echo "<div class='card-body'>";

                // Ispis nacina pripreme recenicu po recenicu.
                $nacinPripreme = explode(".", $row["sadrzaj_recepta"]);
                foreach ($nacinPripreme as $recenicaPripreme) {
                    $recenicaPripreme = trim($recenicaPripreme);
                    if ( $recenicaPripreme != "") {
                        echo "<p class='card-text'>".$recenicaPripreme."."."</p>";
                    }
                    
                }

                // $linkNaPocetnuStranu = "index.php?page=".$brStrane; // samo za testiranje

                echo "</div>";
                echo "</div>";
                echo "</div>";
                // echo "<div class='p-2'> <a class='btn btn-warning btn-lg float-left' href=".$linkNaPocetnuStranu."' role='button'> << NAZAD </a> </div>";
                echo "</div>";
                echo "</p>";
                echo "</div>";

                // echo "BROJ STRANE: ".$brStrane; // samo za testiranje
                // echo "LINK NA POCETNU STRANU: ".$linkNaPocetnuStranu; // samo za testiranje
            }
            $mysqli->close();
        }


        ?>

    </div>

</body>
</html>