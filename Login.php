<?php
    include 'validations.php';
    function showLoginHeader()
    {
        echo   "<h1> Login </h1>" ;
    }

    function showLoginContent()
    {
        $_Data = validateLoginForm();
        ShowLoginMessage();
       
        if($_Data['Valid'])
        {
           showLoginAuthorized($_Data);
           $_LoggedIn = true;
        }
        else 
        {
           showLoginForm($_Data);
           $_LoggedIn = false;
        }
    }

    function ShowLoginMessage()
    {
        //Message for Login screen
        echo
        '
            <p class="pLoginmessage"> Please enter login credentials below.</p>
            <br><br>
        '; 
    }

    function showLoginForm($_Data)
    {
        
        //A form to enter email and password
        echo 
        '
            <form method="post" action="index.php?page=Login">
                
                <label class="MarginForAllingment" for="LoginEmail">Email Address:</label>
                <input type="text" id="LoginEmail" name= "LoginEmail" value="' . $_Data['LoginEmail'] . '"> 
                <span class="error">* ' . $_Data['LoginEmailError'] . ' </span><br><br>
              
                <label class="MarginForAllingment" for="LoginPassword">Password:</label>
                <input type="Password" id="LoginPassword" name= "LoginPassword" value="' . $_Data['LoginPassword'] . '"> 
                <span class="error">* ' . $_Data['LoginPasswordError'] . ' </span><br><br>
                
                <input type="submit" value="Submit">
            </form
        ';
        
    }
    
    function showLoginAuthorized($_Data)
    {
        echo
        '
            Welcome user: ' . $_Data['UserName'] . '
        ';
    }
   
?>