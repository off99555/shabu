<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 30-May-16
 * Time: 11:38
 */
require "../connect_db.php";
$sql = "UPDATE ORDERING NATURAL JOIN MATERIAL
        SET ORDER_DEPLETED = 1
        WHERE ORDER_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['order_id']);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    header("Location: /shabu");
}
$stmt->close();
