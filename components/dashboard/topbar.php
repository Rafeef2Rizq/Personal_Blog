  
   <!-- Topbar -->
   <nav id="topbar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
       <div class="container-fluid p-lg-4">
           <button class="btn btn-sm p-0" id="sidebarToggle">
               <iconify-icon icon="mdi:hamburger-menu-back" width="24" height="24"></iconify-icon>
           </button>

           <div class="d-flex align-items-center">
               <!-- Search -->
               <div class="me-3 position-relative">
                   <iconify-icon icon="material-symbols:search" width="20" height="20"
                       class="position-absolute top-50 start-0 translate-middle-y ms-2"></iconify-icon>
                   <input type="text" class="form-control ps-4 shadow-none" placeholder="Search..."
                       style="width: 120px;">
               </div>

             

               <!-- Notifications Dropdown -->
               <div class="dropdown me-3">
                   <a class="position-relative" href="#" role="button" id="notificationsDropdown"
                       data-bs-toggle="dropdown" aria-expanded="false">
                       <iconify-icon icon="mdi:bell-outline" width="24" height="24"></iconify-icon>
                       <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                           8+
                           <span class="visually-hidden">unread notifications</span>
                       </span>
                   </a>
                   <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notificationsDropdown"
                       style="width: 320px;">
                       <li
                           class="dropdown-header bg-light py-2 px-3 d-flex justify-content-between align-items-center">
                           <span>Notifications</span>
                           <a href="#" class="small">Clear all</a>
                       </li>
                       <li class="px-2 py-1">
                           <a href="#" class="dropdown-item d-flex align-items-start py-2">
                               <div class="me-2 text-success">
                                   <iconify-icon icon="mdi:check-circle-outline" width="24"
                                       height="24"></iconify-icon>
                               </div>
                               <div>
                                   <p class="mb-0">Your order #12345 has been shipped</p>
                                   <small class="text-muted">Just now</small>
                               </div>
                           </a>
                       </li>
                       <li class="px-2 py-1">
                           <a href="#" class="dropdown-item d-flex align-items-start py-2">
                               <div class="me-2 text-warning">
                                   <iconify-icon icon="mdi:alert-circle-outline" width="24"
                                       height="24"></iconify-icon>
                               </div>
                               <div>
                                   <p class="mb-0">System maintenance scheduled for tonight</p>
                                   <small class="text-muted">30 minutes ago</small>
                               </div>
                           </a>
                       </li>
                       <li class="px-2 py-1">
                           <a href="#" class="dropdown-item d-flex align-items-start py-2">
                               <div class="me-2 text-info">
                                   <iconify-icon icon="mdi:account-plus" width="24" height="24"></iconify-icon>
                               </div>
                               <div>
                                   <p class="mb-0">3 new team members joined</p>
                                   <small class="text-muted">2 hours ago</small>
                               </div>
                           </a>
                       </li>
                       <li class="dropdown-footer text-center py-2">
                           <a href="#" class="text-primary">View all notifications</a>
                       </li>
                   </ul>
               </div>

               <!-- User Profile Dropdown -->
               <div class="dropdown">
                   <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" role="button"
                       id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                       <img src="images/team1.jpg" class="rounded-circle me-2" width="32" height="32">
                   </a>
                   <ul class="dropdown-menu dropdown-menu-end">
                       <li>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                               <iconify-icon icon="mdi:account-outline" class="me-2" width="20"
                                   height="20"></iconify-icon>
                               Profile
                           </a>
                       </li>
                      
                    
                       <li>
                           <hr class="dropdown-divider">
                       </li>
                       <li>
                           <a class="dropdown-item d-flex align-items-center" href="../public/logout.php">
                               <iconify-icon icon="mdi:logout-variant" class="me-2" width="20"
                                   height="20"></iconify-icon>
                               Logout
                           </a>
                       </li>
                   </ul>
               </div>
           </div>
       </div>
   </nav>