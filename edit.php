<?php
require_once 'Class/lession.class.php';
require_once 'helper/url_helper.php';
if($_POST) {
    $id = $_GET['id'];
    $editObject = new Lession();
    $error = $editObject->checkError($_POST['MaMH'], $_POST['TenMH'], $_POST['SoTiet'], $id);

    if(empty($error)) {
        $destination = '';

        if($_FILES['file']['name'] != NULL){
            if($_FILES['file']['type'] ==  "image/jpeg"){
                if($_FILES['file']['size'] > 1048576){
                    echo "File không được lớn hơn 1mb";
                }else{
                    $path = "upload/";
                    $tmp_name = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $type = $_FILES['file']['type'];
                    $size = $_FILES['file']['size'];

                    $destination = $path.$name;
                    move_uploaded_file($tmp_name, $destination);
                }
            } else {
                die("Kiểu file không hợp lệ");
            }
        }

        //dang bo qua buoc check exist file
        $editObject->edit($_POST['MaMH'], $_POST['TenMH'], $_POST['SoTiet'], $destination, $id);
        header('Location: index.php');
    };
}
$id = $_GET['id'];
$ls = (new Lession())->getById($id);
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="frm" style="width: 400px; margin: 15px auto;">
    <form action="#" method="POST" enctype="multipart/form-data" style="border: 1px solid gray; width: 350px; height: 250px; padding: 10px;">
        <h3 style="text-align: center; ">SỬA THÔNG TIN MÔN HỌC</h3>
        <hr>
        <br>
        <label for="mmh">MÃ MÔN :</label>
        <input type="text" name="MaMH" value="<?php echo $ls['MaMH'] ;?>"><br>
        <?php echo isset($error['MaMH']) ? $error['MaMH'] : '';?><br><br>
        <label for="tmh">TÊN MÔN :</label>
        <input type="text" name="TenMH" value="<?php echo $ls['TenMH'];?>">
        <?php echo isset($error['TenMH']) ? $error['TenMH'] : ''; ?><br><br>
        <label for="st">SỐ TIẾT :</label>
        <input type="number" name="SoTiet" value="<?php echo $ls['SoTiet'] ;?>"><br><br>
        <?php echo isset($error['SoTiet']) ? $error['SoTiet'] : ''; ?><br>
        <?php if($ls['img']): ?>
        <img  src="<?php echo BASE_URL . '/' . $ls['img'] ?>"  height="40px">
        <?php endif;?>
        <input type="file" name="file">

        <br>
        <br>
        <input type="submit" value="Sửa" name="submit">
    </form>
</div>
</body>
</html>