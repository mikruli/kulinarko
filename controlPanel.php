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
    $logedFirstname = $result->data->firstname;
    $logedLastname = $result->data->lastname;
    $logedEmail = $result->data->email;

    // echo "USERNAME: ".$logedUsername."<br>"; // samo radi testiranja
    // echo "IME: ".$logedFirstname."<br>"; // samo radi testiranja
    // echo "PREZIME: ".$logedLastname."<br>"; // samo radi testiranja
    // echo "E-MAIL: ".$logedEmail."<br>"; // samo radi testiranja

    // Uspostavi novu konekciju
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // Proveri konekciju
    if ( $mysqli->connect_errno ) {
        echo "Error: ".$mysqli->connect_error;
    } else {

        // Postavi UTF8 karakter set kao podrazumevani set za razmenu podataka sa bazom
        $mysqli->set_charset("utf8");

        // sql upit u bazu da bi se dobili svi podaci o prijavljenom korisniku
        $query = "SELECT * FROM ".$datatable_kor." WHERE korisnicko_ime = '".$logedUsername."'";
        $result = $mysqli->query($query);

        $n = $result->num_rows;
        // echo "Broj rezultata = ".$n."<br>"; // sluzi samo za testiranje

        if ( $result == FALSE ) {
            echo "Error: ".$mysqli->error;
        } else {

            // citamo iz baze podataka ostale podatke o korisniku kojih nema u jwt tokenu
            while( $row = $result->fetch_assoc() ) {

                $logedDatRod = $row["datum_rodjenja"];
                $logedAdrStan = $row["adresa_stanovanja"];
                $logedDrzStan = $row["drzava_stanovanja"];
                $logedPol = $row["pol"];
                $logedTelefon = $row["telefon"];
                $logedMobTelefon = $row["mobilni_telefon"];
                
            }

        }
        $mysqli->close();
    }

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
        
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#podaci"> Podaci </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#lozinka"> Lozinka </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#noviRecept"> Novi recept </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#postojeciRecept"> Postojeci recepti </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active show" id="podaci">
                <form id="formaPodaci" class="col-md-6 mt-4" method="POST" action="promeniPodatke.php">
                    <fieldset>
                        <legend style="text-align: center"> Dodatni podaci o korisniku </legend>
                        <!-- IME -->
                        <div class="form-group">
                            <label for="imeKorisnika"> Ime: </label>
                            <input class="form-control" type="text" name="ime" id="imeKorisnika" disabled placeholder="Pera" value="<?php echo $logedFirstname; ?>">
                        </div>
                        <!-- PREZIME -->
                        <div class="form-group">
                            <label for="prezimeKorisnika"> Prezime: </label>
                            <input class="form-control" type="text" name="prezime" id="prezimeKorisnika" disabled placeholder="Peric" value="<?php echo $logedLastname; ?>">
                        </div>
                        <!-- EMAIL -->
                        <div class="form-group">
                            <label for="email"> Email: </label>
                            <input class="form-control" type="email" name="email" id="email" disabled placeholder="pera@domen.com" value="<?php echo $logedEmail; ?>">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <!-- DATUM RODJENJA -->
                        <div class="form-group">
                            <label for="datumRodjenja"> Datum rođenja: </label>
                            <input class="form-control" type="text" name="datumRodjenja" id="datumRodjenja" placeholder="YYYY-MM-DD" value="<?php echo $logedDatRod; ?>">
                        </div>
                        <!-- ADRESA STANOVANJA -->
                        <div class="form-group">
                            <label for="adresaStanovanja"> Adresa stanovanja: </label>
                            <input class="form-control" type="text" name="adresaStanovanja" id="adresaStanovanja" value="<?php echo $logedAdrStan; ?>">
                        </div>
                        <!-- DRZAVA STANOVANJA -->
                        <div class="form-group">
                            <label for="drzavaStanovanja"> Država stanovanja: </label>
                            <input class="form-control" type="text" name="drzavaStanovanja" id="drzavaStanovanja" value="<?php echo $logedDrzStan; ?>">
                        </div>
                            <!-- POL -->
                            <div class="form-group">
                            <label for="pol"> Pol: </label>
                            <input class="form-control" type="text" name="pol" id="pol" maxlength="1" placeholder="M/Ž" value="<?php echo $logedPol; ?>">
                        </div>
                            <!-- TELEFON -->
                            <div class="form-group">
                            <label for="telefon"> Telefon: </label>
                            <input class="form-control" type="text" name="telefon" id="telefon" value="<?php echo $logedTelefon; ?>">
                        </div>
                            <!-- MOBILNI TELEFON -->
                            <div class="form-group">
                            <label for="mobilniTelefon"> Mobilni telefon: </label>
                            <input class="form-control" type="text" name="mobilniTelefon" id="mobilniTelefon" value="<?php echo $logedMobTelefon; ?>">
                        </div>
                        
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"> Promeni podatke </button>
                            <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                        </div>
                    </fieldset>
                    <!-- Element u okviru kojeg ce biti upisane informacije o eventualnim greskama -->
                    <div class="greska text-danger"> <strong id="greskaPodaci"> </strong> </div>
                </form>
            </div>
            <div class="tab-pane fade" id="lozinka">     
                <form id="promenaLozinke" class="col-md-6 mt-4" method="POST" action="promeniLozinku.php">
                    <fieldset>
                        <legend style="text-align: center"> Promena lozinke i osnovnih podataka </legend>
                        <p class="form-text text-muted mt-3 mb-3"> Na ovoj stranici možete da promenite osnovne podatke i lozinku. </p>
                        <!-- IME -->
                        <div class="form-group">
                            <label for="imeKorisnikaLozinka"> Ime*: </label>
                            <input class="form-control" type="text" name="imeLozinka" id="imeKorisnikaLozinka" required placeholder="Pera" value="<?php echo $logedFirstname; ?>">
                        </div>
                        <!-- PREZIME -->
                        <div class="form-group">
                            <label for="prezimeKorisnikaLozinka"> Prezime*: </label>
                            <input class="form-control" type="text" name="prezimeLozinka" id="prezimeKorisnikaLozinka" required placeholder="Peric" value="<?php echo $logedLastname; ?>">
                        </div>
                        <!-- EMAIL -->
                        <div class="form-group">
                            <label for="emailLozinka"> Email*: </label>
                            <input class="form-control" type="email" name="emailLozinka" id="emailLozinka" required placeholder="pera@domen.com" value="<?php echo $logedEmail; ?>">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <!-- OLD PASSWORD -->
                        <div class="form-group">
                            <label for="staraSifra"> Stara šifra*: </label>
                            <input class="form-control" type="password" name="staraSifra" id="staraSifra" required>
                        </div>
                        <!-- NEW PASSWORD -->
                        <div class="form-group">
                            <label for="novaSifra"> Nova šifra*: </label>
                            <input class="form-control" type="password" name="novaSifra" id="novaSifra" required placeholder="Xxx3xxxx">
                        </div>
                        <!-- NEW PASSWORD AGAIN -->
                        <div class="form-group">
                            <label for="novaSifraOpet"> Nova šifra*: </label>
                            <input class="form-control" type="password" name="novaSifraOpet" id="novaSifraOpet" required>
                        </div>
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"> Promeni lozinku </button>
                            <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                        </div>
                    </fieldset>
                    <!-- Element u okviru kojeg ce biti upisane informacije o eventualnim greskama -->
                    <div class="greska text-danger"> <strong id="greskaLozinka"> </strong> </div>
                </form>
            </div>
            <div class="tab-pane fade" id="noviRecept">  
                <form id="noviRecept" class="col-md-6 mt-4" method="POST" action="dodajNoviRecept.php">
                    <fieldset>
                        <legend style="text-align: center"> Novi recept </legend>
                        <!-- NAZIV RECEPTA -->
                        <div class="form-group">
                            <label for="nazivRecepta"> Naziv recepta*: </label>
                            <input class="form-control" type="text" name="nazivRecepta" id="nazivRecepta" required>
                        </div>
                        <!-- SASTOJCI -->
                        <div class="form-group">
                            <label for="sastojci"> Sastojci*: </label>
                            <textarea class="form-control" name="sastojci" id="sastojci" rows="6" required maxlength="510" placeholder="Sastojke odvajajte zarezom npr. 3 jaja, 200 grama brašna, čaša mleka, itd. "></textarea>
                        </div>
                        <!-- SADRŽAJ RECEPTA -->
                        <div class="form-group">
                            <label for="sadrzajRecepta"> Sadržaj recepta*: </label>
                            <textarea class="form-control" name="sadrzajRecepta" id="sadrzajRecepta" rows="10" required></textarea>
                        </div>
                        <!-- VREME PRIPREME -->
                        <div class="form-group">
                            <label for="vremePripreme"> Vreme pripreme*: </label>
                            <input class="form-control" type="text" name="vremePripreme" id="vremePripreme" required>
                        </div>
                        <!-- KATEGORIJA JELA -->
                        <div class="form-group">
                            <label for="kategorijaJela"> Kategorija jela </label>
                            <select class="form-control" id="kategorijaJela" name="kategorijaJela">
                                <option value="1"> Predjelo </option>
                                <option value="2"> Glavno jelo </option>
                                <option value="3"> Supa i čorba </option>
                                <option value="4"> Kolač </option>
                                <option value="5"> Torta </option>
                                <option value="6"> Salata </option>
                            </select>
                        </div>
                        <!-- FOTOGRAFIJA JELA -->
                        <div class="form-group">
                            <label for="fotografijaJela">File input</label>
                            <input type="file" class="form-control-file" id="fotografijaJela" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted"> Slika ne sme biti veca od 900 kB. </small>
                        </div>
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"> Dodaj recept </button>
                            <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                        </div>
                    </fieldset>
                    <!-- Element u okviru kojeg ce biti upisane informacije o eventualnim greskama -->
                    <div class="greska text-danger"> <strong id="greska"> </strong> </div>
                </form>

            </div>
            <div class="tab-pane fade" id="postojeciRecept">
                <p> OVDE TREBA DA BUDE OPCIJA ZA IZMENU POSTOJECEG RECEPTA !!! </p>
            </div>
        </div>
      
                
    </div> <!-- /container -->
    
    <script type="text/javascript" src="js/promeniPodatkeObrada.js"></script>
    <script type="text/javascript" src="js/promeniLozinkuObrada.js"></script>

</body>
</html>