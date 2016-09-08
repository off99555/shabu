<!DOCTYPE html>
<html lang="en">
<header>
    <?php require 'global_settings.php'; ?>
    <meta charset="UTF-8">
    <title><?php echo $TITLE; ?></title>
    <script>
        var MATERIAL_TAB = 0;
        var ORDERING_TAB = 1;
        var SUPPLIER_TAB = 2;
        var EMPLOYEE_TAB = 3;
        var ASSET_TAB = 5;
        var REPAIRING_TAB = 6;
        var MEMBERCARD_TAB = 8;
        var RECEIPT_TAB = 9;
        var PROMOTION_TAB = 10;
        $(function () {
            $.datetimepicker.setLocale('th');
            $(".datetimepicker").datetimepicker({
                mask: true,
                format: 'Y/m/d H:i'
            });
            $(".datepicker").datetimepicker({
                mask: true,
                timepicker: false,
                format: 'Y/m/d'
            });
            $("#tabs, #database").tabs({
                collapsible: true,
                show: 'slideDown',
                hide: 'slideUp',
            });
            $(".employee_id").change(function () {
                $("#database").tabs("option", "active", EMPLOYEE_TAB);
            });
            $(".supplier_id").change(function () {
                $("#database").tabs("option", "active", SUPPLIER_TAB);
            });
            $(".order_id").change(function () {
                $("#database").tabs("option", "active", ORDERING_TAB);
            });
            $(".asset_id").change(function () {
                $("#database").tabs("option", "active", ASSET_TAB);
            });
            $(".repair_id").change(function () {
                $("#database").tabs("option", "active", REPAIRING_TAB);
            });
            $(".membercard_id").change(function () {
                $("#database").tabs("option", "active", MEMBERCARD_TAB);
            });
            $(".receipt_id").change(function () {
                $("#database").tabs("option", "active", RECEIPT_TAB);
            });
            $(".promotion_id").change(function () {
                $("#database").tabs("option", "active", PROMOTION_TAB);
            });
            $(".hour_of_day").spinner({
                min: 0,
                max: 23
            }).attr('title', 'ต้องเป็นค่าในช่วง [0, 24)');
        });
    </script>
</header>
<body>
<?php require 'header.php' ?>
<h1>การจัดการร้าน</h1>
<div id="tabs">
    <ul>
        <li><a href="#tab-1">สั่งซื้อวัตถุดิบ</a></li>
        <li><a href="#tab-2" title="ตรวจสอบการสั่งซื้อวัตถุดิบที่ยังไม่ได้มาส่งหรือกำลังมาส่ง">เช็คการสั่งซื้อ</a></li>
        <li><a href="#tab-3">การใช้วัตถุดิบรายวัน</a></li>
        <li><a href="#tab-4">เวลาการทำงาน</a></li>
        <li><a href="#tab-5">การซ่อมแซมทรัพย์สิน</a></li>
        <li><a href="#tab-6">ใบเสร็จ</a></li>
    </ul>
    <div id="tab-1">
        <?php require 'material/index.php'; ?>
    </div>
    <div id="tab-2">
        <?php require 'material/check.php'; ?>
    </div>
    <div id="tab-3">
        <?php require 'material/daily_usage.php'; ?>
    </div>
    <div id="tab-4">
        <?php require 'employee/plan.php'; ?>
    </div>
    <div id="tab-5">
        <?php require 'asset/fix.php'; ?>
    </div>
    <div id="tab-6">
        <?php require 'receipt/index.php'; ?>
    </div>
</div>
<h1>ตารางฐานข้อมูล</h1>
<div id="database">
    <ul>
        <li><a href="#material-tab">วัตถุดิบ</a></li>
        <li><a href="#ordering-tab">ประวัติการสั่งซื้อวัตถุดิบ</a></li>
        <li><a href="#supplier-tab">ผู้ผลิต</a></li>
        <li><a href="#employee-tab">พนักงาน</a></li>
        <li><a href="#daily-usage-tab">การใช้วัตถุดิบรายวัน</a></li>
        <li><a href="#asset-tab">ทรัพย์สิน</a></li>
        <li><a href="#repairing-tab">การซ่อมแซม</a></li>
        <li><a href="#energy-consumption-tab">การใช้พลังงานรายวัน</a></li>
        <li><a href="#membercard-tab">บัตรสมาชิก</a></li>
        <li><a href="#receipt-tab">ใบเสร็จ</a></li>
        <li><a href="#promotion-tab">โปรโมชัน</a></li>
    </ul>
    <?php
    echo "<div id='material-tab'>";
    print_table("material", "material_id", array("รหัสวัตถุดิบ", "ชื่อ", "ชนิด", "ปริมาณที่มี", "หน่วย", "ที่เก็บ"));
    echo "</div>";
    echo "<div id ='ordering-tab'>";
    print_table("ordering", "order_id", array("รหัสการสั่งซื้อ", "ID วัตถุดิบ", "ID ผู้ผลิต", "ID พนักงาน", "จำนวนสั่งซื้อ", "ค่าใช้จ่าย", "วันที่สั่งซื้อ", "วันที่มาส่ง", "วันหมดอายุ", "ใช้หมดหรือยัง?"));
    echo "</div>";
    echo "<div id='supplier-tab'>";
    print_table("supplier", "supplier_id", array("รหัสผู้ผลิต", "ชื่อผู้ผลิต", "เบอร์โทร", "FAX", "ที่อยู่"));
    echo "</div>";
    echo "<div id='employee-tab'>";
    print_table("employee", "employee_id", array("รหัสพนักงาน", "ชื่อจริง", "นามสกุล", "ตำแหน่ง", "วันเริ่มงาน", "เลขบัญชี", "รหัสประกันสังคม", "สถานะ"));
    echo "</div>";
    echo "<div id='daily-usage-tab'>";
    print_table("daily_usage", 'none', array("รหัสวัตถุดิบ", "วันที่", "ปริมาณที่ใช้", "ปริมาณที่เสีย", "ปริมาณที่เหลือ", "รหัสพนักงาน"));
    echo "</div>";
    echo "<div id='asset-tab'>";
    print_table("asset", 'asset_id', array("รหัสทรัพย์สิน", "ชื่อ", "(พัง||ชำรุด||เสียหาย) อยู่หรือเปล่า?", "วันที่เริ่มใช้งาน"));
    echo "</div>";
    echo "<div id='repairing-tab'>";
    print_table("repairing", 'repair_id', array("รหัสการซ่อม", "วันที่แจ้งซ่อม", "วันที่ได้ซ่อม", "รหัสผู้ผลิต (ช่าง)", "รหัสทรัพย์สิน", "รหัสพนักงาน", "ราคาซ่อม", "คำอธิบาย"));
    echo "</div>";
    echo "<div id='energy-consumption-tab'>";
    print_table("energy_consumption", 'examine_date', array("วันที่บันทึกผล", "การใช้ไฟฟ้า(บาท)", "การใช้แก๊ส(บาท)", "การใช้น้ำ(บาท)", "รหัสพนักงาน"));
    echo "</div>";
    echo "<div id='membercard-tab'>";
    print_table("membercard", 'membercard_id', array("รหัสบัตรสมาชิก", "ชื่อสมาชิก", "เบอร์โทรฯ", "วันหมดอายุ"));
    echo "</div>";
    echo "<div id='receipt-tab'>";
    print_table("receipt", 'receipt_id', array("รหัสใบเสร็จ", "รหัสพนักงาน", "ราคารวม", "ค่าปรับ", "ส่วนลดรวม", "ราคาสุทธิ", "รหัสบัตรสมาชิก", "วันที่", "วิธีการจ่ายเงิน", "จ่ายเงินแล้วหรือยัง?"));
    echo "</div>";
    echo "<div id='promotion-tab'>";
    print_table("temporal_promotion", 'promotion_id', array("รหัสโปรโมชัน", "เงื่อนไข", "ชนิด", "ค่าโปรโมชัน", "วันที่เริ่ม", "วันที่สิ้นสุด"));
    echo "</div>";
    ?>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>
