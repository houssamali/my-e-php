<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">SHRWA</a>
      <button class="navbar-toggler btn btn-light bg-primary w-25" type="button"
       data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
       aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-center">Menu</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Houssam
            </a>
            
            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
              <li ><a class="dropdown-item text-success bg-dark" href="">View Website</a></li>
              <li><a class="dropdown-item text-success bg-dark" href="login.php">LogIn</a></li>
             <!---- <li><hr class="dropdown-dividertext-light bg-dark "></li>-->
              <li><a class="dropdown-item text-success bg-dark" href="logout.php">Logout</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="user.php">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Categories.php">Category</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="item.php?do=manage">Items</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
       
<form  action="user.php" method="post" class="d-flex" role="search">
        
        <input class="form-control me-2"  type="text"  name="name"
        placeholder="Search" aria-label="Search">
        <input type="submit" name="search" value="search">
         
      <!--<button class="btn btn-outline-success" name="search" type="submit">Search</button>-->

      </form>
       
      </div>
    </div>
  </nav>