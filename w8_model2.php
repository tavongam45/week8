<?php
function post_a_question($q, $u)
{
    global $conn;
    
    $uid = get_user_id($u);
    $current_date = date("Ymd");
    $sql = "insert into Questions values(NULL, '$q', $uid, $current_date)";
    $result = mysqli_query($conn, $sql);
    if ($result)
        return 'successful';
    else
        return 'unsuccessful';
}

function search_questions($term)
{
    global $conn;
    
    $sql = "select * from Questions where Question like '%$term%'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
    return $data;
}

function get_user_name($uid)
{
    global $conn;
    
    $sql = "select * from Users where Id = $uid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
        return "";
    else {
        $row = mysqli_fetch_assoc($result);
        return($row['Username']);
    }
}

?>
