<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Авторизация</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Е-майл</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (filter_var($email, FILTER_VALIDATE_EMAIL) && $email == 'test@test.ru' && $password == 'pass') {
                    header('Location: form.php');
                    exit;
                } else {
                    echo '<div class="alert alert-danger mt-3">Неверный е-майл или пароль</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>