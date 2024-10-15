<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="g.css">
</head>
<body dir='rtl'>
    <?php
    // اتصال قاعدة البيانات 
    $host='localhost';
    $user='root';
    $pass='';
    $db='government';
    $con=mysqli_connect($host, $user, $pass, $db);
    
    // تحقق من اتصال قاعدة البيانات
    if (!$con) {
        die("فشل الاتصال: " . mysqli_connect_error());
    }

    $res = mysqli_query($con, "SELECT * FROM control");
    
    // المتغيرات 
    $id = '';
    $name = '';
    $number = '';
    $type = '';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['number'])) {
        $number = $_POST['number'];
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }

    if (isset($_POST['add'])) {
        $stmt = $con->prepare("INSERT INTO control (id, name, number, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id, $name, $number, $type);
        $stmt->execute();
        header("location: gav.php");
        exit();
    }
    
    if (isset($_POST['del'])) {
        $stmt = $con->prepare("DELETE FROM control WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        header("location: gav.php");
        exit();
    }
    ?>

    <div id="mother">
        <form method='POST'>
            <aside>
                <div id="div">
                    <img src="imj/video.PNG" alt="logo web" width='250px'>
                    <h3>لوحة التحكم</h3>
                    <label for="id">الرقم التسلسلي للمخالفة </label><br>
                    <input type="text" name='id' id='id'><br>
                    <label for="name">اسم المخالف</label><br>
                    <input type="text" name='name' id='name'><br>
                    <label for="number">تاريخ  المخالفة</label><br>
                    <input type="text" name='number' id='number'><br>
                    <label for="type">نوع المخالفة</label><br>
                    <input type="text" name='type' id='type'><br><br>
                    <button name='add'>اضافة مخالفة</button>
                    <button name='del'>حذف مخالفة</button>
                </div>
            </aside>

            <main>
                <table id='tbl'>
                    <tr>
                        <th>  الرقم التسلسلي للمخالفة</th>
                        <th>اسم المخالف</th>
                        <th>تاريخ المخالفة</th>
                        <th>نوع المخالفة</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </main>
        </form>
    </div>
</body>
</html>
