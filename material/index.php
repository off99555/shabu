<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 27-May-16
 * Time: 07:13
 */
?>
<script>
    $(function () {
        $(".material_id").change(function () {
            $("#database").tabs("option", "active", MATERIAL_TAB);
        });
    });
</script>
<h2>สั่งทันทีตอนนี้</h2>
<form action="material/order.php" method="post">
    <label for="material_id">วัตถุดิบ:</label>
    <select name="material_id" class="material_id" id="material_id">
        <option value=""></option>
        <?php
        $sql = "SELECT MATERIAL_ID, MATERIAL_NAME FROM material";
        $rows = $conn->query($sql);
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>

    <label for="supplier_id">ผู้ผลิต:</label>
    <select name="supplier_id" class="supplier_id" id="supplier_id">
        <option value=""></option>
        <?php
        $sql = "SELECT SUPPLIER_ID, SUPPLIER_NAME, SUPPLIER_PHONE FROM supplier";
        $rows = $conn->query($sql);
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='$row[2]'>$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>

    <label for="employee_id">รหัสพนักงาน:</label>
    <input type="text" name="employee_id" readonly title="พนักงานที่ล็อกอินอยู่เท่านั้น"
           value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>"><br>

    <label for="order_amount">ปริมาณการสั่งซื้อ:</label>
    <input type="text" name="order_amount" id="order_amount"><br>

    <label for="order_cost">ราคารวม:</label>
    <input type="text" name="order_cost" id="order_cost"><br>

    <label for="order_date">วันที่สั่งซื้อ:</label>
    <input type="text" name="order_date" id="order_date" value="<?php echo date("Y/m/d"); ?>" disabled><br>
    <!--    <label for="order_arrived_date">วันที่จะมาส่ง</label>-->
    <!--    <input type="text" name="order_arrived_date" id="order_arrived_date"><br>-->

    <button type="submit">สั่งเลย!</button>
</form>
