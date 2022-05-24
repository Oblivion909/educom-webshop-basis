<?php
    function showLoginHeader()
    {
        echo   "<h1> Login </h1>" ;
    }

    function showLoginContent()
    {
        $_Data = ValidateLoginContent();
       
        if($_Data['Valid'])
        {
           showLoginAuthorized($_Data);
        }
        else 
        {
           showLoginForm($_Data);
        }
    }

    function ValidateLoginContent()
    {
        $_Password =  $_Email =""; 
        $_PasswordError =  $_EmailError =""; 
        $_Valid = false;
        
        //Message for Login screen
        echo
        '
            <p class="pLoginmessage"> Please enter login credentials below.</p>
            <br><br>
        ';
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
            $_Password = testInput(getPostVar("EnteredPassword"));
            $_Email = testInput(getPostVar("EnteredEmail"));
            
            //These if statements put the correct error message that is required if the field is not entered (correctly)
            if(empty($_Password))
            {
                $_PasswordError = "Password is required";
            }
            if(empty($_Email))
            {
                $_EmailError = "Email is required";
            }
            elseif(!filter_var($_Email, FILTER_VALIDATE_EMAIL))
            {
                $_EmailError= "Invalid email format";
            }   
            //This if statement makes the form invalid if one of the errors is active.
            if(empty ($_PasswordError)&& empty ($_EmailError))
            {
                $_Valid = true;
            }
        }    
        return array ("EnteredPassword" => $_Password, "EnteredPasswordError" => $_PasswordError, "EnteredEmail" => $_Email, "EnteredEmailError" => $_EmailError, "Valid" => $_Valid);
    }

    function showLoginForm($_Data)
    {
        //A form to enter email and password
        echo 
        '
            <form method="post" action="index.php?page=Login">
                
                <label class="MarginForAllingment" for="EnteredEmail">Email Address:</label>
                <input type="text" id="EnteredEmail" name= "EnteredEmail" value="' . $_Data['EnteredEmail'] . '"> 
                <span class="error">* ' . $_Data['EnteredEmailError'] . ' </span><br><br>
              
                <label class="MarginForAllingment" for="EnteredPassword">Password:</label>
                <input type="Password" id="EnteredPassword" name= "EnteredPassword" value="' . $_Data['EnteredPassword'] . '"> 
                <span class="error">* ' . $_Data['EnteredPasswordError'] . ' </span><br><br>
                
                <input type="submit" value="Submit">
            </form
        ';
    }

    function showLoginAuthorized($_Data)
    {
        echo
        '
            Welcome user: ' . $_Data['EnteredEmail'] . '
        ';
    }
    
    function testInput($_Data)
    {
        $_Data = trim($_Data);
        $_Data = stripslashes($_Data);
        $_Data = htmlspecialchars($_Data);
        return $_Data;
    }   
?>