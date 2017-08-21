<?php

require_once 'class/lession.class.php';

if($_POST) {
    $insertObject = new Lession();
    $errorValidation = $insertObject->checkError($_POST['MaMH'], $_POST['TenMH'], $_POST['SoTiet']);

    if(empty($errorValidation)) {
        try {
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
            $result = $insertObject->insert($_POST['MaMH'], $_POST['TenMH'], $_POST['SoTiet'], $destination);

            if($result !== TRUE) {
                throw new Exception($result);
            }
            header('Location: index.php');
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="frm" style="width: 350px; margin: 15px auto;">
    <form action="#" method="post" enctype="multipart/form-data" style="border: 1px solid gray; width: 300px; height: 200px; padding: 10px;">
        <h3 style="text-align: center;">THÊM MÔN HỌC</h3>
        <hr>
        <br>
        <label for="MaMH"> MÃ MÔN  :</label>
        <input type="text" name="MaMH"  value="<?php echo (isset($_POST) && isset($_POST['MaMH']) && $_POST['MaMH']) ? $_POST['MaMH'] : ''?>"/>
        <br><br>
        <?php echo isset($errorValidation['MaMH']) ? $errorValidation['MaMH'] : '';?><br>
        <label for="TenMH">TÊN MÔN:</label>
        <input type="text" name="TenMH" value="<?php echo (isset($_POST) && isset($_POST['TenMH']) && $_POST['TenMH']) ? $_POST['TenMH'] : ''?>"><br>
        <?php echo isset($errorValidation['TenMH']) ? $errorValidation['TenMH'] : '';?><br>
        <br><br>
        <label for="SoTiet">SỐ TIẾT :</label>
        <input type="text" name="SoTiet" value="<?php echo (isset($_POST) && isset($_POST['SoTiet']) && $_POST['SoTiet']) ? $_POST['SoTiet'] : ''?>"><br>
        <?php echo isset($errorValidation['SoTiet']) ? $errorValidation['SoTiet'] : '';?><br>
        <input type="file" name="file">

        <input type="submit" value="Thêm" name="submit">
    </form>
</div>
</body>
</html>
