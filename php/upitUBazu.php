<?php
    header('Content-Type: application/json');

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
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page=1;
        };

        $start_from = ($page-1) * $results_per_page;
        $query = "SELECT * FROM ".$datatable." ORDER BY RECEPT_ID ASC LIMIT $start_from, ".$results_per_page;
        $result = $mysqli->query($query);

        if ( $result == FALSE ) {
            echo "Error: ".$mysqli->error($connection);
        } else {
            echo "<table>";
            echo "<tr>";
            echo "<td><strong> Slika </strong></td>";
            echo "<td> <strong> Ime recepta </strong> </td>";
            echo "</tr>";

            while( $row = $result->fetch_assoc() ) {
                echo "<tr>";
                echo '<td> $row["slika_jela"] </td>';
                echo '<td> $row["naziv_recepta"] </td>';
                echo "</tr>";
            }
            echo "</table>";

            $sql = "SELECT COUNT(RECEPT_ID) AS total FROM ".$datatable;
            $rs_result = $mysqli->query($query);
            $row = $rs_result->fetch_assoc();
            $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
      
            for ( $i=1; $i<=$total_pages; $i++ ) {  // print links for all pages
                echo "<a href='index.php?page=".$i."'";
                if ( $i==$page ) {
                    echo " class='curPage'";
                }
                echo ">".$i."</a> "; 
            } 
        }
    }
?>
