<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION PAGE</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h2>REGISTRATION PAGE</h2>
        <form action="register_account.php" method="post">
            <input type="text" name="firstname" placeholder="Enter firstname" required><br>
            <input type="text" name="lastname" placeholder="Enter lastname" required><br>
            <input type="text" name="username" placeholder="Enter username" required><br>
            <input type="password" name="password" placeholder="Enter password" required><br>
            <input type="submit" name="register" value="Register"><br>
        </form>
    </div>
</body>
</html>
