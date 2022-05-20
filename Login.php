<?php
    function showLoginHeader()
    {
        echo   "<h1> Login </h1>" ;
    }

    function showLoginContent()
    {
        $_Password =  $_Email =""; 
        
        //Message for Login screen
        echo
        '
            <p class="pLoginmessage"> Please enter login credentials below.</p>
            <br><br>
        ';
        //A form to enter email, name and password and check them to see if they are correct
        echo 
        '
            <form method="post" action="index.php?page=home">
                
                <label class="MarginForAllingment" for="_EmailAddress">Email Address:</label>
                <input type="text" id="_EmailAddress" name= "_EmailAddress">
                <br><br>
              
                <label class="MarginForAllingment" for="_UserPassword">Password:</label>
                <input type="password" id="_UserPassword" name= "_UserPassword">
                <br><br>
                
                <input type="submit" value="Submit">
            </form
        ';
    }
?>