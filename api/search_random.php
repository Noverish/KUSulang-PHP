<?php
    include('config.php');

    $category = $_POST["category"];
    $region = $_POST["region"];
    $type1 = $_POST["type1"];
    $type2 = $_POST["type2"];

    $sql="SELECT _id FROM Store WHERE (category & $category = $category) AND (region & $region = $region) AND (type1 & $type1 = $type1) AND (type2 & $type2 = $type2)";
    $result = mysqli_query($conn, $sql) or print_error_and_die(mysqli_error($conn));

    $res["res"] = 1;
    $res["msg"] = "success";
    $res["data"] = query_result_to_array($result);

    echo raw_json_encode($res);
?>