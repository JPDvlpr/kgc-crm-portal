<?php
function standard_header($title, $stylesheet)
{
    ?>
    <!--
        header.html
        IT-355
        CRM Portal
        Just oK TeaM
    -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title ?></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">

        <!-- bootstrap css -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
              integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
              crossorigin="anonymous">

        <!-- JQuery UI CSS -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Awesome fonts css -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
              integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
              crossorigin="anonymous">

        <!--        data table for filter page-->
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href='<?php echo $stylesheet ?>'>

        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- nav bar styles-->
        <link rel="stylesheet" type="text/css" href="styles/navbarStyles.css">


    </head>
    <body>


    <!-- navigation bar at the top -->
    <header>
        <!-- Just an image -->
        <nav id="nabar" class="navbar navbar-expand-lg navbar-light bg-faded text-white">
            <form id="form" class="form-inline">
                <button id="button1" class="btn btn-sm btn-outline-primary h-25" type="button"><a class="nav-link"
                                                                                                  href="transactionIndex.php"
                                                                                                  class="nav-item active">
                        <h4>New Transactions</h4></a></button>
                <button id="button2" class="btn btn-sm btn-outline-primary h-25" type="button"><a class="nav-link"
                                                                                                  href="contactIndex.php"
                                                                                                  class="nav-item active">
                        <h4>New Contact</h4></a></button>
                <button id="button3" class="btn btn-sm btn-outline-primary h-25" type="button"><a class="nav-link"
                                                                                                  href="filterIndex.php"
                                                                                                  class="nav-item active">
                        <h4>Filter Transactions</h4></a></button>
            </form>
        </nav>
    </header>

    <!-- JQuery for user Login supplies correct path for both parameterized and unparameterized pages -->
    <?php
}

function standard_footer($pagejs)
{
    ?>
    <br><br>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>

    <!-- popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>

    <!-- bootstrap 4 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
            integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
            crossorigin="anonymous"></script>

    <!--        data table for filter page-->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <!-- custom javascript -->
    <script src="./validation/frontendValidations.js"></script>
    <script src='<?php echo $pagejs ?>'></script>


    </body>
    </html>

    <?php
}

?>