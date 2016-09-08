<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 07:39
 */
$sql = "SELECT MATERIAL_ID, MATERIAL_NAME
        FROM MATERIAL
        WHERE MATERIAL_ID NOT IN (SELECT MATERIAL_ID FROM DAILY_USAGE WHERE USAGE_DATE = CURRENT_DATE)";
$rows = $conn->query($sql);
echo $conn->error;
?>
<h2>บันทึกการหมดไปของวัตถุดิบแต่ละอย่างของวันนี้ (ควรทำหลังสิ้นสุดวัน)</h2>
<form action="/shabu/material/daily_usage_submit.php" method="post">
    <label for="material_id">วัตถุดิบ:</label>
    <select name="material_id" id="material_id" class="material_id">
        <option value=""></option>
        <?php
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
        }
        $sql = "SELECT MATERIAL_ID, MATERIAL_NAME, USAGE_AMOUNT, MATERIAL_UNIT, EXPIRED_AMOUNT, REMAINING_AMOUNT
                    FROM DAILY_USAGE NATURAL JOIN MATERIAL
                    WHERE USAGE_DATE = CURRENT_DATE";
        $rows = $conn->query($sql);
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='ใช้ไป $row[2] $row[3] เสียไป $row[4] $row[3] เหลือ $row[5] $row[3]'
            disabled>$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>

    <label for="usage_date">วันที่:</label>
    <input type="text" name="usage_date" id="usage_date" value="<?php echo date('Y/m/d'); ?>" disabled><br>

    <label for="usage_amount">ปริมาณที่ใช้:</label>
    <input type="text" name="usage_amount" id="usage_amount"><br>

    <label for="expired_amount">ปริมาณที่หมดอายุ:</label>
    <input type="text" name="expired_amount" id="expired_amount"><br>

    <!--    <label for="remaining_amount">ปริมาณที่เหลือ:</label>-->
    <!--    <input type="text" name="remaining_amount" id="remaining_amount"><br>-->

    <label for="employee_id">รหัสพนักงาน:</label>
    <input type="text" name="employee_id" id="employee_id" title="พนักงานที่ล็อกอินอยู่เท่านั้น"
           value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>" readonly><br>
    <button type="submit" title="กรุณาเอาให้ชัวร์ แก้ไม่ได้นะ">บันทึกของวันนี้</button>
</form>
