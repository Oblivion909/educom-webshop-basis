<?php
    
    function showRegisterHeader()
    {
        echo "<h1> Register </h1>";
    }
        
    function showRegisterContent()
    {
        $_Data =  ValidateRegisterContent();
        if($_Data['Valid'])
        {
            RegisterFormValidated($_Data);
        }  
        else
        {
            ShowRegisterForm($_Data);
        }
    }
    
    
    
    
    function ValidateRegisterContent()
    {
        $_Name = $_Password = $_ScndPassword=  $_Email =""; 
        $_NameError = $_PasswordError = $_ScndPasswordError=  $_EmailError =""; 
        $_Valid = false;
        
        //Message for Register screen
        echo
        '
            <p class="pLoginmessage"> Please register below.</p>
            <br><br>
        ';
        
        //A form to enter email, name and password and check them to see if they are correct
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            
            $_MyFile = fopen("users.txt", "r") or die ("Cannot open file");
            
            //If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
            $_Email = testInput(getPostVar("EnteredEmail"));
            $_Name = testInput(getPostVar("UserName"));
            $_Password = testInput(getPostVar("EnteredPassword"));
            $_ScndPassword = testInput(getPostVar("SecondPassword"));
            
            //These if statements put the correct error message that is required if the field is not entered (correctly)
            if(empty($_Password))
            {
                $_PasswordError = "Password is required";
            }
            if(empty($_ScndPassword))
            {
                $_ScndPasswordError = "Password is required";
            }
            elseif($_ScndPassword != $_Password)
            {
                $_ScndPasswordError = "Passwords do not match";
            }
            while(!feof($_MyFile))
            {
                $_String = fgets($_MyFile);
                $_Parts = explode('|', $_String);
                
                if ($_Email == $_Parts[0])
                {
                    $_EmailError = "Email is already in use";
                }
            }
            if(empty($_Email))
            {
                $_EmailError = "Email is required";
            }
            elseif(!filter_var($_Email, FILTER_VALIDATE_EMAIL))
            {
                $_EmailError= "Invalid email format";
            }
            if(empty($_Name))
            {
                $_NameError = "Name is required";
            }
            elseif(!preg_match("/^[a-zA-Z\' ]*$/", $_Name))
            {
                $_NameError= "Only letters and spaces allowed!";
            } 
            
            //This if statement makes the form invalid if one of the errors is active.
            if(empty ($_PasswordError)&& empty ($_ScndPasswordError)&& empty ($_NameError)&& empty ($_EmailError))
            {
                $_Valid = true;
            }
        }    
        return array ("EnteredPassword" => $_Password, "EnteredPasswordError" => $_PasswordError, "SecondPassword" => $_ScndPassword, "SecondPasswordError" => $_ScndPasswordError,
        "EnteredEmail" => $_Email, "EnteredEmailError" => $_EmailError, "UserName" => $_Name, "UserNameError" => $_NameError,
        "Valid" => $_Valid);
    }
    
    function ShowRegisterForm($_Data)
    {
        echo 
        '
            <form method="post" action="index.php?page=Register">
                
                <label class="MarginForAllingment" for="EnteredEmail">Email Address:</label>
                <input type="text" id="EnteredEmail" name= "EnteredEmail" value="' . $_Data['EnteredEmail'] . '"> 
                <span class="error">* ' . $_Data['EnteredEmailError'] . ' </span><br><br>
                
                <label class="MarginForAllingment" for="UserName">User name:</label>
                <input type="text" id="UserName" name= "UserName" value="' . $_Data['UserName'] . '"> 
                <span class="error">* ' . $_Data['UserNameError'] . ' </span><br><br>
              
                <label class="MarginForAllingment" for="EnteredPassword">Password:</label>
                <input type="Password" id="EnteredPassword" name= "EnteredPassword" value="' . $_Data['EnteredPassword'] . '"> 
                <span class="error">* ' . $_Data['EnteredPasswordError'] . ' </span><br><br>
                
                <label class="MarginForAllingment" for="SecondPassword">Reenter Password:</label>
                <input type="Password" id="SecondPassword" name= "SecondPassword" value="' . $_Data['SecondPassword'] . '"> 
                <span class="error">* ' . $_Data['SecondPasswordError'] . ' </span><br><br>
                
                
                <input type="hidden" name ="page" value="Register">
                <input type="submit" value="Submit">
            </form
        ';
    }
    
    function RegisterFormValidated($_Data)
    {
        $_MyFile = fopen("users.txt", "a") or die ("Unable to open file");
        
        echo
        '
            user: ' . $_Data['EnteredEmail'] . ' registerd
        ';
        
        $_Text = $_Data['EnteredEmail']. "|" . $_Data['UserName']. "|" . $_Data['EnteredPassword'] . PHP_EOL;
        fwrite($_MyFile, $_Text);
        fclose($_MyFile);
    }
?>