<!DOCTYPE html>
<html>
    <head>
        <link rel="Stylesheet" href="css\Stylesheet.css">
    </head>

    <body>

        <?php
            $_GenderError= $_NameError= $_EmailError= $_NumberEnteredError= $_CommentError= $_CommunicationError= "";
            $_Gender= $_Name= $_Email= $_NumberEntered= $_Comment= $_CommunicationInput= "";
            $_Valid = false;

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                //If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
                if(isset($_POST["_Gender"])){$_Gender = $_POST["_Gender"];}
                if(isset($_POST["_FullName"])){$_Name = $_POST["_FullName"];}
                if(isset($_POST["_EmailAdress"])){$_Email = $_POST["_EmailAdress"];}
                if(isset($_POST["_PhoneNumber"])){$_NumberEntered = $_POST["_PhoneNumber"];}
                if(isset($_POST["_Message"])){$_Comment = $_POST["_Message"];}
                if(isset($_POST["_Communication"])){$_CommunicationInput = $_POST["_Communication"];}
                
                //These if statements put the correct error message that is required if the field is not entered (correctly)
                if(empty($_POST["_FullName"]))
                {
                    $_NameError = "Name is required";
                }
                elseif(!preg_match("/^[a-zA-Z' ]*$/", $_Name))
                {
                    $_NameError= "Only letters and spaces allowed!";
                }
                
                if(empty($_POST["_EmailAdress"]))
                {
                    $_EmailError = "Email is required";
                }
                elseif(!filter_var($_Email, FILTER_VALIDATE_EMAIL))
                {
                    $_EmailError= "Invalid email format";
                }
                
                if(empty($_POST["_PhoneNumber"]))
                {
                    $_NumberEnteredError = "Number is required";
                }
                
                if(empty($_POST["_Message"]))
                {
                    $_CommentError = "Message is required";
                }
                
                if(empty($_POST["_Communication"]))
                {
                    $_CommunicationError = "Prefered communication type is required";
                }
                //This if statement makes the form invalid if one of the errors is active.
                if(empty($_GenderError) && empty ($_NameError)&& empty ($_EmailError)&& empty ($_NumberEnteredError)&& empty ($_CommentError)&& empty ($_CommunicationError))
                {
                    $_Valid = true;
                }
            }
            
            function Test_Input($_Data)
            {
                $_Data = trim($_Data);
                $_Data = stripslashes($_Data);
                $_Data = htmlspecialchars($_Data);
                return $_Data;
            }
        ?>

        <div id="PageContainer">
            <h1> Contact </h1>

            <ul class="LinkList">        <!--Creates a Bullet list with links to the other pages of the website-->
                <li><a href="home.php"> HOME</a></li>	
                <li><a href="about.html"> ABOUT ME</a></li>
                <li><a href="contact.php"> CONTACT</a></li>
            </ul>


            <?php if (!$_Valid) { ?>
            
                <!-- input fields -->
                <form method="post" action="contact.php">

                    <label for="_Gender">What is your gender? <span class="error">* <?php echo $_GenderError;?></span></label> <!-- Dropdown field to enter Gender-->
                    <br>
                    <select name="_Gender" id="_Gender">
                        <option value="Dhr."> Dhr.</option>
                        <option value="Mvr."> Mvr.</option>
                        <option value="Other."> Other.</option>
                    </select>
                     <br><br>

                    <label class="MarginForAllingment" for="_FullName">Full Name:</label>
                    <input type="text" name="_FullName" value="<?php echo $_Name;?>"><!-- input field for your full name -->
                    <span class="error">* <?php echo $_NameError;?></span> <br><br>

                    <label class="MarginForAllingment" for="_EmailAdress">Email Address:</label>
                    <input type="text" id="_EmailAdress" name= "_EmailAdress" value="<?php echo $_Email;?>"> <!-- input field for your email address-->
                    <span class="error">* <?php echo $_EmailError;?></span> <br><br>

                    <label class="MarginForAllingment" for="_PhoneNumber">Phone number:</label>
                    <input type="text" name="_PhoneNumber" value="<?php echo $_NumberEntered;?>"><!-- input field for your phone number -->
                    <span class="error">* <?php echo $_NumberEnteredError;?></span> <br><br>

                    <label class="MarginForAllingment" for="_Message">Your message:</label>
                    <textarea name= "_Message" ><?php echo $_Comment;?></textarea><!-- input field for your message -->
                    <span class="error">* <?php echo $_CommentError;?></span> <br><br>

                    <p> Please select your prefered method of communication </p> <!-- Radio menu to enter preffered communication type -->
                    <input type="radio" id="_Emailing" name="_Communication"    <?php if (isset($_CommunicationInput) && $_CommunicationInput=="_Emailing") echo "checked";?>    value="Emailing"> Email
                    
                    
                    <input type="radio" id="_Phoning" name="_Communication"    <?php if (isset($_CommunicationInput) && $_CommunicationInput=="_Phoning") echo "checked";?>    value="_Phoning"> Phone
                    <span class="error">* <?php echo $_CommunicationError;?></span> <br>


                    <p class="pmessage"> Fields with a * are required </p> <br>

                    <input type="submit" value="Submit">

                    <br>
                    <br>
                </form>
                
            <?php } else 
            { 
                //Sets the thank you messages after form is submitted
                echo "<b>Welcome: </b>";
                echo $_Gender;
                echo " ";
                echo $_Name;
                echo "<br>";
                echo "<b> Your email is: </b>". $_Email;
                echo "<br>";
                echo "<b> Your phone number is: </b>". $_NumberEntered;
                echo "<br>";
                echo "<b> Your comment was: </b>". $_Comment;
                echo "<br>";
                echo "<b> Your prefered way of communication is: </b>". $_CommunicationInput;                
            } ?>
            
            <footer id="Footer">    <!--Tells the footer what to say-->
                &copy 2022 Stan van Vliet
            </footer>
        </div>
    </body>

</html>