<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список моих задач</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Список задач</h1>
        <form action="add.php" method="post">
            <input type="text" name="task" class="form-control" id="task" placeholder="Нужно сделать...">
            <button type="submit" class="btn btn-success">Добавить задачу</button>
        </form>
        <?php
        require "configDB.php";
        echo "<ul>";
        $sql = "SELECT * FROM `tasks` ORDER BY `id` DESC";
        $query = $pdo->query($sql);
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo "<li><b>" . $row->task . "<b> <a href='delete.php?id=" . $row->id . "''>Удалить</a></li>";
        }
        echo "</ul>";
        ?>
    </div>
</body>

</html>