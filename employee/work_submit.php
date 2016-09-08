<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 08:05
 */
require "../connect_db.php";
$sql = "INSERT INTO WORK_RECORD (EMPLOYEE_ID, WORK_DATE, HOUR_OF_DAY)
        VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $_POST['employee_id'], $_POST['work_date'], $_POST['hour_of_day']);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    header("Location: /shabu#tab-4");
}
$stmt->close();
