
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body shadow sticky-top" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="assets/imgs/logo.png" alt="Logo_Eflyer">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="categories.php">
            <i class="fa-solid fa-list"></i>
            Collections
          </a>
        </li>
        <?php
            if(isset($_SESSION['auth']))
            {
        ?>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
            Pannier
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="my_order.php">
            <i class="fa-solid fa-cart-shopping"></i>
            Orders
          </a>
        </li>
        <li class="nav-item dropdown dropdown-menu-end text-white">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user fa-lg m-2">  </i><?= $_SESSION['auth_user']['name'];?>
          </a>
          <ul class="dropdown-menu">
            <?php
              if($_SESSION['role_as'] == 1)
                {
            ?>
              <li><a class="dropdown-item" href="admin/Dashboard.php"><i class="fa-solid fa-table-columns m-2"></i> Dashboard </a></li>
            <?php
                }
            ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-user-xmark m-2">  </i>Log Out</a></li>
          </ul>
        </li>
        <?php
            }
            else
            {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php"><i class="fa-solid fa-user-plus m-2"></i>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa-solid fa-user m-2"></i>Login</a>
                    </li>

                <?php
            }
        ?>
        </ul>
    </div>
    
  </div>
</nav>