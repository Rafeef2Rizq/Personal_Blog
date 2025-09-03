 <div id="sidebar" class="d-flex flex-column flex-shrink-0 text-white">
        <div class="p-3 d-flex align-items-center justify-content-between">
            <img src="../public/assets/dashboard/images/main-logo.png" class="img-fluid">
            <button class="btn btn-sm d-block d-lg-none" id="sidebarclose">
                <iconify-icon icon="mdi:hamburger-menu-back" class="text-white" width="24" height="24"></iconify-icon>
            </button>
        </div>

        <hr class="mt-0 mb-2">

        <ul class="nav flex-column mb-auto px-2">
            <li class="nav-item">
                <a href="/dashboard.php" class="nav-link sidebar-link py-3 active">
                    <iconify-icon icon="material-symbols:speed-outline" width="24" height="24"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <input type="checkbox" id="post" name="dropdowns">
                <label for="post" class="nav-link sidebar-link py-3 ">
                    <iconify-icon icon="cuida:package-outline" width="24" height="24"></iconify-icon>
                    post 
                    <iconify-icon id="downarrow" class="fa fa-angle-down" aria-hidden="true"
                        icon="material-symbols:arrow-drop-down-rounded" width="24" height="24"></iconify-icon>
                    <iconify-icon id="uparrow" class="fa fa-angle-down" aria-hidden="true"
                        icon="material-symbols:arrow-drop-up-rounded" width="24" height="24"></iconify-icon>
                </label>
                <ul class="drop">
                    <li>
                        <label class="py-2">
                            <input type="radio" id="productfirstelement" name="menu">
                            <a href="/view/posts/create.php" class="text-capitalize"> create post </a>
                        </label>
                    </li>
                    <li>
                        <label class="py-2">
                            <input type="radio" id="productsecondelement" name="menu">
                            <a href="/view/posts/index.php" class="text-capitalize"> List posts</a>
                        </label>
                    </li>
                  
                </ul>
            </li>
            <li class="nav-item">
                <input type="checkbox" id="category" name="dropdowns">
                <label for="category" class="nav-link sidebar-link py-3 ">
                    <iconify-icon icon="basil:layout-outline" width="24" height="24"></iconify-icon>
                    Category 
                    <iconify-icon id="downarrow" class="fa fa-angle-down" aria-hidden="true"
                        icon="material-symbols:arrow-drop-down-rounded" width="24" height="24"></iconify-icon>
                    <iconify-icon id="uparrow" class="fa fa-angle-down" aria-hidden="true"
                        icon="material-symbols:arrow-drop-up-rounded" width="24" height="24"></iconify-icon>
                </label>
                <ul class="drop">
                    <li>
                        <label class="py-2">
                            <input type="radio" id="categoryfirstelement" name="menu">
                            <a href="/view/category/create.php" class="text-capitalize"> New category </a>
                        </label>
                    </li>
                    <li>
                        <label class="py-2">
                            <input type="radio" id="categorysecondelement" name="menu">
                            <a href="/view/category/index.php" class="text-capitalize"> List categories </a>
                        </label>
                    </li>
                </ul>
            </li>
               <li class="nav-item">
                <a href="/index.php" class="nav-link sidebar-link py-3 active">
                    <iconify-icon icon="material-symbols:speed-outline" width="24" height="24"></iconify-icon>
                    Blog page
                </a>
            </li>
         
        </ul>
    </div>