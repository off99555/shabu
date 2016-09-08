<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 08:05
 */
require "../connect_db.php";
$mat_id = $_POST['material_id'];
$sql = "SELECT MATERIAL_QOH
        FROM MATERIAL
        WHERE MATERIAL_ID = $mat_id";
$row = $conn->query($sql)->fetch_row();
$qoh = $row[0];
$remaining = $qoh - $_POST['usage_amount'] - $_POST['expired_amount'];

$sql = "INSERT INTO DAILY_USAGE (MATERIAL_ID, USAGE_DATE, USAGE_AMOUNT, EXPIRED_AMOUNT, REMAINING_AMOUNT, EMPLOYEE_ID)
        VALUES (?, CURRENT_DATE, ?, ?, $remaining, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iddi", $mat_id, $_POST['usage_amount'], $_POST['expired_amount'], $_POST['employee_id']);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    $sql = "UPDATE MATERIAL
            SET MATERIAL_QOH = $remaining
            WHERE MATERIAL_ID = $mat_id";
    $conn->query($sql);
    if ($conn->error) {
        die($conn->error);
    }
    header("Location: /shabu");
}
$stmt->close();
