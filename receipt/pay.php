<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
require "../connect_db.php";

$receipt_id = $_POST['receipt_id'];
$discount = $_POST['discount'];
$sql = "UPDATE RECEIPT
        SET RECEIPT_PAID = 1, TOTAL_DISCOUNT = TOTAL_DISCOUNT + $discount
        WHERE RECEIPT_ID = $receipt_id";
$conn->query($sql);

if ($conn->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    $conn->commit();
    $conn->close();
    header("Location: /shabu/?receipt_id=$receipt_id#tab-6");
}
