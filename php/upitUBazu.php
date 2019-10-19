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