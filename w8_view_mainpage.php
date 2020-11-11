<?php
    if (!isset($_SESSION['SignIn'])) {
        include('w8_view_startpage.php');
        exit();
    }
?>

<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='container'>
        <!-- Header -->
        <div class='row' id='pane-title'>
            <h1 style='text-align:center; padding-top: 10px;'>TRUQA - Fall 2020</h1>
            <h3 style='text-align:center; padding-bottom: 10px;'>- User: <?php echo $_SESSION['username']; ?> -</h3>
        </div>
        <hr>
        
        <!-- Navigation -->
        <div class='row' id='pane-navigation'>
            <div class='col-sm-2'>
                <button class='btn btn-sm btn-default' id='post-a-question' data-toggle='modal' data-target='#modal-post-a-question'>Post a Question</button><br>
            </div>
            <div class='col-sm-2'>
                <button class='btn btn-sm btn-default' id='search-questions' data-toggle='modal' data-target='#modal-search-questions'>Search Questions</button><br>
            </div>
            <div class='col-sm-2'>
                <button class='btn btn-sm btn-default' id='sign-out'>Sign Out</button><br>
            </div>
        </div>
        <hr>
        
        <!-- Result -->
        <div class='row' id='pane-result'>
            <?php
                if (!empty($result)) {
                    echo $result;
                }
                else
                    echo "<h3 style='text-align:center'>Results will be displayed here.</h3>";
            ?>
        </div>
    </div>
    
    <!-- Modal Window for PostAQuestion -->
    <div class='modal fade' id='modal-post-a-question'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form class='' method='post' action='w8_controller.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Post A Question</h2>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='page' value='MainPage'>
                        <input type='hidden' name='command' value='PostAQuestion'>
                        <div class='form-group'>
                            <label class="control-label" for="question">Question:</label>
                            <input type="text" class="form-control" id="question" name='question' placeholder="Enter a question!">
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"id = "post_submit1">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal Window for SearchQuestions -->
    <div class='modal fade' id='modal-search-questions'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form class='' method='post' action='w8_controller.php'>
                    <div class='modal-header'>
                        <h2 class='modal-title'>Search Questions</h2>
                    </div>
                    <div class='modal-body'>
                        <input type='hidden' name='page' value='MainPage'>
                        <input type='hidden' name='command' value='SearchQuestions'>
                        <div class='form-group'>
                            <label class="control-label" for="search-term">Search term:</label>
                            <input type="text" class="form-control" id="search-term" name='search-term' placeholder="Enter a question!">
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default"data-dismiss="modal" id="search_submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- SignOut form -->
    <form method='post' action='w8_controller.php' id='form-sign-out' style='display:none'>
        <input type='hidden' name='page' value='MainPage'>
        <input type='hidden' name='command' value='SignOut'>
    </form>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#sign-out').click(function() {
        timeout();
    })
    
    $('#post_submit1').click( function(){
        
        var question = $('#question').val();
        var url = 'w8_controller.php';
        var query = {'page' : 'MainPage', 'command' : 'PostAQuestion', 'question' : question};
        $.post(url, query, function(data){
            $('#pane-result').html(data);
        })
                             
    });
        
    $('#search_submit').click( function(){
        
        var search1 = $('#search-term').val();
        var url = 'w8_controller.php';
        var query = {'page': 'MainPage', 'command' : 'SearchQuestions', 'search-term':
                    search1};
        $.post(url, query, function(data) {
            var output = JSON.parse(data);
                        $result = "<table class='table table-bordered table-condensed'>";
           $result += "<tr><th>Question</th><th>Username</th><th>Date</th></tr>";
               for (var i = 0;  i < output.length; i++) {
               $result += "<tr>";
               $result += "<td>" + output[i]['Question'] + "</td>";
                $result += "<td>" + output[i]['UserId'] + "</td>";
               $result += "<td>" + output[i]['Date'] + "</td>";
                $result += "</tr>";
          }
            $result += "</table>";
            $('#pane-result').html($result);
        });
    });
    
    
    /*
    var timer = setTimeout(timeout, 10 * 1000);
    window.addEventListener('mousemove', event_listener_mousemove_or_keydown);
    window.addEventListener('keydown', event_listener_mousemove_or_keydown);  // for keyboard action
    window.addEventListener('unload', function() {  // when the window is closed
        timeout();
    });
    function event_listener_mousemove_or_keydown() {
        clearTimeout(timer);
        timer = setTimeout(timeout, 10 * 1000);
    }
    */
    function timeout() {
        $('#form-sign-out').submit();
    }
</script>
