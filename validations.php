<?php
    include 'userservice.php';
    // Validate every form in this script


    function validateLoginForm()
    {
        $_LoginPassword =  $_LoginEmail =""; 
        $_LoginPasswordError =  $_LoginEmailError =""; 
        $_LoginValid = false;
            
        $_MyFile = fopen("users.txt", "r") or die ("Cannot open file");  
        $_String = fgets($_MyFile);
        
        
        //If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
            $_LoginPassword = testInput(getPostVar("LoginPassword"));
            $_LoginEmail = testInput(getPostVar("LoginEmail"));
            
            //These if statements put the correct error message that is required if the field is not entered (correctly)
            if(empty($_LoginPassword))
            {
                $_LoginPasswordError = "Password is required";
            }
            if(empty($_LoginEmail))
            {
                $_LoginEmailError = "Email is required";
            }
            elseif(!filter_var($_LoginEmail, FILTER_VALIDATE_EMAIL))
            {
                $_LoginEmailError= "Invalid email format";
            }   
            else
            {
               authenticateUser($_LoginEmail, $_LoginPassword);
            }
            var_dump($_LoginEmailError);
            //This if statement makes the form invalid if one of the errors is active.
            if(empty ($_LoginPasswordError)&& empty ($_LoginEmailError))
            {
                //$_Valid = true;
            }
            
            return array ("LoginPassword" => $_LoginPassword, "LoginPasswordError" => $_LoginPasswordError,
            "LoginEmail" => $_LoginEmail, "LoginEmailError" => $_LoginEmailError, "Valid" => $_LoginValid);

    }
    function validateRegisterForm()
    {
        $_Name = $_Password = $_ScndPassword=  $_Email =""; 
        $_NameError = $_PasswordError = $_ScndPasswordError=  $_EmailError =""; 
        $_Valid = false;
        
        
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
        fclose($_MyFile);
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
            
        return array ("EnteredPassword" => $_Password, "EnteredPasswordError" => $_PasswordError, "SecondPassword" => $_ScndPassword, "SecondPasswordError" => $_ScndPasswordError,
        "EnteredEmail" => $_Email, "EnteredEmailError" => $_EmailError, "UserName" => $_Name, "UserNameError" => $_NameError,
        "Valid" => $_Valid);
    }
    function validateContactForm()
    {
        
    }
    function authenticateUser($_RegisteredEmail, $_RegisteredPassword)
    {
        $_MyFile = fopen("users.txt", "r") or die ("Cannot open file");  
        $_String = fgets($_MyFile);
            
        $_FoundPassword = "";
       
        while(!feof($_MyFile))
        {
            $_String = fgets($_MyFile);
            $_StringParts = explode('|', $_String);
            
            if ($_RegisteredEmail == $_StringParts[0])
            {
                $_FoundPassword = $_StringParts[2];  
            }
            
            if($_FoundPassword == "")
            {
                $_NoEmailFound = true;
                $_LoginEmailError = "Email is not recognised";
                //var_dump($_EmailError);  
            }
            elseif($_FoundPassword != $_RegisteredPassword)
            {
                $_WrongPassword = true;
                $_LoginPasswordError = "Password does not match";                
            }
        }
        //check foto van uitleg voor return;
    }
    
    
?>