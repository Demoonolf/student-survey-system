<?php

$conn = new mysqli('localhost', 'dbname', 'Password', 'dbname');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация студентов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

   
    <h1>Зарегистрированные студенты</h1>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                    <th>Группа</th>
                    <th>Хобби</th>
                    <th>Заболевания</th>
                    <th>Адрес</th>
                    <th>Время на дорогу</th>
                    <th>Дата рождения</th>
                    <th>Email</th>
                    <th>Имя родителя</th>
                    <th>Телефон родителя</th>
                    <th>Дополнительные клубы</th>
                    <th>Номер документа</th>
                    <th>ИИН</th>
                    <th>Статус проживания</th>
                    <th>Особые потребности</th>
                    <th>Иностранные языки</th>
                    <th>Достижения</th>
                    <th>Социальный статус</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['middle_name']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['group_name']; ?></td>
                        <td><?php echo $row['hobbies']; ?></td>
                        <td><?php echo $row['illness']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['travel_time']; ?></td>
                        <td><?php echo $row['birth_date']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['parent_name']; ?></td>
                        <td><?php echo $row['parent_phone']; ?></td>
                        <td><?php echo $row['additional_clubs']; ?></td>
                        <td><?php echo $row['document_number']; ?></td>
                        <td><?php echo $row['iin']; ?></td>
                        <td><?php echo $row['living_status']; ?></td>
                        <td><?php echo $row['special_needs']; ?></td>
                        <td><?php echo $row['foreign_languages']; ?></td>
                        <td><?php echo $row['achievements']; ?></td>
                        <td><?php echo $row['social_status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет данных для отображения.</p>
    <?php endif; ?>

    <?php
    $conn->close();
    ?>
</body>
</html>
