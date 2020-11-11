<!DOCTYPE html>

<html>
<head>
    <title>Start page for TruQA</title>
    <style>
        /* panes */
        #pane-title {
            position: absolute;
            top: 0;
            width:100%;
            height: 100px;
        }
        #pane-content {
            position: absolute;
            top: 120px;
            width:100%;
            height: calc(100% - 100px);
        }
        
        /* drop-down menu */
        #ddm {
            position:fixed;
            top:0px;
            left:0px;
            z-index: 1000;
        }
        #ddm li, #ddm ul {
            list-style: none;
            padding: 0;
            background-color: Gray;
            cursor:pointer;
        }
        #ddm ul {
            border:1px solid black;
        }
        #ddm > li {
            position: relative;
        }
        #ddm > li > ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
        }
        #ddm > li > ul > li { padding: 5px; }
        #ddm li:hover {
            background-color: #eee;
        }
        #ddm > li:hover > ul {
            display: block;
        }

        /* blanket and modal windows */
        
        #blanket {
            display:none;
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color: LightGrey;
            opacity: 0.5;
            z-index: 888;
        }
        
        .modal-window {
            display: none;
            background-color: White;
            width: 300px; height: 250px; border: 1px solid black;
            position: absolute; top: 50px; left: calc(50% - 150px);
            z-index: 999;
            padding: 10px;
        }
        .modal-label {
            display: inline-block;
            width: 80px;
        }
    </style>
</head>

<body>
    <div id='pane-title'>
        <h1 style='text-align:center'>TRU Questions & Answers</h1>
        <h3 style='text-align:center'>Fall 2020</h3>
        <hr>
        
        <!-- menu -->
        <ul id='ddm'>
            <li style='width: 50px;'><img src='menu_icon.png' width='50px' height='50px'></img>
                <ul style='width:80px'>
                    <li id='menu-signin'>Sign In</li>
                    <li id='menu-join'>Join</li>
                </ul>
            </li>
        </ul>
    </div>
    
    <div id='pane-content'>
        <!-- blanket for modal windows -->
        <div id='blanket'>
        </div>

        <!-- SignIn modal window-->
        <div id='signin-box' class='modal-window'>
            <h2 style='text-align:center'>Sign In</h2>
            <br>
            <form method='post' action='w8_controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='SignIn'>
                <label class='modal-label'>Username:</label>
                <input type='text' name='username' required> <?php if (!empty($error_msg_username)) echo $error_msg_username; ?><br>
                <br>
                <label class='modal-label'>Password:</label>
                <input type='password' name='password' required> <?php if (!empty($error_msg_password)) echo $error_msg_password; ?><br>
                <br>
                <input type='submit'>&nbsp;&nbsp;
                <input id='cancel-signin-button' type='button' value='Cancel'>&nbsp;&nbsp;
                <input type='reset'>
            </form>
        </div>
        
        <!-- Join modal window-->
        <div id='join-box' class='modal-window'>
            <h2 style='text-align:center'>Join</h2>
            <br>
            <form method='post' action='w8_controller.php'>
                <input type='hidden' name='page' value='StartPage'>
                <input type='hidden' name='command' value='Join'>
                <label class='modal-label'>Username:</label>
                <input type='text' name='username' required> <?php if (!empty($join_error_msg_username)) echo $join_error_msg_username; ?><br>
                <br>
                <label class='modal-label'>Password:</label>
                <input type='password' name='password' required><br>
                <br>
                <label class='modal-label'>Email:</label>
                <input type='text' name='email' required><br>
                <br>
                <input type='submit'>&nbsp;&nbsp;
                <input id='cancel-join-button' type='button' value='Cancel'>&nbsp;&nbsp;
                <input type='reset'>
            </form>
        </div>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    <?php
        if ($display_type == 'signin')
            echo 'show_signin();';
        else if ($display_type == 'join')
            echo 'show_join();';
        else
            ;
    ?>
        
    function show_join() {
        $('#blanket').css('display', 'block');
        $('#join-box').css('display', 'block');
    };
    
    function show_signin() {
        $('#blanket').css('display', 'block');
        $('#signin-box').css('display', 'block');
    };
    
    $('#menu-signin').click(function() {
        $('#blanket').css('display', 'block');
        $('#signin-box').css('display', 'block');
    });
    $('#menu-join').click(function() {
        $('#blanket').css('display', 'block');
        $('#join-box').css('display', 'block');
    });
    $('#blanket').click(function() {
        $('#blanket').css('display', 'none');
        $('#signin-box').css('display', 'none');
        $('#join-box').css('display', 'none');
    });
    $('#cancel-signin-button').click(function() {
        $('#blanket').css('display', 'none');
        $('#signin-box').css('display', 'none');
        $('#join-box').css('display', 'none');
    });
    $('#cancel-join-button').click(function() {
        $('#blanket').css('display', 'none');
        $('#signin-box').css('display', 'none');
        $('#join-box').css('display', 'none');
    });
</script>
