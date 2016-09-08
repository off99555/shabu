<?php
/**
 * Created by PhpStorm.
 * User: off99555
 * Date: 31-May-16
 * Time: 14:47
 */
?>
<?php if (isset($_GET['receipt_id'])): ?>
    <?php
    $receipt_id = $_GET['receipt_id'];
    $sql = "SELECT RECEIPT_ID, TOTAL_PRICE, LEFTOVER_FINE, TOTAL_DISCOUNT, NET_PRICE, MEMBERCARD_ID, RECEIPT_PAYTYPE, RECEIPT_PAID
            FROM RECEIPT WHERE RECEIPT_ID = $receipt_id";
    $receipt = $conn->query($sql)->fetch_row();
    $net = $receipt[4];
    $discount = 0;
    $disabled = $receipt[7] ? "disabled" : "";
    ?>
    <h2>ข้อมูลของใบเสร็จปัจจุบัน</h2>
    รหัสใบเสร็จ: <?php echo $receipt[0]; ?><br>
    ราคารวม: <?php echo $receipt[1]; ?><br>
    ค่าปรับ: <?php echo $receipt[2]; ?><br>
    ส่วนลดรวม: <?php echo $receipt[3]; ?><br>
    ราคาสุทธิ: <?php echo $net; ?><br>
    รหัสบัตรสมาชิก: <?php echo $receipt[5]; ?><br>
    <?php
    if (!is_null($receipt[5]) && !$receipt[7]) {
        $net *= 0.9;
        $net = (int)$net;
        $discount = $receipt[4] - $net;
        echo "ราคาที่จะต้องจ่ายหลังจากลดเพิ่มเติม 10% เนื่องจากมีบัตรสมาชิก: <b>$net</b> <br>";
    }
    ?>
    วิธีการจ่าย: <?php echo $receipt[6]; ?><br>
    จ่ายเงินหรือยัง? <?php echo $receipt[7] ? "จ่ายแล้ว" : "ยังไม่ได้จ่าย" ?><br>
    <form action="/shabu/receipt/pay.php" method="post">
        <input type="hidden" name="receipt_id" value="<?php echo $receipt_id; ?>">
        <input type="hidden" name="discount" value="<?php echo $discount; ?>">
        <button type="submit" <?php echo $disabled; ?>>ชำระเงิน</button>
    </form>

    <h2>เพิ่มจำนวนลูกค้า</h2>
    <?php
    print_table("person_price", "receipt_id", array("รหัสใบเสร็จ", "ชนิดลูกค้า", "จำนวนลูกค้า", "ราคารวม"), "*", 0, "WHERE RECEIPT_ID = '$receipt_id'");
    ?>
    <form action="/shabu/receipt/add_person.php" method="post">
        <label for="receipt_id">รหัสใบเสร็จ:</label>
        <input type="text" name="receipt_id" id="receipt_id" value="<?php echo $receipt_id; ?>" readonly><br>

        <label for="person_type">ชนิดลูกค้า:</label>
        <select name="person_type" id="person_type">
            <?php
            $sql = "SELECT PERSON_TYPE, PERSON_BILL_RATE, PERSON_START_HEIGHT, PERSON_END_HEIGHT
                    FROM PERSON_TYPE
                    WHERE PERSON_TYPE NOT IN (SELECT PERSON_TYPE FROM PERSON_PRICE WHERE RECEIPT_ID = $receipt_id)
                    ORDER BY PERSON_BILL_RATE DESC";
            $rows = $conn->query($sql);
            while ($row = $rows->fetch_row()) {
                echo "<option value=\"$row[0]\" title='สูง $row[2] ถึง $row[3]'>$row[0] - $row[1] บาท</option>";
            }
            ?>
        </select><br>

        <label for="total_person">จำนวนคน:</label>
        <input type="text" name="total_person" id="total_person"><br>
        <button type="submit" <?php echo $disabled; ?>>เพิ่ม</button>
    </form>

    <h2>เมนูเพิ่มเติม</h2>
    <?php
    print_table("extra_ordering", "none", array("รหัสใบเสร็จ", "รหัสเมนู", "จำนวนที่ซื้อ", "ราคารวม"), "*", 0, "WHERE RECEIPT_ID = '$receipt_id'");
    ?>
    <form action="/shabu/receipt/add_extra_order.php" method="post">
        <label for="receipt_id">รหัสใบเสร็จ:</label>
        <input type="text" name="receipt_id" id="receipt_id" value="<?php echo $receipt_id; ?>" readonly><br>

        <label for="menu_id">ชื่อเมนู:</label>
        <select name="menu_id" id="menu_id">
            <option value=""></option>
            <?php
            $sql = "SELECT MENU_ID, MENU_NAME, MENU_PRICE, MATERIAL_NAME
                    FROM EXTRA_MENU NATURAL JOIN MATERIAL
                    WHERE MENU_ID NOT IN (SELECT MENU_ID FROM EXTRA_ORDERING WHERE RECEIPT_ID = $receipt_id)";
            $rows = $conn->query($sql);
            while ($row = $rows->fetch_row()) {
                echo "<option value=\"$row[0]\" title='ทำมาจาก $row[3]'>$row[0] - $row[1] $row[2] บาท</option>";
            }
            ?>
        </select><br>

        <label for="order_amount">จำนวนที่สั่งเพิ่ม:</label>
        <input type="text" name="order_amount" id="order_amount"><br>

        <button type="submit"<?php echo $disabled; ?>>สั่งเพิ่ม</button>
    </form>

    <h2>ใช้โปรโมชัน(ที่ใช้ได้ในช่วงเวลาปัจจุบัน)</h2>
    <?php
    print_table("promotion_usage", "promotion_id", array("รหัสใบเสร็จ", "รหัสโปรโมชัน", "ส่วนลด"), "*", 0, "WHERE RECEIPT_ID = $receipt_id");
    ?>
    <form action="/shabu/receipt/add_promotion.php" method="post">
        <label for="receipt_id">รหัสใบเสร็จ:</label>
        <input type="text" name="receipt_id" id="receipt_id" value="<?php echo $receipt_id; ?>" readonly><br>

        <label for="promotion_id">โปรโมชันที่ใช้ได้:</label>
        <select name="promotion_id" id="promotion_id" class="promotion_id">
            <option value=""></option>
            <?php
            $sql = "SELECT PROMOTION_ID, PROMOTION_CRITERIA, PROMOTION_TYPE, PROMOTION_VALUE
                    FROM TEMPORAL_PROMOTION
                    WHERE CURRENT_TIMESTAMP BETWEEN PROMOTION_START_DATE AND PROMOTION_END_DATE
                    AND PROMOTION_ID NOT IN (SELECT PROMOTION_ID FROM PROMOTION_USAGE WHERE RECEIPT_ID = $receipt_id)";
            $rows = $conn->query($sql);
            while ($row = $rows->fetch_row()) {
                echo "<option value=\"$row[0]\" title='ลดราคา $row[2] $row[3]'>$row[0] - $row[1]</option>";
            }
            ?>
        </select><br>
        <button type="submit" <?php echo $disabled; ?>>Apply Promotion</button>
    </form>
<?php endif ?>
<h2>สร้างใบเสร็จใหม่</h2>
<form action="/shabu/receipt/create.php" method="post">
    <label for="employee_id">รหัสพนักงาน:</label>
    <input type="text" name="employee_id" id="employee_id" title="พนักงานที่ล็อกอินอยู่เท่านั้น"
           value="<?php if (isset($_COOKIE['employee_id'])) echo $_COOKIE["employee_id"]; ?>" readonly><br>

    <label for="leftover_fine">ค่าปรับกินเหลือ:</label>
    <input type="text" name="leftover_fine" id="leftover_fine"><br>

    <label for="receipt_paytype">วิธีการชำระเงิน:</label>
    <select name="receipt_paytype" id="receipt_paytype">
        <option value="CASH">CASH</option>
        <option value="CHECK">CHECK</option>
    </select><br>

    <label for="membercard_id">บัตรสมาชิก:</label>
    <select name="membercard_id" id="membercard_id" class="membercard_id">
        <option value=""></option>
        <?php
        $sql = "SELECT MEMBERCARD_ID, MEMBERCARD_NAME
                FROM MEMBERCARD";
        $rows = $conn->query($sql);
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
        }
        ?>
    </select><br>
    <button type="submit">สร้างเลยนะ</button>
</form>

<h2>เรียกดูใบเสร็จ</h2>
<form action="/shabu/index.php#tab-6" method="get">
    <?php
    $sql = "SELECT RECEIPT_ID, NET_PRICE, RECEIPT_PAID
            FROM RECEIPT
            ORDER BY RECEIPT_DATE DESC";
    $rows = $conn->query($sql);
    ?>
    <label for="receipt_id">รหัสใบเสร็จ</label>
    <select name="receipt_id" id="receipt_id" class="receipt_id">
        <option value=""></option>
        <?php
        while ($row = $rows->fetch_row()) {
            echo "<option value=\"$row[0]\" title='จ่ายยัง? $row[2]'>$row[0] - ราคาสุทธิ $row[1] บาท</option>";
        }
        ?>
    </select><br>
    <button type="submit">เรียกดูทันที</button>
</form>
