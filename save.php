<?php
session_start();

// Проверка полей формы
$errors = [];
$form_data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение значений из POST-запроса
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $active = isset($_POST['active']) ? true : false;

    // Проверка поля "Наименование" на пустоту
    if (empty($name)) {
        $errors[] = 'Поле "Наименование" не может быть пустым.';
    } else {
        $form_data['name'] = $name;
    }

    // Проверка поля "Категория" на наличие значения из допустимого списка
    $valid_categories = ['Default', 'Gidromolot', 'kovshi', 'vibropogruzhateli', 'mulchery'];
    if (!in_array($category, $valid_categories)) {
        $errors[] = 'Выбрана неверная категория.';
    } else {
        $form_data['category'] = $category;
    }

    // Проверка корректности формата даты (должен быть формат yyyy-mm-dd)
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        $date_parts = explode('-', $date);
        if (checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
            $form_data['date'] = $date;
        } else {
            $errors[] = 'Некорректная дата.';
        }
    } else {
        $errors[] = 'Дата должна быть в формате yyyy-mm-dd.';
    }

    // Поле "Описание" и парсер гиперссылок
    if (empty($description)) {
        $errors[] = 'Поле "Описание" не может быть пустым.';
    } else {
        // Парсинг гиперссылок из описания
        preg_match_all('/<a\s+href="([^"]+)"/i', $description, $matches);
        $links = $matches[1];
        $form_data['description'] = $description;
        $form_data['links'] = $links;
    }

    // Поле "Активное"
    $form_data['active'] = $active;

    // Сохранение данных в сессию
    $_SESSION['form_data'] = $form_data;

    // Если нет ошибок, вывод JSON
    if (empty($errors)) {
        header('Content-Type: application/json');
        echo json_encode($form_data);
        exit;
    } else {
        // Вывод ошибок
        header('Content-Type: application/json');
        echo json_encode(['errors' => $errors]);
        exit;
    }
}
?>