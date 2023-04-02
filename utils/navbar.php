<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/index.php">Trang chủ</a>
        </li>
      </ul>
      <?php 
          if (!isset($_COOKIE['username'])) {
            echo "<ul class=\"navbar-nav ms-auto\">
                          <li class=\"nav-item\">
                            <a class=\"nav-link\" aria-current=\"page\" href=\"/login.php\">Đăng nhập</a>
                          </li>
                          <li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"register.php\">Đăng kí</a>
                          </li>
                        </ul>";
          } else{
            echo "<ul class=\"navbar-nav ms-auto\">
                          <li class=\"nav-item\">
                            <a class=\"nav-link\" aria-current=\"page\" href=\"/dashboard.php\">Dashboard</a>
                          </li>
                        </ul>";
          }
       ?>
      
    </div>
  </div>
</nav>