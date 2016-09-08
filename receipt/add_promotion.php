<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
require "../connect_db.php";

$receipt_id = $_POST['receipt_id'];
$promotion_id = $_POST['promotion_id'];
$sql = "SELECT PROMOTION_TYPE, PROMOTION_VALUE
            FROM TEMPORAL_PROMOTION
            WHERE PROMOTION_ID = $promotion_id";
$row = $conn->query($sql)->fetch_row();
$type = $row[0];
$value = $row[1];
$discount = 0;
if ($type == 'ABSOLUTE') {
    $discount = $value;
} else if ($type == 'RELATIVE') {
    $sql = "SELECT TOTAL_PRICE
            FROM RECEIPT
            WHERE RECEIPT_ID = $receipt_id";
    $total_price = $conn->query($sql)->fetch_row()[0];
    $discount = $total_price * $value / 100.0;
}


$sql = "INSERT INTO PROMOTION_USAGE (RECEIPT_ID, PROMOTION_ID, DISCOUNT)
        VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $receipt_id, $promotion_id, $discount);
$stmt->execute();
if ($stmt->error) {
    echo '<br><b>ERROR:</b> ', $stmt->error,'<br><br>';
    echo '<h2>นี่คือค่า REQUEST ทั้งหมดที่ได้รับมะกี้</h2><br>';
    foreach ($_REQUEST as $key => $value) {
        echo "$key => '$value'<br>";
    }
    echo '<h2>ระวังให้ดีข้อมูลใส่ไม่ครบก็เป็นยังงี้แหละ จงย้อนกลับไปแก้ด่วน</h2><br>';
} else {
    $sql = "UPDATE RECEIPT
            SET TOTAL_DISCOUNT = TOTAL_DISCOUNT + $discount
            WHERE RECEIPT_ID = $receipt_id";
    $conn->query($sql);
    header("Location: /shabu/?receipt_id=$stmt->insert_id#tab-6");
}
$stmt->close();
