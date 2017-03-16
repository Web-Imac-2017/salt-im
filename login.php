<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

   <form action="./api/u/login/1" method="post">
        <label for="text">Login</label>
       <input type="text" name="username" required>

       <br>

        <label for="text">Password</label>
       <input type="password" name="password" required>

       <br>

       <input type="submit" value="Login">

   </form>

</body>
</html>
