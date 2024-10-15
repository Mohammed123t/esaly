<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ايصالي</title>
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
        .field-container {
            display: flex;
            justify-content: space-between;
            margin: 5px 0; 
        }
        .field-container div {
            width: 48%; 
        }
    </style>
</head>
<body dir='rtl'>
    <div id="navbar">
        <a href="asal.php">الصفحة الرئيسية</a>
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

    // المتغيرات 
    $id = $type = $name = $nationality = $profession = $address = $virsion = $blood = $date = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';
        $type = isset($_POST['type']) ? mysqli_real_escape_string($con, $_POST['type']) : '';
        $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
        $nationality = isset($_POST['nationality']) ? mysqli_real_escape_string($con, $_POST['nationality']) : '';
        $profession = isset($_POST['profession']) ? mysqli_real_escape_string($con, $_POST['profession']) : '';
        $address = isset($_POST['address']) ? mysqli_real_escape_string($con, $_POST['address']) : '';
        $virsion = isset($_POST['virsion']) ? mysqli_real_escape_string($con, $_POST['virsion']) : '';
        $blood = isset($_POST['blood']) ? mysqli_real_escape_string($con, $_POST['blood']) : '';
        $date = isset($_POST['date']) ? mysqli_real_escape_string($con, $_POST['date']) : '';

        if (isset($_POST['add'])) {
            $stmt = $con->prepare("INSERT INTO `card-user` (id, type, name, nationality, profession, address, virsion, blood, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssssss", $id, $type, $name, $nationality, $profession, $address, $virsion, $blood, $date);
            if ($stmt->execute()) {
                header("location: cae.php");
                exit();
            } else {
                echo "خطأ: " . $stmt->error;
            }
        }
        
        if (isset($_POST['del'])) {
            $stmt = $con->prepare("DELETE FROM `card-user` WHERE name = ?");
            $stmt->bind_param("s", $name);
            if ($stmt->execute()) {
                header("location: cae.php");
                exit();
            } else {
                echo "خطأ: " . $stmt->error;
            }
        }
    }
    ?>
    
    <div id="mother">
        <form method='POST'>
            <h3>لوحة التحكم</h3>
            <div class="field-container">
                <div>
                    <label for="id">الرقم التسلسلي للرخصة</label>
                    <input type="text" name='id' id='id' required>
                </div>
                <div>
                    <label for="type">نوع الرخصة</label>
                    <input type="text" name='type' id='type' required>
                </div>
            </div>
            <div>
                <label for="name">الاسم</label>
                <input type="text" name='name' id='name' required>
            </div>
            <div class="field-container">
                <div>
                    <label for="nationality">الجنسية</label>
                    <input type="text" name='nationality' id='nationality' required>
                </div>
                <div>
                    <label for="profession">المهنة</label>
                    <input type="text" name='profession' id='profession' required>
                </div>
            </div>
            <div>
                <label for="address">العنوان</label>
                <input type="text" name='address' id='address' required>
            </div>
            <div class="field-container">
                <div>
                    <label for="virsion">مكان الإصدار</label>
                    <input type="text" name='virsion' id='virsion' required>
                </div>
                <div>
                    <label for="blood">فئة الدم</label>
                    <input type="text" name='blood' id='blood' required>
                </div>
            </div>
            <div>
                <label for="date">تاريخ الإصدار الأول</label>
                <input type="date" name='date' id='date' required>
            </div>
            <button name='add'>إضافة</button>
            <button name='del'>حذف</button>
        </form>
    </div>
</body>
</html>
