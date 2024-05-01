<?php
session_start();
if(isset($_SESSION["admin_id"])){
    $mysqli = require __DIR__ . "/admindb.php";
    $sql = "SELECT * FROM admin 
          WHERE id = {$_SESSION["admin_id"]}";
    $result = $mysqli->query($sql);
    $admin = $result->fetch_assoc();
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminportal.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<section class="main-container">
      <div class="options-container">
            <div class="admin-image-container">
                <div class="admin-image">
                <i class="fa-solid fa-user"></i>
                </div>
                <div class="name">
                    <span>Hello, Admin</span>
                </div>
            </div>

            <div class="options">
                <div class="dashboard">
                <i class="fa-solid fa-house"></i>
                    <div class="custom-links" onclick="changePage('dashboard')">Dashboard</div>
                    
                </div>
                
                <div class="users">
                <i class="fa-solid fa-users"></i>
                <div class="custom-links" onclick="changePage('user')">users</div>
                </div>

                <div class="contents">
                <i class="fa-solid fa-table-cells-large"></i>
                <div class="custom-links" onclick="changePage('contents')">Contents</div>
               </div>
               <div class="logo"></div>
            </div>
</div>
<div class="content-container">
<header>
    <div class="nav-bar">
        <div class="nav-container">
        
        <div class="admin-profile">
        <i class="fa-solid fa-right-from-bracket"></i>
        </div>
      </div>

    </div>
  
        <div class="admin-menu">
        <div class="admin-name">
          <?php if(isset($admin)): ?>
            <p>Hello, <?= htmlspecialchars($admin['username']) ?>!</p>
            
        </div>

     <div class="logout">
         <a href="adminlogout.php">signout</a>
         <?php else: header("Location: admin.php"); ?>
         <?php endif; ?>
     </div>
    </div>
  </header>
  <div class="contain-pages">
        <div class="contain-pages-dashboard active">
            <div class="contain-page_contents" >
                <div class="data-dashboard-container">
                <i class="fa-solid fa-users"></i>
                    <h4>Total Users</h4>
                    <h3 class="totalUser"></h3>

                    
                </div>
               
                <div class="data-dashboard-container">
                <i class="fa-solid fa-table-cells-large"></i>
                <h4>Total Contents</h4>
                    <h3 class="totalContents"></h3>
                </div>
            </div>
        </div>
        <div class="contain-page contain-pages-user">
        <div class="contain-page_contents">

        <div class="data-user-container">
        </div>
           
        </div>
        </div>
        <div class="contain-page contain-pages-contents">
        <div class="contain-page_contents">
            contents
        </div>
            <div>
  </div>
</div>


</section>


  <script>
      document.addEventListener("DOMContentLoaded", () => {
          const menuContainer = document.querySelector(".admin-profile");
          const adminMenu = document.querySelector(".admin-menu");

          menuContainer.addEventListener("click", () =>{
              adminMenu.classList.toggle("show");
          })

      })
        function changePage(pageName="dashboard") {
            console.log(pageName)
            switch (pageName) {
                case 'dashboard':
                    document.querySelector(".contain-pages-dashboard").classList.add("active")
                    document.querySelector(".contain-pages-user").classList.remove("active")
                    document.querySelector(".contain-pages-contents").classList.remove("active")
                    break;
                case 'user':
                    document.querySelector(".contain-pages-dashboard").classList.remove("active")
                    document.querySelector(".contain-pages-user").classList.add("active")
                    document.querySelector(".contain-pages-contents").classList.remove("active")
                break;
                case 'contents':
                    document.querySelector(".contain-pages-dashboard").classList.remove("active")
                    document.querySelector(".contain-pages-user").classList.remove("active")
                    document.querySelector(".contain-pages-contents").classList.add("active")
                    break;
        
                default:
                    break;
            }
        }

        //dashboard
        fetch('fetch_data.php')
        .then((response) => {
            return response.json();
        }).then( (data) => {
           return data;
        }).then((data2) => {
            let totalUsers = 0
            data2.forEach(test => {
                totalUsers ++;
            });
        document.querySelector('.totalUser').innerHTML = `${totalUsers}`;

         }).catch((error) => {
            console.log(error);
        })

        fetch('fetch_content.php')
        .then( (response) => {
           return response.json();
        }).then((data) => {
            return data;
        }).then( (data2) => {
            let totalContent = 0;
        data2.forEach(test => {
            totalContent ++;
           })
           document.querySelector('.totalContents').innerHTML = `${totalContent}`;
        }) 

        //users
        fetch('fetch_data.php')
        .then((response) => {
            return response.json();
        }).then( (data) => {
           return data;
        }).then((data2) => {
            let serialNumber = 1;
        
            let tableData = `<table>
                                <thead>
                                    <th>S.N</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>`;

            
            
            data2.forEach( (userInfo) => {
                            tableData += `<tr>
                                                <td>${serialNumber}</td>
                                                <td>${userInfo.id}</td>
                                                <td>${userInfo.name}</td>
                                                <td>${userInfo.email}</td> 
                                                <td>
                                                <button class="edit-btn" data-id = "${userInfo.id}">Edit</button>
                                                <button class="delete-btn" data-id = "${userInfo.id}">Delete</button>
                                                </td>
                                            
                                          </tr>`;
                                serialNumber ++;
            })

            tableData += `</tbody>
                          </table>`;

        document.querySelector('.data-user-container').innerHTML = tableData;

        document.querySelectorAll('.edit-btn').forEach((button) => {
            button.addEventListener('click', editUser)
        })

        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', deleteUser)
        })

        function deleteUser(event){
            const userId = event.target.dataset.id;
             if(confirm("Are you sure want to delete the user?")){
                fetch('deleteUser.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ userId: userId })
                    
                
                })
                .then((response) => {
                    return response.json();
                }).then((data) => {
                    console.log(data.message)
                }).catch( (error) => {
                    console.log("Error: ", error)
                });
            } 
            console.log('Delete user with Id: ' ,userId);
         
        }
        
         function editUser(event){
            const userId = event.target.dataset.id;
            console.log('Edit user with Id: ' , userId);
        } 
 


   
        })

       

        


      
  </script>
</body>
</html>


