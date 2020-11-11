<?php
$conn = mysqli_connect('localhost', 'tmashekaf20', 'tmashekaf20424', 'C354_tmashekaf20');
function check_validity($u, $p)
{
    global $conn;
    
    $sql = "select * from Users where Username = '$u' and Password = '$p'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function check_existence($u)
{
    global $conn;
    
    $sql = "select * from Users where Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function join_a_user($u, $p, $email)
{
    global $conn;
    
    $date = date("Ymd");
    
    $sql = "Insert into Users values (NULL, '$u', '$p', '$email', $date)";
    $result = mysqli_query($conn, $sql);
    
    return $result;
}

function get_user_id($u)
{
    global $conn;
    
    $sql = "select * from Users where Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Id'];
    } else
        return -1;
}

?>
