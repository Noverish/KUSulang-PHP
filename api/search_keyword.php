<?php
    include('config.php');

    ($keyword = $_POST["keyword"]) != NULL or print_error_and_die("There is no keyword");
    ($page = $_POST["page"]) != NULL or print_error_and_die("There is no page");

    if(!is_numeric($page)) print_error_and_die("page is not number");

    $page_offset = $PAGE_SIZE * ($page - 1);

    $sql =
        "SELECT _id as store_id, name as store_name, ".
        "(SELECT ROUND(IFNULL(AVG(star_rate), 0), 1) FROM Review WHERE store_id = Store._id) as star_average, ".
        "(SELECT COUNT(_id) FROM Review WHERE store_id = Store._id) as review_num, ".
        "(SELECT COUNT(_id) FROM UserDibs WHERE store_id = Store._id) as dibs_num, ".
        "img as store_img, is_new, ".
        "(SELECT IF(COUNT(_id) = 0, 0, 1) FROM Event WHERE store_id = Store._id) as is_event ".
        "FROM Store ".
        "WHERE (name LIKE '%%%s%%') ".
        "LIMIT $page_offset, $PAGE_SIZE ";
    $sql = sprintf($sql,
        mysqli_real_escape_string($conn, $keyword));
    $result = mysqli_query($conn, $sql) or print_error_and_die(mysqli_error($conn));

    $res["res"] = 1;
    $res["msg"] = "success";
    $res["stores"] = query_result_to_array($result);

    echo raw_json_encode($res);
?>
