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
                    <a class="nav-link" href="#"> Registracija </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Prijava </a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form> -->
        </div>
    </nav>
    <!-- SADRZAJ -->
    <!-- <div class="container">

    </div> -->
    <div class="container mt-5 pt-5">

        <h2 class="border-bottom border-primary"> <strong> KULINARKO </strong> </h2>
        <!-- <hr> -->
        <p> Na ovoj internet starnici možete da pronađete najrazličitije recepte domaćih jela. </p>

        <?php
            // header('Content-Type: application/json');

            // error_reporting(0);
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kulinarko";
            $datatable = "recepti"; // MySQL ime tabele
            $datatable_kor = "korisnici"; // MySQL ime tabele
            $results_per_page = 10; // broj recepata po strani

            // Uspostavi novu konekciju
            $mysqli = new mysqli($servername, $username, $password, $dbname);

            // Proveri konekciju
            if ( $mysqli->connect_error ) {
                echo "Error: ".$mysqli->connect_error;
            } else {

                // Postavi UTF8 karakter set kao podrazumevani set za razmenu podataka sa bazom
                $mysqli->set_charset("utf8");

                if (isset($_GET["page"])) {
                    $page = $_GET["page"]; // oznaka trenutno aktivne strane
                } else {
                    $page = 1;
                };

                // echo "Broj strana = ".$page; // sluzi samo za testiranje

                $start_from = ($page-1) * $results_per_page;

                // echo "Pocni od = ".$start_from; // sluzi samo za testiranje

                $query = "SELECT * FROM ".$datatable." ORDER BY RECEPT_ID ASC LIMIT $start_from, ".$results_per_page;
                $result = $mysqli->query($query);

                $n = $result->num_rows;
                // echo "Broj rezultata = ".$n; // sluzi samo za testiranje

                if ( $result == FALSE ) {
                    echo "Error: ".$mysqli->error($connection);
                } else {

                    while( $row = $result->fetch_assoc() ) {

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

                        // Prikazi prvih >150 karaktera recepta ali tako da poslednja rec bude cela

                        $pozPoslednjeCeleReci = 0;
                        $sadrzajRecepta = $row["sadrzaj_recepta"];
                        $pozPoslednjeCeleReci = strpos($sadrzajRecepta, '.', 150);
                        $skraceniSadrzaj = substr($sadrzajRecepta, 0, $pozPoslednjeCeleReci);
                        $skraceniSadrzaj = $skraceniSadrzaj." ...";
                        // echo "ECHO: ".$pozPoslednjeCeleReci; // sluzi samo za testiranje
                        // echo "TIP SADRZAJA RECEPTA: ".gettype($sadrzajRecepta); // sluzi samo za testiranje
                        // echo "DUZINA SADRZAJA: ".strlen($sadrzajRecepta); // sluzi samo za testiranje

                        echo "<div class='mt-5'>";
                        echo "<div class='row'>";
                        echo "<h2 class='col-12 border-bottom'> <strong>".$row["naziv_recepta"]."</strong> </h2>";
                        echo "</div>";
                        echo "<div class='row'>";
                        echo "<p class='col-12 text-capitalize'> <h6> <i class='fas fa-user ml-3 mr-1'></i>".$imeAutora." <i class='far fa-clock ml-2 mr-1'></i>".$date."</h6> </p>";
                        echo "</div>";
                        echo "<div class='row'>";
                        echo "<img src='".$row["slika_jela"]."' alt='Ime slike' class='col-3 rounded float-left'>";
                        echo "<p clas='col-9'>";
                        echo "<div class='d-flex flex-column mb-3 col-9'>";
                        echo "<div class='p-2 text-justify'>".$skraceniSadrzaj."</div>";
                        echo "<div class='p-2'>";
                        echo "<form method='POST' action='recept_detaljno.php'>";
                        echo "<button type='submit' class='btn btn-primary float-left'> Read More >> </button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</p>";
                        echo "</div>";
                        echo "</div>";
                    }

                    $sql = "SELECT COUNT(RECEPT_ID) AS total FROM ".$datatable;
                    $rs_result = $mysqli->query($sql);
                    $row = $rs_result->fetch_assoc();
                    $total_pages = ceil($row["total"] / $results_per_page); // racuna ukupan broj strana koje se prikazuju

                    // navigacija u dnu strane
                    echo "<div class='row my-4'>";
                    echo "<ul class='pagination pagination-lg mx-auto'>";

                    // navigacija za prethodnu stranu
                    if ( $page == 1 ) {
                        echo "<li class='page-item disabled'>";
                        echo "<a class='page-link' href='#'>&laquo;</a>";
                        echo "</li>";
                    } else {
                        $prethodnaStrana = $page - 1;
                        echo "<li class='page-item'>";
                        echo "<a class='page-link' href='index.php?page=".$prethodnaStrana."'>&laquo;</a>";
                        echo "</li>";
                    }

                    // navigacija po stranama
                    for ( $i = 1; $i <= $total_pages; $i++ ) {  // ispisuje linkove za sve strane
                        echo "<li class='page-item'>";
                        echo "<a href='index.php?page=".$i."'";
                        // echo "<a href='index.php?page=".$i."'";
                        if ( $i == $page ) {
                            echo " class='page-link curPage active'";
                        } else {
                            echo " class='page-link'";
                        }
                        echo ">".$i."</a> ";
                        echo "</li>";
                    }

                    // navigacija za sledeću stranu
                    if ( $page == $total_pages ) {
                        echo "<li class='page-item disabled'>";
                        echo "<a class='page-link' href='#'>&raquo;</a>";
                        echo "</li>";
                    } else {
                        $sledecaStrana = $page + 1;
                        echo "<li class='page-item'>";
                        echo "<a class='page-link' href='index.php?page=".$sledecaStrana."'>&raquo;</a>";
                        echo "</li>";
                    }
                }
            }

        ?>

    </div> <!-- /container -->

    <!-- <form method="POST" action="01_handle.php">
        <button type="submit" class="btn btn-primary float-left"> Read More >> </button>
    </form> -->
    
</body>
</html>