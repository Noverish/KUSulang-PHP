<?php
    include('config.php');
    include('query_func.php');

    ($store_id = $_POST["store_id"]) != NULL or print_error_and_die("There is no store_id");
    ($user_id = $_POST["user_id"]) != NULL or print_error_and_die("There is no user_id");

    if(!is_numeric($store_id)) print_error_and_die("store_id is not number");
    if(!is_numeric($user_id)) print_error_and_die("user_id is not number");

    if_not_valid_store_id_then_die($store_id);
    if_not_valid_user_id_then_die($user_id);

    $sql = "SELECT _id FROM UserDibs WHERE user_id = $user_id AND store_id = $store_id";
    $result = mysqli_query($conn, $sql) or print_sql_error_and_die($conn, $sql);

    $res["res"] = 1;
    $res["msg"] = "success";

    if(mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO UserDibs (user_id, store_id, date) VALUES ($user_id, $store_id, now())";
        $result = mysqli_query($conn, $sql) or print_sql_error_and_die($conn, $sql);
        $res["is_user_dib"] = 1;
    } else {
        $sql = "DELETE FROM UserDibs WHERE user_id = $user_id AND store_id = $store_id";
        $result = mysqli_query($conn, $sql) or print_sql_error_and_die($conn, $sql);
        $res["is_user_dib"] = 0;
    }

    echo raw_json_encode($res);
?>
