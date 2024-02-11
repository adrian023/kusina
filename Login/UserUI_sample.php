<?php include 'login_process.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
   
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
                <input type="hidden" name="person" value="1"/>
                    <h3>Login</h3>
                    <div class="form-group">

                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($_POST['email'] ?? "") ?>"/>
                        <em><?= htmlspecialchars($email_err) ?? "" ?></em>
                        <em><?= htmlspecialchars($uncofirmed_err) ?? "" ?></em>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" />
                        <em><?= htmlspecialchars($pass_err) ?? "" ?></em>
                    </div>
                    <input type="submit" value='Log In' name="login">
                </form>
            </div>
        </div>
    </div>
</body>
</html>