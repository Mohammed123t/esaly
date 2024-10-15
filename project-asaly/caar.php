<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض البيانات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="car1.css">
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
            margin-bottom: 20px;
        }
        #navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        #navbar button {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin: 0 15px;
        }
        #mother {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body dir='rtl'>
    <div id="navbar">
        <a href="asal.php">الصفحة الرئيسية</a>
        <button onclick="location.reload();">تحديث</button>
    </div>

    <?php
    // اتصال قاعدة البيانات 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'edd-user';
    $con = mysqli_connect($host, $user, $pass, $db);
    
    // تحقق من اتصال قاعدة البيانات
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    $res = mysqli_query($con, "SELECT * FROM `card-user`");
    ?>

    <div id="mother">
        <h3>عرض البيانات</h3>
        <main>
            <table id='tbl'>
                <tr>
                    <th>الرقم التسلسلي للمخالفة</th>
                    <th>نوع الرخصة</th>
                    <th>الاسم</th>
                    <th>الجنسية</th>
                    <th>المهنة</th>
                    <th>العنوان</th>
                    <th>مكان الاصدار</th>
                    <th>فئة الدم</th>
                    <th>تاريخ الطلب</th>
                </tr>
                
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nationality']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['profession']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['virsion']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['blood']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </main>
    </div>
</body>
</html>
