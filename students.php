<?php
$conn = new mysqli('localhost', 'dbname', 'Password', ' tablename');
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$students = [];
$result = $conn->query("SELECT id, first_name, last_name, group_name FROM students ORDER BY group_name, last_name");
while ($row = $result->fetch_assoc()) {
    $students[$row['group_name']][] = $row;
}

$selected_student = null;
$selected_id = isset($_GET['id']) ? intval($_GET['id']) : null;
if ($selected_id) {
    $res = $conn->query("SELECT * FROM students WHERE id = $selected_id");
    if ($res && $res->num_rows > 0) {
        $selected_student = $res->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Студенты по группам</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            display: flex;
            height: 100vh;
            background-color: #fff;
        }
        .sidebar {
            width: 340px;
            background: #607d8b;
            padding: 20px;
            overflow-y: auto;
            border-right: 1px solid #ccc;
        }
        .group-title {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            border-bottom: 2px solid #ccc;
            padding-bottom: 4px;
        }
        .student-link {
            display: block;
            padding: 8px 12px;
            margin: 4px 0;
            background-color: #fff;
            color: #000;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .student-link:hover {
            background-color: #cfd8dc;
        }
        .student-link.active {
            background-color: #37474f;
            color: #fff;
            font-weight: bold;
        }
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            background-color: #f5f5f5;
        }
        .student-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
            font-size: 26px;
            color: #1a1a1a;
        }
        .info-row {
            display: flex;
            margin-bottom: 10px;
        }
        .label {
            width: 220px;
            font-weight: 600;
            color: #555;
        }
        .value {
            color: #222;
        }
        .search-box {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .search-input {
            width: 100%;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .number {
            color: #888;
            margin-right: 6px;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid #ccc;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="search-box">
        <input type="text" id="searchInput" class="search-input" placeholder="Поиск по имени...">
    </div>

    <h2 class="w3-text-white">Группы</h2>
    <div id="studentList">
        <?php foreach ($students as $group => $group_students): ?>
            <div class="group-title"><?php echo htmlspecialchars($group); ?></div>
            <?php
            $count = 1;
            foreach ($group_students as $student):
                $name = $student['last_name'] . ' ' . $student['first_name'];
                $isActive = ($student['id'] == $selected_id) ? ' active' : '';
            ?>
                <a class="student-link<?php echo $isActive; ?>" href="?id=<?php echo $student['id']; ?>">
                    <span class="number"><?php echo $count++; ?>.</span>
                    <span class="name"><?php echo htmlspecialchars($name); ?></span>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="content">
    <?php if ($selected_student): ?>
        <div class="student-card w3-white">
            <h2><?php echo htmlspecialchars($selected_student['last_name'] . ' ' . $selected_student['first_name']); ?></h2>
            <?php
            $fields = [
                'middle_name' => 'Отчество',
                'phone_number' => 'Телефон',
                'group_name' => 'Группа',
                'hobbies' => 'Хобби',
                'illness' => 'Заболевания',
                'address' => 'Адрес',
                'travel_time' => 'Время на дорогу',
                'birth_date' => 'Дата рождения',
                'email' => 'Email',
                'parent_name' => 'Имя родителя',
                'parent_phone' => 'Телефон родителя',
                'additional_clubs' => 'Дополнительные клубы',
                'document_number' => 'Номер документа',
                'iin' => 'ИИН',
                'living_status' => 'Статус проживания',
                'special_needs' => 'Особые потребности',
                'foreign_languages' => 'Иностранные языки',
                'achievements' => 'Достижения',
                'social_status' => 'Социальный статус'
            ];
            foreach ($fields as $key => $label): ?>
                <div class="info-row">
                    <div class="label"><?php echo $label; ?>:</div>
                    <div class="value"><?php echo htmlspecialchars($selected_student[$key]); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="student-card w3-white">
            <h2>Выберите студента слева</h2>
        </div>
    <?php endif; ?>
</div>

<script>
    // 🔍 Поиск по имени
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let input = this.value.toLowerCase();
        let links = document.querySelectorAll('.student-link');
        links.forEach(link => {
            let name = link.querySelector('.name').textContent.toLowerCase();
            link.style.display = name.includes(input) ? 'block' : 'none';
        });
    });

    // 📌 Сохраняем позицию прокрутки
    const sidebar = document.querySelector('.sidebar');
    sidebar.scrollTop = localStorage.getItem('sidebarScroll') || 0;

    window.addEventListener('beforeunload', () => {
        localStorage.setItem('sidebarScroll', sidebar.scrollTop);
    });
</script>

</body>
</html>
