<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ايصالي </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Readex Pro', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        #navbar {
            background-color: #007BFF;
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        #navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        #mother {
            max-width: 400px; 
            margin: 0 auto;
            background: white;
            padding: 10px; 
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input {
            width: calc(100% - 20px); 
            padding: 8px; 
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 8px; 
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin: 5px 0;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body dir='rtl'>
    <div id="navbar">
        <a href="s1.php">الصفحة الرئيسية</a>
    </div>

    <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'edd-user';
    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    $id = $name = $nationality = $profession = $address = $virsion = $blood = $date = '';
    $data_found = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

        if (isset($_POST['fetch'])) {
            $stmt = $con->prepare("SELECT * FROM `card-user` WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $name = $data['name'];
                $nationality = $data['nationality'];
                $profession = $data['profession'];
                $address = $data['address'];
                $virsion = $data['virsion'];
                $blood = $data['blood'];
                $date = $data['date'];
                $data_found = true;
            } else {
                echo "لا توجد بيانات بهذا الرقم التسلسلي.";
            }
        }
    }
    ?>

    <div id="mother">
        <form method='POST'>
            <h3>فحص بيانات الرخصة </h3>
            <div>
                <label for="id">ادخل رقم الهوية </label>
                <input type="text" name='id' id='id' required>
            </div>
            <button name='fetch'>جلب البيانات</button>
        </form>

        <?php if ($data_found): ?>
            <div>
                <h4>البيانات المسترجعة</h4>
                <p>الاسم: <?php echo htmlspecialchars($name); ?></p>
                <p>الجنسية: <?php echo htmlspecialchars($nationality); ?></p>
                <p>المهنة: <?php echo htmlspecialchars($profession); ?></p>
                <p>العنوان: <?php echo htmlspecialchars($address); ?></p>
                <p>مكان الإصدار: <?php echo htmlspecialchars($virsion); ?></p>
                <p>فئة الدم: <?php echo htmlspecialchars($blood); ?></p>
                <p>تاريخ الإصدار الأول: <?php echo htmlspecialchars($date); ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
