<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="عرض الشكوى">
    <title> ايصالي</title>
    <link rel="stylesheet" href="comp.css">
    <style>
        
        #navbar {
            background-color: #333;
            overflow: hidden;
        }

        #navbar a {
            float: right;  
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body dir='rtl'>
    <div id="navbar">
        <a href="asal.php">الصفحة الرئيسية</a>
       
    </div>

    <?php
    // اتصال قاعدة البيانات 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'present';
    $con = mysqli_connect($host, $user, $pass, $db);
    
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    // تنفيذ استعلام
    $res = mysqli_query($con, "SELECT * FROM sub");
    if (!$res) {
        die("فشل الاستعلام: " . mysqli_error($con));
    }
    ?>

    <div id="mother">
        <main>
            <h3>الشكاوى المقدمة</h3>
            <table id='tbl'>
                <tr>
                    <th>رقم الهوية</th>
                    <th>الاسم</th>
                    <th> الشكوى</th>
                    <th>رقم الهاتف</th>
                </tr>
                <?php
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subm']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['numb']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>لا توجد شكاوى مقدمة</td></tr>";
                }
                ?>
            </table>
        </main>
    </div>
</body>
</html>
