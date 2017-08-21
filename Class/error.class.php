<?php
class Error
{

    public function CheckError()
    {
        $error = array();
        $data = array();
        if (isset($_POST['submit'])) {
            $data['name'] = isset($_POST['MaMH']) ? $_POST['MaMH'] : '';
            $data['mail'] = isset($_POST['TenMH']) ? $_POST['TenMH'] : '';
            $data['sdt'] = isset($_POST['SoTiet']) ? $_POST['SoTiet'] : '';
        }

        if (empty($data['MaMH'])) {
            $error['MaMH'] = 'Bạn chưa nhập mã môn học';
        }

        if (empty($data['SoTiet'])) {
            $error['SoTiet'] = 'Nhập số tiết';
        }
        if (empty($data['TenMH'])) {

            $error['TenMH'] = 'Chưa có tên môn học';
        } else {
            if (strlen($data['sdt']) <=50) {
                $error['sdt'] = 'Quá 50 ký tự';
            }
        }

        return $error;
    }

}
?>
?>