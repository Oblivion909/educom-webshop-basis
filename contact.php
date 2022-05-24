<?php

    function showContactHeader()
    {
       echo "<h1> Contact </h1>";
    }
    
    function showContactContent()
    {
        $_Data = validateContactForm();
       
        if($_Data['Valid'])
        {
           showContactThanks($_Data);
        }
        else 
        {
           showContactForm($_Data);
        }
    }
    
    function validateContactForm()
    {
        $_GenderError= $_NameError= $_EmailError= $_NumberEnteredError= $_CommentError= $_CommunicationError= "";
        $_Gender= $_Name= $_Email= $_NumberEntered= $_Comment= $_CommunicationInput= "";
        $_Valid = false;
        
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
            
            $_Gender = testInput(getPostVar("_Gender"));
            $_Name = testInput(getPostVar("_FullName"));
            $_Email = testInput(getPostVar("_Email"));
            $_NumberEntered = testInput(getPostVar("_PhoneNumber"));
            $_Comment = testInput(getPostVar("_Message"));
            $_CommunicationInput = testInput(getPostVar("_Communication"));
            
            //These if statements put the correct error message that is required if the field is not entered (correctly)
            if(empty($_Gender))
            {
                $_GenderError = "Gender is required";
            }
            if(empty($_Name))
            {
                $_NameError = "Name is required";
            }
            elseif(!preg_match("/^[a-zA-Z\' ]*$/", $_Name))
            {
                $_NameError= "Only letters and spaces allowed!";
            } 
            if(empty($_Email))
            {
                $_EmailError = "Email is required";
            }
            elseif(!filter_var($_Email, FILTER_VALIDATE_EMAIL))
            {
                $_EmailError= "Invalid email format";
            }   
            if(empty($_NumberEntered))
            {
                $_NumberEnteredError = "Number is required";
            }
            if(empty($_Comment))
            {
                $_CommentError = "Message is required";
            }  
            if(empty($_CommunicationInput))
            {
                $_CommunicationError = "Prefered communication type is required";
            }
            //This if statement makes the form invalid if one of the errors is active.
            if(empty($_GenderError) && empty ($_NameError)&& empty ($_EmailError)&& empty ($_NumberEnteredError)&& empty ($_CommentError)&& empty ($_CommunicationError))
            {
                $_Valid = true;
            }
        }
        //Returns all values as an array for later use.
        return array("_Gender" => $_Gender, "_GenderError" => $_GenderError, "_FullName" => $_Name, "_NameError" => $_NameError, "_Email" => $_Email, "_EmailError" => $_EmailError, "_PhoneNumber" => $_NumberEntered, "_NumberError" => $_NumberEnteredError, "_Message" => $_Comment, "_CommentError" => $_CommentError, "_Communication" => $_CommunicationInput, "_CommunicationError" => $_CommunicationError, "Valid" => $_Valid);
    }
    
    function testInput($_Data)
    {
        $_Data = trim($_Data);
        $_Data = stripslashes($_Data);
        $_Data = htmlspecialchars($_Data);
        return $_Data;
    }    
    
    function showContactForm($_Data)
    {
        echo ' 
            <form method="post" action="index.php?page=contact">   
                <label for="_Gender">What is your gender?</label> 
                <br>
                <select name="_Gender" id="_Gender" value="'. $_Data['_Gender'] . '">
                    <option value="Mr."> Mr.</option>
                    <option value="Mrs."> Mrs.</option>
                    <option value="Other."> Other.</option>
                </select>
                <span class="error">* '. $_Data['_GenderError'] . '</span>
                <br><br>

                <label class="MarginForAllingment" for="_FullName">Full Name:</label>
                <input type="text" id="_FullName" name="_FullName" value="' . $_Data['_FullName'] . '">
                <span class="error">* '. $_Data['_NameError'] . '  </span><br><br>

                <label class="MarginForAllingment" for="_Email">Email Address:</label>
                <input type="text" id="_Email" name= "_Email" value="' . $_Data['_Email'] . '"> 
                <span class="error">* ' . $_Data['_EmailError'] . ' </span><br><br>

                <label class="MarginForAllingment" for="_PhoneNumber">Phone number:</label>
                <input type="text" name="_PhoneNumber" value="' . $_Data['_PhoneNumber'] . '" >
                <span class="error">* ' .  $_Data['_NumberError'] . ' </span> <br><br>
                
                <label class="MarginForAllingment" for="_Message">Your message:</label>
                <textarea name= "_Message" value="' . $_Data['_Message'] . '"></textarea>
                <span class="error">* ' . $_Data['_CommentError'] . '</span>  <br><br>
                
                ';
                
                echo ' <p> Please select your prefered method of communication </p> ';
                
                echo ' <input type="radio" id="_Communication" name="_Communication" value="Emailing" ';
                if ($_Data['_Communication']=="Emailing")
                {
                    echo 'checked="checked"';
                }
                echo '>';
                echo ' <label for="Emailing">Email</label> ';
                
                echo '<input type="radio" id="_Communication" name="_Communication" value="Phoning" ';
                if ($_Data['_Communication']=="Phoning")
                {
                  echo 'checked="checked"';
                }
                echo '>';
                echo ' <label for="Phoning">Phoning</label> ';
                
                echo '
                <span class="error">*' . $_Data['_CommunicationError'] . '</span> <br>
                
                <p class="pmessage"> Fields with a * are required </p> <br>

                <input type="hidden" name ="page" value="contact">
                <input type="submit" value="Submit">
            
                <br>
                <br>
            </form>
        ';
    }
    
    function showContactThanks($_Data)
    {
        //Sets the thank you messages after form is submitted
        echo "<b>Welcome: </b>";
        echo $_Data['_Gender'];
        echo " ";
        echo $_Data['_FullName'];
        echo "<br>";
        echo "<b> Your email is: </b>". $_Data['_Email'];
        echo "<br>";
        echo "<b> Your phone number is: </b>". $_Data['_PhoneNumber'];
        echo "<br>";
        echo "<b> Your comment was: </b>". $_Data['_Message'];
        echo "<br>";
        echo "<b> Your prefferred way of communication is: </b>". $_Data['_Communication'];
    }
?>