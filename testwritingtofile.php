<?php
   // 
    
    $_MyFile = fopen("users.txt", "w") or die ("Cannot find file");
    
    $_Text = "Username | ";
    fwrite ($_MyFile, $_Text);
    
    $_Text = "Email Address | ";
    fwrite ($_MyFile, $_Text);
    
     $_Text = "Password";
    fwrite ($_MyFile, $_Text);
    
    echo readfile("users.txt");
    fclose($_MyFile);
?>