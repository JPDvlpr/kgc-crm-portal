<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="styles/index.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <form class="form-signin" action="transactionIndex.php" method="post">
        <label> Username:
            <input type="text" name="username" placeholder="username"></label><br>
        <label> Password:
            <input type="password" name="password" placeholder="password"></label><br>
        <button class="btn btn-lg btn-primary btn-block" value="Login">Sign in</button>
    </form>
</div>
</body>
</html>