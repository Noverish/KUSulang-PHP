<?php
    include_once("store_add_preview.php");

    if(!$has_error) {
        foreach ($sqls as &$sql) {
            mysqli_query($conn, $sql) or print_error_and_die(mysqli_error($conn));
            echo("SUCCESS - ".substr($sql, 181));
            echo("<br>");
        }
    } else {
        echo("ERROR!!!!");
    }
?>
