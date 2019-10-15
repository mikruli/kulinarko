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
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form>
        </div>
    </nav>
    <!-- SADRZAJ -->
    <!-- <div class="container">

    </div> -->
    <div class="container mt-5 pt-5">

        <?php
            // header('Content-Type: application/json');

            // error_reporting(0);
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kulinarko";
            $datatable = "recepti"; // MySQL ime tabele
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
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                };

                // echo "Broj strana = ".$page;

                $start_from = ($page-1) * $results_per_page;

                // echo "Pocni od = ".$start_from;

                $query = "SELECT * FROM ".$datatable." ORDER BY RECEPT_ID ASC LIMIT $start_from, ".$results_per_page;
                $result = $mysqli->query($query);

                $n = $result->num_rows;
                // echo "Broj rezultata = ".$n;

                if ( $result == FALSE ) {
                    echo "Error: ".$mysqli->error($connection);
                } else {
                    echo "<table>";
                    echo "<tr>";
                    echo "<td><strong> Slika </strong></td>";
                    echo "<td><strong> Ime recepta </strong></td>";
                    echo "</tr>";

                    while( $row = $result->fetch_assoc() ) {
                        echo "<tr>";
                        echo "<td>  <img src='".$row["slika_jela"]."' alt='Smiley face' height='100' width='200'>  </td>";
                        echo "<td>".$row["naziv_recepta"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";

                    $sql = "SELECT COUNT(RECEPT_ID) AS total FROM ".$datatable;
                    $rs_result = $mysqli->query($sql);
                    $row = $rs_result->fetch_assoc();
                    $total_pages = ceil($row["total"] / $results_per_page); // racuna ukupan broj strana koje se prikazuju

                    for ( $i = 1; $i <= $total_pages; $i++ ) {  // print links for all pages
                        echo "<a href='index.php?page=".$i."'";
                        if ( $i == $page ) {
                            echo " class='curPage'";
                        }
                        echo ">".$i."</a> "; 
                    } 
                }
            }
        ?>

    </div> <!-- /container -->
    
</body>
</html>