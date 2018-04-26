<?php
function standard_header($title, $stylesheet)
{
    ?>
    <!--
        header.html
        IT-328
        Cat-Wishes Final Project
        This file has the head and header (nav bar) for Cat-Wishes web site.
        Bessy Torres-Miller
        Melanie Felton

    -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php $title ?></title>

        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
              integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
              crossorigin="anonymous">

        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>


    <!-- navigation bar at the top -->
    <header>
        <!-- Just an image -->
        <nav class="navbar navbar-light bg-faded text-white">
            <a class="navbar-brand" id="logoSite" href="">
                <h1>CRM Portal</h1>
            </a>
        </nav>
        <nav class="navbar navbar-light bg-faded">
            <ul class="list-inline">
                <li>
                    <a href="" class="list-inline-item"><h4>Transactions</h4></a>
                </li>
            </ul>

        </nav>
    </header>

    <!-- JQuery for user Login supplies correct path for both parameterized and unparameterized pages -->
    <?php
}

function standard_footer()
{
    ?>
    <!-- bootstrap jquery/popper/javascript -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
            integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
            crossorigin="anonymous"></script>
    <script src="./javascript/newTransaction.js"></script>


    </body>
    </html>

    <?php
}

?>