<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <section>
        <h4>SIGN UP</h4>

        <form action="includes/signup-include.php" method="post">
            <input type="text" name="user" placeholder="username">
            <input type="password" name="pass" placeholder="password">
            <input type="password" name="passrepeat" placeholder="ripeti password">
            <input type="email" name="mail" placeholder="e-mail">

            <button type="submit" name="submit">sign up</button>
        </form>

    </section>

    <section>

        <h4>LOGIN</h4>

        <form action="includes/login-include.php" method="post">
            <input type="text" name="user" placeholder="username">
            <input type="password" name="pass" placeholder="password">

            <button type="submit" name="submit">login</button>
        </form>
    </section>
</body>
</html>