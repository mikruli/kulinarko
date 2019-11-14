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

    $uploadOK = 1;
    if ( isset($_FILES["fotografijaJela"]) ) {
        $poruke = [];
        $imeSlikeRecepta = $_FILES["fotografijaJela"]["name"];
        $file_size = $_FILES["fotografijaJela"]["size"];
        // echo "IME FAJLA: ".$imeSlikeRecepta."<br>";

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

        // ukoliko je sve u redu snimamo fotografiju jela u direktorijum fotografije
        if ( $uploadOK != 0) {
            
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
    echo "NAZIV RECEPTA JE: ".$nazivRecepta."<br>";
    echo "SASTOJCI RECEPTA SU: ".$sastojiciRecepta."<br>";
    echo "SADRZAJ RECEPTA JE: ".$sadrzajRecepta."<br>";
    echo "VREME PRIPREME JE: ".$vremePripremeRecepta."<br>";
    echo "KATEGORIJA RECEPTA JE: ".$kategorijaRecepta."<br>";
    echo "LOGOVANI KORISNIK JE: ".$logedUsername."<br>";

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