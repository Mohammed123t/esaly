<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ايصالي</title>
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
            width: 48%;
            margin: 5px 1%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body dir='rtl'>
    <header id="navbar">
        <a href="asal.php">الصفحة الرئيسية</a>
    </header>

    <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'edd-user';
    $con = mysqli_connect($host, $user, $pass, $db);

    if (!$con) {
        echo "<div style='color: red;'>فشل الاتصال بقاعدة البيانات</div>";
    }

    $id = '';
    $data = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';

        if (isset($_POST['fetch'])) {
            $stmt = $con->prepare("SELECT * FROM `card-user` WHERE id = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
            } else {
                echo "<div style='color: red;'>لا توجد بيانات لهذا الرقم التسلسلي</div>";
            }
        }
    }
    ?>
    
    <main id="mother">
        <form method='POST'>
            <h3> البيانات</h3>
            <label for="id"> رقم الهوية الرقم التسلسلي</label>
            <input type="text" name='id' id='id' required placeholder="أدخل  رقم الهوية">
            <button name='fetch'>البيانات </button>
        </form>

        <?php if (!empty($data)): ?>
            <h4>البيانات:</h4>
            <p><strong>الرقم التسلسلي:</strong> <?php echo htmlspecialchars($data['id']); ?></p>
            <p><strong>نوع الرخصة:</strong> <?php echo htmlspecialchars($data['type']); ?></p>
            <p><strong>الاسم:</strong> <?php echo htmlspecialchars($data['name']); ?></p>
            <p><strong>الجنسية:</strong> <?php echo htmlspecialchars($data['nationality']); ?></p>
            <p><strong>المهنة:</strong> <?php echo htmlspecialchars($data['profession']); ?></p>
            <p><strong>العنوان:</strong> <?php echo htmlspecialchars($data['address']); ?></p>
            <p><strong>مكان الإصدار:</strong> <?php echo htmlspecialchars($data['virsion']); ?></p>
            <p><strong>فئة الدم:</strong> <?php echo htmlspecialchars($data['blood']); ?></p>
            <p><strong>تاريخ الإصدار الأول:</strong> <?php echo htmlspecialchars($data['date']); ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
