<?php
    function showContactHeader()
    {
       echo "<h1> Contact </h1>";
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
                <textarea name= "_Message" >' . $_Data['_Message'] . '</textarea>
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