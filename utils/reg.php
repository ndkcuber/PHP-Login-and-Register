<?php
    // handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // validate input
      $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      // check if username already exists in the database
      include "database.php";
      $sql = "SELECT username FROM logindb WHERE username='".$username."'";
      $query = mysqli_query($db_connect, $sql);
      if ($username == "") {
        $response = [
          'status' => 'failed',
          'message' => 'Chưa nhập đủ thông tin'
        ];
        echo json_encode($response);
        exit;
      }
      elseif ($password == "") {
          $response = [
            'status' => 'failed',
            'message' => 'Chưa nhập đủ thông tin'
          ];
          echo json_encode($response);
          exit;
        }
       elseif ($fullname == "") {
          $response = [
            'status' => 'failed',
            'message' => 'Chưa nhập đủ thông tin'
          ];
          echo json_encode($response);
          exit;
      } else{
          if (!$query) {
            // handle SQL error
            $response = [
              'status' => 'failed',
              'message' => 'Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu'
            ];
            echo json_encode($response);
            exit;
          }
          $count = mysqli_num_rows($query);
          if ($count > 0) {
            // username already exists, show error message
            $response = [
              'status' => 'failed',
              'message' => 'Tên người dùng tồn tại'
            ];
            echo json_encode($response);
          } else {
            // insert new user into the database
            $hash = password_hash($password, PASSWORD_DEFAULT); // hash password
            $sql = "INSERT INTO `logindb`(`username`, `password`, `fullname`) VALUES ('".$username."','".$hash."','".$fullname."')";
            $query = mysqli_query($db_connect, $sql);
            if (!$query) {
              // handle SQL error
              $response = [
                'status' => 'failed',
                'message' => 'Đã xảy ra lỗi khi chèn dữ liệu vào cơ sở dữ liệu'
              ];
              echo json_encode($response);
              exit;
            }
            // show success message
            $response = [
              'status' => 'success',
              'message' => 'Đăng kí thành công!'
            ];
            echo json_encode($response);
          }
        }        
      }
      
?>
