<?php
    
    
    function RegisterFormValidated($_Data)
    {
        $_MyFile = fopen("users.txt", "a") or die ("Unable to open file");
        
        $_Text = $_Data['EnteredEmail']. "|" . $_Data['UserName']. "|" . $_Data['EnteredPassword'] . PHP_EOL;
        fwrite($_MyFile, $_Text);
        fclose($_MyFile);
        
        header("location: index.php?page=Login");
    }
?>