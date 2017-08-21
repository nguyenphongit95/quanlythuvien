<?php
require_once 'dbCon.class.php';

Class Lession extends Connection
{
    public function ListLesson()
    {
        $conn = $this->db_Con();
        $sql = "SELECT id, MaMH, TenMH, SoTiet,img FROM lesson";
        $result = $conn->query($sql);
        $conn->close();
        $list = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list [] = $row;
            }
        }

        return $list;
    }

    /**
     * @param $maMH
     * @return array
     */
    public function getByMaMH($maMH)
    {
        $conn = $this->db_Con();
        $sql = "SELECT MaMH, TenMH, SoTiet, id FROM lesson WHERE MaMH = '$maMH'";
        $result = $conn->query($sql);
        $conn->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return [];
    }

    public function getById($id)
    {
        $conn = $this->db_Con();
        $sql = "SELECT MaMH, TenMH, SoTiet, img FROM lesson WHERE id = $id";
        $result = $conn->query($sql);
        $conn->close();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return [];
    }

    public function insert($MaMH, $TenMH, $SoTiet,$destination)
    {
        $conn = $this->db_Con();

        $sql = "INSERT INTO lesson (MaMH, TenMH, SoTiet,img) VALUES ('$MaMH', '$TenMH', '$SoTiet','$destination'  )";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return $conn->error;
        }
    }

    public function delete($id)
    {
        $conn = $this->db_Con();
        $sql = "DELETE FROM lesson WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return $conn->error;
        }
    }

    public function edit($MaMH, $TenMH, $SoTiet, $imagePath = '', $id )
    {
        $conn = $this->db_Con();
        if($imagePath) {
            $imageSetValue = ", img = '$imagePath'";
        } else {
            $imageSetValue = '';
        }
        $sql = "UPDATE lesson SET MaMH='$MaMH', TenMH='$TenMH', SoTiet='$SoTiet' $imageSetValue  WHERE id=$id ";

        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return $conn->error;
        }
    }



    public function checkError($MaMH, $TenMH, $SoTiet, $id = null)
    {
        $error = array();
        $data = array();
        if (isset($_POST['submit'])) {
            $data['MaMH'] = $MaMH ? $MaMH : '';
            $data['SoTiet'] = $SoTiet ? $SoTiet : '';
            $data['TenMH'] = $TenMH ? $TenMH : '';
        }

        $pattern = '/^[0-9]{3,7}$/';

        if (empty($data['MaMH'])) {
            $error['MaMH'] = 'Bạn chưa nhập mã môn học';
        } elseif (!preg_match($pattern, $data['MaMH'])) {
            $error['MaMH'] = 'Mã từ 3 đến 7 chữ số';
        } else {
            //lay du lieu Ma MH, dung cau lenh SELECT
            $existedRow = $this->getByMaMH($data['MaMH']);
            //can dung select, tim xem trong bang da co 1 row nao co gia tri MaMH = giong nhau
            if(!empty($existedRow)) {
                if($existedRow['id'] != $id) {
                    $error['MaMH']= "Mã môn đã tồn tại";
                }
            }
        }

        if (empty($data['SoTiet'])) {
            $error['SoTiet'] = 'Nhập số tiết';
        }
        elseif (!is_numeric($data['SoTiet'])) {
                $error['SoTiet'] = 'Phải nhập số';
            }
        elseif (($data['SoTiet']) < 16 || ($data['SoTiet']) > 40){
            $error['SoTiet'] = 'Số tiết trong khoảng 16-40';
        }

        if (empty($data['TenMH'])) {

            $error['TenMH'] = 'Chưa có tên môn học';
        } else {
            if (strlen($data['TenMH']) >=50) {
                $error['TenMH'] = 'Tên môn không vượt quá 50 ký tự';
            }
        }

        return $error;
    }

}

?>