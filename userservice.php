<?php
    function RegisterFormValidated($_Data)
    {
        $_MyFile = fopen("users.txt", "a") or die ("Unable to open file");
        
        $_Text = PHP_EOL . $_Data['EnteredEmail']. "|" . $_Data['UserName']. "|" . $_Data['EnteredPassword'];
        fwrite($_MyFile, $_Text);
        fclose($_MyFile);
        
        header("location: index.php?page=Login");
    }
?>