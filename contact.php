<?php
	function showContactContent()
    {
		$_GenderError= $_NameError= $_EmailError= $_NumberEnteredError= $_CommentError= $_CommunicationError= "";
		$_Gender= $_Name= $_Email= $_NumberEntered= $_Comment= $_CommunicationInput= "";
		$_Valid = false;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			
			//If the client submits the form, this checks if all the input fields are filled in and gives them te correct values
			if(isset($_POST["_Gender"])){$_Gender = $_POST["_Gender"];}
            if(isset($_POST["_FullName"])){$_Name = $_POST["_FullName"];}
            if(isset($_POST["_Email"])){$_Email = $_POST["_Email"];}
            if(isset($_POST["_PhoneNumber"])){$_NumberEntered = $_POST["_PhoneNumber"];}
            if(isset($_POST["_Message"])){$_Comment = $_POST["_Message"];}
			if(isset($_POST["_Communication"])){$_CommunicationInput = $_POST["_Communication"];}
			
			//These if statements put the correct error message that is required if the field is not entered (correctly)
			
			if(empty($_POST["_Gender"]))
			{
				$_GenderError = "Gender is required";
			}
			if(empty($_POST["_FullName"]))
			{
				$_NameError = "Name is required";
			}
            elseif(!preg_match("/^[a-zA-Z\' ]*$/", $_Name))
            {
                $_NameError= "Only letters and spaces allowed!";
            } 
            if(empty($_POST["_Email"]))
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
		
		if (!$_Valid)
		{
			
			echo ' 
					
			<h1> Contact </h1>
					
			<form method="post" action="index.php?page=contact">
					
				<label for="_Gender">What is your gender?</label> 
				<br>
				<select name="_Gender" id="_Gender" value="'. $_Gender . '">
					<option value="Mr."> Mr.</option>
					<option value="Mrs."> Mrs.</option>
					<option value="Other."> Other.</option>
				</select>
				<span class="error">* '. $_GenderError . '</span>
				<br><br>

				<label class="MarginForAllingment" for="_FullName">Full Name:</label>
				<input type="text" name="_FullName" value="' . $_Name . '">
				<span class="error">* '. $_NameError . '  </span><br><br>

				<label class="MarginForAllingment" for="_Email">Email Address:</label>
				<input type="text" id="_Email" name= "_Email" value="' . $_Email . '"> 
				<span class="error">* ' . $_EmailError . ' </span><br><br>

				<label class="MarginForAllingment" for="_PhoneNumber">Phone number:</label>
				<input type="text" name="_PhoneNumber" value="' . $_NumberEntered . '" >
				<span class="error">* ' . $_NumberEnteredError . ' </span> <br><br>
				
				
				
				

				<label class="MarginForAllingment" for="_Message">Your message:</label>
				<textarea name= "_Message" value="' . $_Comment . '"></textarea>
				<span class="error">* ' . $_CommentError . '</span>  <br><br>
				
				';
				
			    echo ' <p> Please select your prefered method of communication </p> ';
				
				echo ' <input type="radio" id="_Communication" name="_Communication" value="Emailing" ';
				if ($_CommunicationInput=="Emailing")
				{
					echo 'checked="checked"';
				}
				echo '>';
				echo ' <label for="Emailing">Email</label> ';
				
				
				
				echo '<input type="radio" id="_Communication" name="_Communication" value="Phoning" ';
				if ($_CommunicationInput=="Phoning")
				{
				  echo 'checked="checked"';
				}
				echo '>';
				echo ' <label for="Phoning">Phoning</label> ';
				
				echo '
				<span class="error">*' . $_CommunicationError . '</span> <br>
				
				
				
				
				
				<p class="pmessage"> Fields with a * are required </p> <br>

				<input type="hidden" name ="page" value="contact">
				<input type="submit" value="Submit">
			
				<br>
				<br>
			</form>';
		}
		
		else 
		{ 
			echo "<h1> Contact </h1>";
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
			echo "<b> Your prefferred way of communication is: </b>". $_CommunicationInput;           
		}
    }
?>