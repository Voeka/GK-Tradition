<?php
session_start();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма</title>
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Заполните форму</h2>
    <form method="POST" action="save.php">
        <div class="mb-3">
            <label for="name" class="form-label">Наименование</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($form_data['name'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select class="form-select" id="category" name="category" required>
                <?php
                $categories = ['Default', 'Gidromolot', 'kovshi', 'vibropogruzhateli', 'mulchery'];
                foreach ($categories as $category) {
                    $selected = (isset($form_data['category']) && $form_data['category'] == $category) ? 'selected' : '';
                    echo "<option value=\"$category\" $selected>$category</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Дата</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($form_data['date'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($form_data['description'] ?? '') ?></textarea>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="active" name="active" <?= isset($form_data['active']) && $form_data['active'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="active">Активное</label>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
        <button type="reset" class="btn btn-secondary">Отмена</button>
    </form>
    <p class="datepicker mt-3"></p>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#date').on('change', function() {
            var dateInput = $(this).val();
            var dateParts = dateInput.split('-');

            if (dateParts.length === 3) {
                var year = dateParts[0];
                var month = dateParts[1];
                var day = dateParts[2];
                var formattedDate = day + '-' + month + '-' + year;

                $('.datepicker').text('Выбранная дата: ' + formattedDate);
            } else {
                $('.datepicker').text('Неверный формат даты.');
            }
        });
    });
</script>
</body>
</html>