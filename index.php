<?php
include 'class/lession.class.php';
include 'helper/url_helper.php';
//include khac gi voi require, require khac gi require_once ?
$lessonObject = new Lession();
$monhoc = $lessonObject->ListLesson();

?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="content">
    <table class="tb" border="1px" align="center" width="500px" cellspacing="0">
        <tr><td colspan="5" align="center"><h3>THÔNG TIN MÔN HỌC</h3></td></tr>
        <tr>
            <td width="20%">MÃ MÔN HỌC</td>
            <td width="20%">TÊN MÔN HỌC</td>
            <td width="20%">SỐ TIẾT HỌC</td>
            <td width="20%">Img</td>
            <td width="20%">Edit/Delete</td>
        </tr>
        <?php foreach($monhoc as $a => $tenmonhoc): ?>
            <tr>
                <td>
                    <?php echo $tenmonhoc['MaMH'];?>
                </td>
                <td>
                    <?php echo $tenmonhoc['TenMH'];?>
                </td>
                <td>
                    <?php echo $tenmonhoc['SoTiet'];?>
                </td>
                <td>
                    <?php if($tenmonhoc['img']): ?>
                        <img  src="<?php echo BASE_URL . '/' . $tenmonhoc['img'] ?>"  height="40px" />
                    <?php endif;?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $tenmonhoc['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $tenmonhoc['id'] ?>" style="color: red">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="add">
        <a href="add.php" style="color: cornflowerblue;">Add</a>
    </div>
</div>
</body>
</html>
