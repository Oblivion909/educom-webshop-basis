<?php
    include 'validations.php';
    function showRegisterHeader()
    {
        echo "<h1> Register </h1>";
    }
        
    function showRegisterContent()
    {
        $_Data =  validateRegisterForm();
        if($_Data['Valid'])
        {
            RegisterFormValidated($_Data);
        }  
        else
        {
            ShowRegisterForm($_Data);
        }
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
    
?>