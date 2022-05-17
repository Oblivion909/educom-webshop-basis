<?php
    function showRegisterContent()
    {
         $_Name = $_Password = $_ScndPassword=  $_Email =""; 
        
        //Message for Login screen
        echo
        '
            <h1> Register </h1>
            <p class="pLoginmessage"> Please register below.</p>
            <br><br>
        ';
        //A form to enter email, name and password and check them to see if they are correct
        echo 
        '
            <form method="post" action="index.php?page=home">
                
                <label class="MarginForAllingment" for="_EmailAddress">Email Address:</label>
                <input type="text" id="_EmailAddress" name= "_EmailAddress">
                <br><br>
                
                <label class="MarginForAllingment" for="_UserName">Username:</label>
                <input type="text" id="_UserName" name= "_UserName">
                <br><br>
                
                <label class="MarginForAllingment" for="_UserPassword">Password:</label>
                <input type="password" id="_UserPassword" name= "_UserPassword">
                <br><br>
                
                <label class="MarginForAllingment" for="_RepeatPassword">Re-enter password:</label>
                <input type="password" id="_RepeatPassword" name= "_RepeatPassword">
                <br><br>
                
                <input type="submit" value="Submit">
            </form>
        ';
    }
?>