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
        <a href="s1.php">الصفحة الرئيسية</a>
    </div>

    <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'a';
    $con = mysqli_connect($host, $user, $pass, $db);
    
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    // المتغيرات 
    $id = $sub = $name = $number = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = isset($_POST['id']) ? mysqli_real_escape_string($con, $_POST['id']) : '';
        $name = isset($_POST['name']) ? mysqli_real_escape_string($con, $_POST['name']) : '';
        $sub = isset($_POST['sub']) ? mysqli_real_escape_string($con, $_POST['sub']) : '';
        $number = isset($_POST['number']) ? mysqli_real_escape_string($con, $_POST['number']) : '';
      
        if (isset($_POST['add'])) {
            $stmt = $con->prepare("INSERT INTO `b` (id, sub, name, number) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $id, $sub, $name, $number);
            if ($stmt->execute()) {
                header("location: a.php");
                exit();
            } else {
                echo "خطأ: " . $stmt->error;
            }
        }
        
        if (isset($_POST['del'])) {
            $stmt = $con->prepare("DELETE FROM `b` WHERE name = ?");
            $stmt->bind_param("s", $name);
            if ($stmt->execute()) {
                header("location: a.php");
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
                    <label for="id">رقم الهوية</label>
                    <input type="text" name='id' id='id' required>
                </div>
                <div>
                    <label for="name">الاسم </label>
                    <input type="text" name='name' id='name' required>
                </div>
            </div>
            <div>
                <label for="sub">البلاغ</label>
                <input type="text" name='sub' id='sub' required>
            </div>
            <div class="field-container">
                <div>
                    <label for="number">رقم الهاتف</label>
                    <input type="text" name='number' id='number' required>
                </div>
            </div>
            <button name='add'>إضافة</button>
            
        </form>
    </div>
</body>
</html>
