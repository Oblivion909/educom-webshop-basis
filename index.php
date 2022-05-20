<?php
    $_Page = getRequestedPage();
    showResponsePage($_Page);
    
    function getRequestedPage()
    {
        $_RequestedType = $_SERVER['REQUEST_METHOD']; 
        if($_RequestedType == 'POST')
        {
            $_RequestedPage = getPostVar('page', 'Login');
        }
        else
        {
            $_RequestedPage = getUrlVar('page', 'Login');
        }
        return $_RequestedPage;
    }
    function showResponsePage($_Page)
    {
        //Show all the content of the page 
        beginDocument();
        showHead();
        showBody($_Page);
        endDocument();
    }
    function getArrayVar($_Array, $_Key, $_Default = '')
    {
        return isset($_Array[$_Key]) ? $_Array[$_Key] : $_Default;
    }
    function getPostVar($_Key, $_Default = '')
    {
        return getArrayVar($_POST, $_Key, $_Default);
    }
    function getUrlVar($_Key, $_Default = '')
    {
        return getArrayVar($_GET, $_Key, $_Default);
    }
    
    function beginDocument()
    {
        //Opens the HTML type for the main purpose of the pages
        echo '<!doctype html> 
        <html>'; 
    }
    function showHead()
    {
        //Shows the standard head function of the HTML pages
        echo '<head>
            <link rel="Stylesheet" href="css\Stylesheet.css">
        </head>';
    }
    function showMenu()
    {
        echo ' <div id="PageContainer"> ';
        echo '
        <body>
            <ul class="LinkList">        <!--Creates a Bullet list with links to the other pages of the website-->
                <li><a href="index.php?page=home"> HOME</a></li>        
                <li><a href="index.php?page=about"> ABOUT ME</a></li>
                <li><a href="index.php?page=contact"> CONTACT</a></li>
                <li><a href="index.php?page=Login"> LOGIN</a></li> 
                <li><a href="index.php?page=Register"> REGISTER</a></li> 
            </ul>';
    }
    function showBody($_Page)
    {
        //Shows the standard body of the HTML pages
        showMenu();
        showContent($_Page);
        showFooter();
    }
    function showContent($_Page)
    {
        //A switch case to decide on which content to show according to the correct page
       
        switch ($_Page)
        {
            case 'home':
                require('home.php');
                showHomeHeader();
                showHomeContent();
            break;
            case 'about':
                require('about.php');
                showAboutHeader();
                showAboutContent();
            break;
            case 'contact':
                require('contact.php');
                showContactHeader();
                showContactContent();
            break;
            case 'Login':
                require('Login.php');
                showLoginHeader();
                showLoginContent();
            break;
            case 'Register':
                require('Register.php');
                showRegisterHeader();
                showRegisterContent();
            break;
        }
        echo '</div> ';
    }
    function showFooter()
    {
            // Standard footer for all pages
        echo '   
            <footer id="Footer"> <!--Tells the footer what to say-->
            &copy 2022 Stan van Vliet
            </footer>    
        </body>';
    }
     function endDocument()
    {
        echo '</html>'; 
        //Closes the HTML type for the main pages
    } 
?>
