<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض البيانات</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body dir='rtl'>
    <div id="navbar">
        <a href="asal.php">الصفحة الرئيسية</a>
      
    </div>

    <h2>عرض البيانات</h2>

    <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'a';
    $con = mysqli_connect($host, $user, $pass, $db);
    
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM `b`";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>رقم الهوية </th><th>الاسم </th><th>البلاغ</th><th>رقم الهاتف</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['sub']) . "</td>";
            echo "<td>" . htmlspecialchars($row['number']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>لا توجد بيانات لعرضها.</p>";
    }

    mysqli_close($con);
    ?>
</body>
</html>
