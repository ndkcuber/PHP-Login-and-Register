<?php
    // handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // validate input
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // check if username already exists in the database
        include "database.php";
        $sql = "SELECT password FROM logindb WHERE username='".$username."'";
        $query = mysqli_query($db_connect, $sql);
        if (empty($username) || empty($password)) {
            $response = [
                'status' => 'failed',
                'message' => 'Chưa nhập đủ thông tin'
            ];
            echo json_encode($response);
            exit;
        } elseif (!$query) {
            // handle SQL error
            $response = [
                'status' => 'failed',
                'message' => 'Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu'
            ];
            echo json_encode($response);
            exit;
        } else {
            $count = mysqli_num_rows($query);
            if ($count <= 0) {
                // username does not exist in the database
                $response = [
                    'status' => 'failed',
                    'message' => 'Sai tên người dùng hoặc mật khẩu'
                ];
                echo json_encode($response);
                exit;
            } else {
                // verify password
                $row = mysqli_fetch_array($query)['password'];
                if (password_verify($password, $row)) {
                    // show success message
                    $response = [
                        'status' => 'success',
                        'message' => 'Đăng nhập thành công!'
                    ];
                    setcookie("username", $username, time() + (86400), "/"); // 86400 = 1 day
                    echo json_encode($response);
                    header("Location: /index.php");
                    exit();
                } else {
                    // incorrect password
                    $response = [
                        'status' => 'failed',
                        'message' => 'Sai tên người dùng hoặc mật khẩu'
                    ];
                    echo json_encode($response);
                    exit();
                }
            }
        }
    }
?>
