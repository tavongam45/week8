<?php
if (empty($_POST['page'])) {  // When no page is sent from the client; The initial display
                                // You may use if (!isset($_POST['page'])) instead of empty(...).
    $display_type = 'none';  // This variable will be used in 'view_startpage.php'.
                              // It will display the start page without any box, i.e., no SignIn box, no Join box, ...
    $error_message_username = "";
    $error_message_password = "";
    include ('w8_view_startpage.php');
    exit();
}

require('w8_model.php');  // This file includes some routines to use DB.
require('w8_model2.php');  // This file includes some routines to use DB.

session_start();

// When commands come from StartPage
if ($_POST['page'] == 'StartPage')
{
    $command = $_POST['command'];
    switch($command) {  // When a command is sent from the client
        case 'SignIn':  // With username and password
            // if (there is an error in username and password) {
            if (!check_validity($_POST['username'], $_POST['password'])) {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                                                        // This variable will used in the form in 'view_startpage.php'.
                $display_type = 'signin';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                include('w8_view_startpage.php');
            }
            else {
                $_SESSION['SignIn'] = 'Yes';
                $_SESSION['username'] = $_POST['username'];
                include('w8_view_mainpage.php');
            }
            exit();

        case 'Join':  // With username, password, email, some other information
            // if (there is an error in username and password) {
            if (check_existence($_POST['username'])) {
                $join_error_msg_username = '* Username exists';
                $display_type = 'join';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                include('w8_view_startpage.php');
            }
            else if (join_a_user($_POST['username'], $_POST['password'], $_POST['email'])) {
                $error_msg_username = '';
                $error_msg_password = '';
                $display_type = 'signin';
                include('w8_view_startpage.php');
            }
            else {
                $join_error_msg_username = '* Something wrong';
                $display_type = 'join';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                include('w8_view_startpage.php');
            }
            exit();
        //...
    }
}

// When commands come from 'MainPage'
else if ($_POST['page'] == 'MainPage')
{
    if (!isset($_SESSION['SignIn'])) {
        $display_type = 'none';
        include('w8_view_startpage.php');
        exit();
    }
    
    $command = $_POST['command'];
    switch($command) {
        case 'PostAQuestion':
            $result = post_a_question($_POST['question'], $_SESSION['username']);
            echo $result;
            //include ('w8_view_mainpage.php');
            break;
        case 'SearchQuestions':
            $data = search_questions($_POST['search-term']);
            echo json_encode($data);
//            $result = "<table class='table table-bordered table-condensed'>";
//            $result .= "<tr><th>Question</th><th>Username</th><th>Date</th></tr>";
//            for ($i = 0; $i < count($data); $i++) {
//                $result .= "<tr>";
//                $result .= "<td>" . $data[$i]['Question'] . "</td>";
//                $result .= "<td>" . get_user_name($data[$i]['UserId']) . "</td>";
//                $result .= "<td>" . $data[$i]['Date'] . "</td>";
//                $result .= "</tr>";
//            }
//            $result .= "</table>";
            //include ('w8_view_mainpage.php');
            break;
        case 'SignOut':
            session_unset();
            session_destroy();  // It does not unset session variables. session_unset() is needed.
            $display_type = 'none';
            include ('w8_view_startpage.php');
            break;
    }
}

else {
    //...
}
?>
