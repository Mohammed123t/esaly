<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ايصالي </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="g.css">
    <style>
        body {
            font-family: 'Readex Pro', sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        nav {
            background-color: black; 
            color: blue;
            padding: 10px;
            text-align: right;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        #mother {
            margin: 15px;
        }
        #div {
            background: white;
            padding: 20px;
            border-radius: 1px;
            box-shadow: 0 black;
        }
        h3, h4 {
            color: black;
        }
        button {
            background-color: white;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: blue; 
        }
    </style>
</head>
<body dir='rtl'>
    <nav>
        <a href="s1.php">الصفحة الرئيسية</a>
        <a href="#">البلاغات</a>
    </nav>

    <?php
    
    $host='localhost';
    $user='root';
    $pass='';
    $db='government';
    $con = mysqli_connect($host, $user, $pass, $db);
    
   
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    
    $id = '';
    $data = [];

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
   
        $stmt = $con->prepare("SELECT * FROM control WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            echo "<p>حدث خطأ أثناء جلب البيانات.</p>";
        }
    }
    ?>

    <div id="mother">
        <form method='POST'>
            <aside>
                <div id="div">
                    <img src="imj/video.PNG" alt="شعار الموقع" width='250px'>
                    <h3> فحص المخالفة</h3>
                    <label for="id">ادخل رقم الهوية </label><br><br>
                    <br>
                    <input type="text" name='id' id='id' required><br><br>
                    <button type="submit" name='fetch'> بيانات المخالفة</button>
                </div>
            </aside>

            <main>
                <?php if (!empty($data)): ?>
                    <h4>تفاصيل المخالفة:</h4>
                    <p>الرقم التسلسلي للمخالفة: <?php echo htmlspecialchars($data['id']); ?></p>
                    <p>اسم المخالف: <?php echo htmlspecialchars($data['name']); ?></p>
                    <p>تاريخ المخالفة: <?php echo isset($data['date']) ? htmlspecialchars($data['date']) : 'غير متوفر'; ?></p>

                    <p>نوع المخالفة: <?php echo htmlspecialchars($data['type']); ?></p>
                <?php elseif (isset($_POST['id'])): ?>
                    <p>لا توجد بيانات للمخالفة بهذا الرقم.</p>
                <?php endif; ?>
            </main>
        </form>
    </div>
</body>
</html>
