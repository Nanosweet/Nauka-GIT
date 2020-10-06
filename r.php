

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <form action="register.php" method="POST">
        <label for="lastname">Imie: </label>
        <input type="text" name="firstname" value="<?php echo $firstname; ?>"><br>
        <div><?php echo $errors['firstname']; ?></div>

        <label for="lastname">Nazwisko: </label>
        <input type="text" name="lastname" value="<?php echo $lastname; ?>"><br>
        <div><?php echo $errors['lastname']; ?></div>

        <label for=" email">Email: </label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br>
        <div><?php echo $errors['email']; ?></div>

        <label for=" password">Hasło: </label>
        <input type="password" name="password">
        <div class="alert alert-danger"><?php echo $errors['password']; ?></div>

        <label for=" confirm_password">Potwierdź hasło: </label>
        <input type="password" name="confirm_password">
        <div><?php echo $errors['confirm_password']; ?></div>

        <button type="submit" name="submit">Rejestruj</button>

    </form>
</body>

</html>