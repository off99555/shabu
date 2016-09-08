<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 13:08
 */
require "../connect_db.php";
$type = $_POST['person_type'];
$sql = "SELECT PERSON_BILL_RATE FROM PERSON_TYPE WHERE PERSON_TYPE = '$type'";
$rows = $conn->query($sql);
$bill_rate = $rows->fetch_row()[0];

$sql = "INSERT INTO PERSON_PRICE (RECEIPT_ID, PERSON_TYPE, TOTAL_PERSON, TOTAL_PRICE)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$total_price = $_POST['total_person'] * $bill_rate;
$receipt_id = $_POST['receipt_id'];
$stmt->bind_param("isii", $receipt_id, $type, $_POST['total_person'], $total_price);
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
            SET TOTAL_PRICE = TOTAL_PRICE + $total_price
            WHERE RECEIPT_ID = $receipt_id";
    $conn->query($sql);
    header("Location: /shabu/?receipt_id=$stmt->insert_id#tab-6");
}
$stmt->close();
