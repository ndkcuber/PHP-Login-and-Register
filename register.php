 <!DOCTYPE html>
 <html>
 <head>
 <?php 
	include './utils/database.php';
	include './utils/bootstrap.html';
	include './utils/navbar.php';

 ?>
 	<meta charset="utf-8">
 	<link rel="stylesheet" type="text/css" href="/style.css">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Đăng kí</title>
 </head>
 <body>
    <div class="container">
         <div class="container card mt-4" data-bs-theme="dark">
            <h1 class="mt-4 mx-4 text-center">Đăng kí</h1>
            <form class="m-5" id="user-register" data-bs-theme="dark" onsubmit="">
              <div class="mb-3">
                <label for="fullname" class="form-label">Họ và tên</label>
                <input type="text" name="fullname" class="form-control">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Tên người dùng</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="mb-3 form-check">
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registeruser">Đăng kí</button>
              </div>
            </form> 
        </div>   
    </div>
    <script>
      const form = document.getElementById('user-register');
      form.addEventListener('submit', function(event) {
        event.preventDefault(); // prevent page reload

        const formData = new FormData(form); // serialize form data

        const xhr = new XMLHttpRequest(); // create new request
        xhr.open('POST', './utils/reg.php'); // set endpoint
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText); // parse JSON response
            // update HTML elements with response data
            document.getElementById('message').textContent = response.message;
            document.getElementById('status').textContent = response.status;
          }
        };
        xhr.send(formData); // send form data
      });
    </script>
    <div class="modal fade" id="registeruser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="message"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
 </body>
 </html>