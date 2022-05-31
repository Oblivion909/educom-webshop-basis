<?php
    session_start();
    $_Page = getRequestedPage();
    $_Data = processRequest($_Page);
    showResponsePage($_Data);
    
    
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
    function processRequest($_Page)
    {
        switch($_Page)
        {
            case "Login":
                require_once('Login.php');
                require_once('validations.php');
                $_Data = validateLoginForm();
                if($_Data['Valid'])
                {
                    $_SESSION['UserName'] = $_Data['UserName'];
                    $_Page = "home";
                }
                break;
            case "Register":
                require_once("Register.php");
                require_once('validations.php');
                require_once("userservice.php");
                $_Data =  validateRegisterForm();
                if($_Data['Valid'])
                {
                    RegisterFormValidated($_Data);
                }  
                break;
            case "contact":
                require_once ('contact.php');
                require_once('validations.php');
                $_Data = validateContactForm();
                if($_Data['Valid'])
                {
                   $_Page = "Thanks";
                }
                break;
            case "LogOut":
                session_unset();
                session_Destroy();
                $_Page = "home";
                break;
        }
        $_Data['page'] = $_Page;
        return $_Data;
    }
    

    function showResponsePage($_Data)
    {
        //Show all the content of the page 
        beginDocument();
        showHead();
        showBody($_Data);
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
        echo
        '<!doctype html> 
        <html>'; 
    }
    function showHead()
    {
        //Shows the standard head function of the HTML pages
        echo
        '<head>
            <link rel="Stylesheet" href="css\Stylesheet.css">
        </head>';
    }
    function showMenuItem($_Link, $_Label)
    {
        
        echo
        '
            <ul class="LinkList"> 
                <li><a href = index.php?page=' .  $_Link . '> ' .  $_Label . '</a></li>
            </ul>
        ';
    }
    function showMenuLoggedIn()
    {
        echo '<ul class="LinkList">';
            showMenuItem("home", "Home");
            showMenuItem("about", "About");
            showMenuItem("contact", "Contact");
            showMenuItem("LogOut", "Log out " . $_SESSION['UserName']);
        echo '</ul>';
    }
    
    function showMenuLoggedOut()
    {
        
        echo '<body>';
      
            echo '<ul class="LinkList">';
                showMenuItem("home", "Home");
                showMenuItem("about", "About");
                showMenuItem("contact", "Contact");
                showMenuItem("Login", "Log in");
                showMenuItem("Register", "Register");
            echo '</ul>';
       
    }
    function showBody($_Data)
    {
        echo ' <div id="PageContainer"> ';
        //Shows the standard body of the HTML pages
        if(isset($_SESSION["LoggedIn"]))
        {
            showMenuLoggedIn();
        }
        else
        {
            showMenuLoggedOut();
        }
        showContent($_Data);
        showFooter();
    }
    function showContent($_Data)
    {
        //A switch case to decide on which content to show according to the correct page
        var_dump($_Data);
        switch ($_Data['page'])
        {
            case 'home':
                require_once('home.php');
                showHomeHeader();
                showHomeContent();
                break;
            case 'about':
                require_once('about.php');
                showAboutHeader();
                showAboutContent();
                break;
            case 'contact':
                require_once('contact.php');
                showContactHeader();
                showContactForm($_Data);
                break;
            case 'Login':
                require_once('Login.php');
                showLoginHeader();
                showLoginForm($_Data);
                break; 
            case 'Register':
                require_once('Register.php');
                showRegisterHeader();
                showRegisterForm($_Data);
                break;
            case 'Thanks':
                require_once('contact.php');
                showContactThanks($_Data);
                break;
        }     
        
        echo'</body>';
    }
    function showFooter()
    {
        // Standard footer for all pages
        echo
        '   
            <footer id="Footer"> <!--Tells the footer what to say-->
            &copy 2022 Stan van Vliet
            </footer>    
        ';
        echo '</div> ';
    }
    function testInput($_Data)
    {
        $_Data = trim($_Data);
        $_Data = stripslashes($_Data);
        $_Data = htmlspecialchars($_Data);
        return $_Data;
    }  
    function endDocument()
    {
        echo '</html>'; 
        //Closes the HTML type for the main pages
    } 
?>