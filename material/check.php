<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 30-May-16
 * Time: 01:27
 */
$sql = "SELECT ORDER_ID, MATERIAL_NAME, MATERIAL_QOH, ORDER_AMOUNT, MATERIAL_UNIT, ORDER_DATE, ORDER_COST
        FROM ordering NATURAL JOIN material
        WHERE ORDER_ARRIVED_DATE IS NULL";
$rows = $conn->query($sql);
echo $conn->error;
?>
<h2>เช็คว่ามาส่งแล้ว</h2>
<form action="/shabu/material/order_arrive.php" method="post">
    <label for="order_id">การสั่งซื้อวัตถุดิบ (ที่ยังไม่มาส่ง):</label>
    <select name="order_id" class="order_id">
        <option value=""></option>
        <?php
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='สั่งเมื่อ $row[5]'>$row[0] - $row[1] $row[3] $row[4] $row[6] บาท</option>";
        }
        ?>
    </select><br>

    <label for="order_exp_date">วันหมดอายุ:</label>
    <input type="text" name="order_exp_date" id="order_exp_date" class="datetimepicker"><br>

    <button type="submit" title="จ่ายเงินให้เขาไปด้วยนะอย่าลืม">มาส่งแล้ว</button>
</form>
<?php
$sql = "SELECT ORDER_ID, MATERIAL_NAME, MATERIAL_QOH, ORDER_AMOUNT, MATERIAL_UNIT, ORDER_ARRIVED_DATE, ORDER_COST
        FROM ordering NATURAL JOIN material
        WHERE ORDER_ARRIVED_DATE IS NOT NULL AND ORDER_DEPLETED = 0";
$rows = $conn->query($sql);
echo $conn->error;
?>
<h2>เช็คว่าใช้หมดแล้ว</h2>
<form action="/shabu/material/order_deplete.php" method="post">
    <label for="order_id">การสั่งซื้อวัตถุดิบ (ที่มาส่งแล้วแต่ยังใช้ไม่หมด):</label>
    <select name="order_id" class="order_id">
        <option value=""></option>
        <?php
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='มาส่งเมื่อ $row[5]'>$row[0] - $row[1] $row[3] $row[4] $row[6] บาท</option>";
        }
        ?>
    </select><br>
    <button type="submit">ใช้หมดแล้ว</button>
</form>
