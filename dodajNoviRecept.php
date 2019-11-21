<?php

    session_start();

    // podaci o bazi podataka
    include "php/podaciObazi.php";

    // validacija i uzimanje podataka o korisniku koji je ulogovan
    // pripremamo podatke za slanje
    $data = array(
        'jwt' => $_SESSION["jwt"]
    );

    // pretvaranje podataka u json datoteku
    $payload = json_encode($data);

    // pripremamo sve za slanje i podesavamo parametre
    $url = "http://localhost/kulinarko/jwt-rest-api/api/validate_token.php";
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

    $logedUsername = $result->data->username;

    // preuzmi sve podatke o receptu iz forme
    $nazivRecepta = $_POST["nazivRecepta"];
    $sastojiciRecepta = $_POST["sastojci"];
    $sadrzajRecepta = $_POST["sadrzajRecepta"];
    $vremePripremeRecepta = $_POST["vremePripreme"];
    $kategorijaRecepta = $_POST["kategorijaJela"];
    $upload_directory = "./fotografije";

    // $uploadOK = 1;
    // if ( isset($_FILES["fotografijaJela"]) ) {
    //     $poruke = [];
    //     $imeSlikeRecepta = $_FILES["fotografijaJela"]["name"];
    //     $file_size = $_FILES["fotografijaJela"]["size"];
    //     // echo "IME FAJLA: ".$imeSlikeRecepta."<br>";

    //     // informacija koliko je fajlova vec upisano u direktorijum
    //     $fi = new FilesystemIterator($upload_directory, FilesystemIterator::SKIP_DOTS);
    //     $brojFajlova = iterator_count($fi);
    //     $brojFajlova++;

    //     // uzimanje ekstenzije fajla radi ispitivanja da li je format ispravan
    //     $splitParts = explode(".", $_FILES["fotografijaJela"]["name"]);
    //     $file_ext = strtolower(end($splitParts));

    //     $exts = array("jpeg", "jpg", "png", "bmp");

    //     if ( in_array($file_ext, $exts) === false ) {
    //         $poruke[] = "Nije dozvoljena ekstenzija. Odaberite neku drugu sliku.";
    //         $uploadOK = 0;
    //     }

    //     if ( $file_size > 3145728 ) {
    //         $poruke[] = "Fajl ne moze biti veci od 3 MB. <br>";
    //         $uploadOK = 0;
    //     }

    //     // ukoliko je sve u redu snimamo fotografiju jela u direktorijum fotografije
    //     if ( $uploadOK != 0) {
            
    //         $konacnoImeSlike = "$brojFajlova";
    //         // formiranje imena slika koja treba da se upise u direktorijum fotografije
    //         $deloviImena = explode(" ", $splitParts[0]);
    //         foreach ( $deloviImena as $ime ) {
    //             $konacnoImeSlike = $konacnoImeSlike."_".$ime;
    //         }
    //         $putanjaUpisa = $upload_directory."/".$konacnoImeSlike.".".$file_ext;

    //         // proveravamo da li fajl sa formiranim imenom postoji i ako postoji formiramo novo dok ne bude jedinstveno
    //         $j = 0;
    //         while ( file_exists($putanjaUpisa) ) {
    //             // formiramo novo ime slike tako sto na kraj dodajemo broj slike dok ne dobijemo jedinstveno ime
    //             $novoImeSlike = $konacnoImeSlike."_".$j;
    //             $j++;
    //             $putanjaUpisa = $upload_directory."/".$novoImeSlike.".".$file_ext;
    //         }
    //         move_uploaded_file($_FILES["fotografijaJela"]["tmp_name"], $putanjaUpisa);
    //         $poruka = "Fajl uspesno otpremljen";
    //         echo "PUTANJA FAJLE JE: ".$putanjaUpisa."<br>";
    //     }
    // }

    // Uspostavi novu konekciju
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Proveri konekciju
    if ( $mysqli->connect_errno ) {
        echo "Error: ".$mysqli->connect_error;
    } else {

        $uploadOK = 1;
        if ( isset($_FILES["fotografijaJela"]) ) {
            $poruke = [];
            $imeSlikeRecepta = $_FILES["fotografijaJela"]["name"];
            $file_size = $_FILES["fotografijaJela"]["size"];
            // echo "IME FAJLA: ".$imeSlikeRecepta."<br>";
            // echo "VELICINA FAJLA JE: ".$file_size."<br>";
            // informacija koliko je fajlova vec upisano u direktorijum
            $fi = new FilesystemIterator($upload_directory, FilesystemIterator::SKIP_DOTS);
            $brojFajlova = iterator_count($fi);
            $brojFajlova++;

            // uzimanje ekstenzije fajla radi ispitivanja da li je format ispravan
            $splitParts = explode(".", $_FILES["fotografijaJela"]["name"]);
            $file_ext = strtolower(end($splitParts));

            $exts = array("jpeg", "jpg", "png", "bmp");

            if ( in_array($file_ext, $exts) === false ) {
                $poruke[] = "Nije dozvoljena ekstenzija. Odaberite neku drugu sliku.";
                $uploadOK = 0;
            }

            if ( $file_size > 3145728 ) {
                $poruke[] = "Fajl ne moze biti veci od 3 MB. <br>";
                $uploadOK = 0;
            }

            if ( $file_size == 0 ) {
                $poruke[] = "Veličina slike je veća od dozvoljene ili slika nije ni prosleđena.";
                $uploadOK = 0;
            }

            // ukoliko je sve u redu snimamo fotografiju jela u direktorijum fotografije
            if ( $uploadOK != 0 ) {
                
                $konacnoImeSlike = "$brojFajlova";
                // formiranje imena slika koja treba da se upise u direktorijum fotografije
                $deloviImena = explode(" ", $splitParts[0]);
                foreach ( $deloviImena as $ime ) {
                    $konacnoImeSlike = $konacnoImeSlike."_".$ime;
                }
                $putanjaUpisa = $upload_directory."/".$konacnoImeSlike.".".$file_ext;

                // proveravamo da li fajl sa formiranim imenom postoji i ako postoji formiramo novo dok ne bude jedinstveno
                $j = 0;
                while ( file_exists($putanjaUpisa) ) {
                    // formiramo novo ime slike tako sto na kraj dodajemo broj slike dok ne dobijemo jedinstveno ime
                    $novoImeSlike = $konacnoImeSlike."_".$j;
                    $j++;
                    $putanjaUpisa = $upload_directory."/".$novoImeSlike.".".$file_ext;
                }
                move_uploaded_file($_FILES["fotografijaJela"]["tmp_name"], $putanjaUpisa);
                $poruka = "Fajl uspesno otpremljen";
                echo "PUTANJA FAJLE JE: ".$putanjaUpisa."<br>";
            }
        }

        // Postavi UTF8 karakter set kao podrazumevani set za razmenu podataka sa bazom
        $mysqli->set_charset("utf8");

        // sql upit u bazu da bi se upisao novi recept u bazu
        if ( $uploadOK == 1 ) {
            $query = "INSERT INTO recepti (naziv_recepta, sastojci, slika_jela, sadrzaj_recepta, kategorija_jela, vreme_pripreme, autor_recepta)
                VALUES ('".$nazivRecepta."', '".$sastojiciRecepta."', '".$putanjaUpisa."', '".$sadrzajRecepta."', '".$kategorijaRecepta."', '".$vremePripremeRecepta."', '".$logedUsername."');";
        } else {
            $query = "INSERT INTO recepti (naziv_recepta, sastojci, sadrzaj_recepta, kategorija_jela, vreme_pripreme, autor_recepta)
                VALUES ('".$nazivRecepta."', '".$sastojiciRecepta."', '".$sadrzajRecepta."', '".$kategorijaRecepta."', '".$vremePripremeRecepta."', '".$logedUsername."');";
        }
                            
        // echo $query;

        $result = $mysqli->query($query);

        // $n = $result->num_rows;
        // echo "Broj rezultata = ".$n."<br>"; // sluzi samo za testiranje

        if ( $result == FALSE ) {
            echo "Error: ".$mysqli->error;          
        } else {
            // podaci su uspesno upisani u bazu
            // echo "PODACI SU USPENO UPISANI U BAZU.";
            $porukaUpisa = "Recept je uspešno upisan u bazu.";
        }
        $mysqli->close();
    }
    // echo "NAZIV RECEPTA JE: ".$nazivRecepta."<br>";
    // echo "SASTOJCI RECEPTA SU: ".$sastojiciRecepta."<br>";
    // echo "SADRZAJ RECEPTA JE: ".$sadrzajRecepta."<br>";
    // echo "VREME PRIPREME JE: ".$vremePripremeRecepta."<br>";
    // echo "KATEGORIJA RECEPTA JE: ".$kategorijaRecepta."<br>";
    // echo "LOGOVANI KORISNIK JE: ".$logedUsername."<br>";

    // ispisivanje imena svih fajlova u direktorijumu
    // $logDirectory = "./fotografije";
    // $i = 1;
    // foreach(glob($logDirectory.'/*.*') as $file) {
    //     echo "$i. fajl je: ".$file."<br>";
    //     $i++;
    // }

    // ispisivanje broja fajlova u direktorijumu
    // $fi = new FilesystemIterator($logDirectory, FilesystemIterator::SKIP_DOTS);
    // printf("There were %d Files", iterator_count($fi));
   
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
        if ( $result == FALSE ) {
    ?>
            <div class='alert alert-danger'> Došlo je do greške i podaci nisu upisani u bazu. </div>
    <?php
        } else {
    ?>
            <div class='alert alert-success'> <?php echo $porukaUpisa ?> </div>
            <?php
                if ( $uploadOK == 0 ) {
                    foreach ( $poruke as $porukaGreske ) {
            ?>
                <div class='alert alert-danger'> <?php echo $porukaGreske ?> </div>
            <?php
                    }
                } else {
            ?>
                <div class='alert alert-success'> <?php echo $poruka ?> </div>
            <?php        
                }
            ?>
    <?php
        }
    ?>

    </div> <!-- /container -->

</body>
</html>