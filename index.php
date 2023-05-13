<?php
//Подключение к базе
require_once 'connection.php';

$sort = $_GET['sort']; //значение из кнопки фильтрации
$filter = htmlspecialchars($_GET['filter']); //значение из поля ввода фильтрации по названию

//установка значения переменной для сортировки по цене для запроса к бд
if ($sort) {
    $orderBy = "ORDER BY `products`.`price` $sort";
} else {
    $orderBy = '';
};

//установка значения переменной для фильтрации по названию для запроса к бд
if ($filter) {
    $where = "WHERE `name` LIKE '%$filter%'";
} else {
    $where = '';
};

//Отправка итогового запроса к бд таблице, получение массива.
$goods = mysqli_query($connection, "SELECT * FROM `products` $where $orderBy");
$products = mysqli_fetch_all($goods);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <h1 class="main-header">
            Test_web shop
        </h1>
        <div class="main-content">
            <div class="main-content-sort">
                <form action="" id="filter" class="main-filter">
                    <input type="text" class="main-filter-input" id="filter-input" placeholder="Название" name="filter">
                    <button type="submit" form="filter" class="main-filter-button">Фильтровать</button>
                </form>
                <div class="main-sort">
                    <button type="submit" form="filter" class="sort-btn" name="sort" value="ASC">⬆</button>
                    <button type="submit" form="filter" class="sort-btn" name="sort" value="DESC">⬇</button>
                </div>
            </div>
            <div class="main-list">
                <table class="main-list-table">
                    <tr>
                        <th class="table-name">Название товара</th>
                        <th class="table-price">Цена</th>
                    </tr>
                    <?php
                    //Цикл перебора и вывода всех элементов массива построчно из запроса к бд таблицы
                    foreach ($products as $item) {
                    ?>
                        <tr>
                            <td><?= $item[1] ?></td>
                            <td class="table-price"><?= $item[2] ?>₽</td>
                        </tr>
                    <?php
                    };
                    ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>