<?php
    $_Page = getRequestedPage();
    showResponsePage($_Page);
    
    function getRequestedPage($_Page)
    {
        if($_RequestedType == 'POST'))
        {
            $_RequestedPage = getPostVar('page', 'home');
        }
        else
        {
            $_RequestedPage = getUrlVar('page', 'home');
        }
        return $_RequestedPage;
    }
    function showResponsePage($_Page)
    {
        //Show all the content of the page 
        beginDocument();
        showHead();
        showBody($_Page):
        endDocument();
    }
    function getArrayVar($_Key, $_Default == '')
    {
        return isset($_Array[$_Key]) ? $_Array[$_Key] : $_Default;
    }
    function getPostVar($_Key, $_Default == '')
    {
        //Show the POST of the website   ====> https://www.php.net/manual/en/function.filter-input.php
    }
    function getUrlVar($_Key, $_Default == '')
    {
        //Show the GET of the website
    }
    function showContent($_Page)
    {
        //A switch case to decide on which content to show according to the correct page
        
        switch ($_Page)
        {
            case 'home'
                require('home.php');
                $_ShowHome = true;
                $_ShowAbout = false;
                $_ShowContact = false;
            break;
            case 'about'
                require('about.html');
                $_ShowAbout = true;
                $_ShowHome = false;
                $_ShowContact = false;
            break;
            case 'contact'
                require('contact.php');
                $_ShowContact = true;
                $_ShowHome = false;
                $_ShowAbout = false;
            break;
        }
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
        <head>
            <link rel="Stylesheet" href="css\Stylesheet.css">
        </head>
    }
   
    function showBody($_Page)
    {
        //Shows the standard body of the HTML pages
        <body>
        
        <ul class="LinkList">		<!--Creates a Bullet list with links to the other pages of the website-->
            <li><a href="home.php"> HOME</a></li>	    
            <li><a href="about.html"> ABOUT ME</a></li>
            <li><a href="contact.php"> CONTACT</a></li> 
        </ul>
        
        
        if($_ShowHome == true)
        {
            function showHomeContent()
            {
                // Show content unique to the home page
                <div id="PageContainer">
                <h1> Home </h1>
                <!--A welcome message to the site-->
                <p> Welcome to my website! <br> Nice to see you here today! </p>
            }
        }
        
        if($_ShowAbout == true)
        {
            function showAboutContent()
            {
                // Show content unique to the about page
                    <h1> About Me </h1>
                   
                    <p> My name is Stan van Vliet and I am 20 years old. I studied to be a gamedeveloper and succesfully completed the study in May 2021.<br><br> </p>
                    <p> These are a few of my hobbies <br> <p>

                    <ul>    <!--Creates a bullet list for my hobbies-->
                        <li><a>Football</a></li>
                        <li><a>Running</a></li>
                        <li><a>Gaming</a></li>
                    </ul>
                </div>
            } 
        }
        
        if($_ShowContact == true)
        {
            
            function showContactContent()
            {
                // Show content unique to the contact page
                
            }
        }
        
        function showFooter()
        {
            // Standard footer for all pages
            <footer id="Footer"> <!--Tells the footer what to say-->
                &copy 2022 Stan van Vliet
            </footer>	
        }
    
        function endDocument()
        {
            echo '</html>'; 
            //Closes the HTML type for the main pages
        } 
        </body>
    }
?>
