<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <section class="main-container" >
   
        <div class="option-container">
            <div class="options">
                <div class="dashboard">
                    <div class="custom-links" onclick="changePage('dashboard')">dashboard</div>
                </div>
                <div class="users">
                <div class="custom-links" onclick="changePage('users')">users</div>
                </div>
                <div class="contents">
                <div class="custom-links" onclick="changePage('contents')">contents</div>
                </div>
            </div>
        </div>


        <div class="contain-container">
           <header>
                <div class="nav-bar-container">

                </div>
                </header>

                <div class="content-pages">
                    <div class="content-page-dashboard active">
                        <div class="content-page-contents">
                            dashboard
                        </div>
                    </div>
                    <div class="content-page contain-page-user">
                        <div class="content-page-contents">
                            user
                        </div>
                    </div>
                    <div class="content-page contain-page-contents">
                        <div class="content-page-contents">
                            contents
                        </div>
                    </div>
                </div>
        </div>

        

    </section>

</body>
<script>
    function changePage(pageName = "dashboard"){
        switch (pageName) {
            case 'dashboard':
                document.querySelector('.content-page-dashboard').classList.add('active');
                document.querySelector('.contain-page-user').classList.remove('active');
                document.querySelector('.contain-page-contents').classList.remove('active');

                
                break;
            case 'users':
                document.querySelector('.content-page-dashboard').classList.remove('active');
                document.querySelector('.contain-page-user').classList.add('active');
                document.querySelector('.contain-page-contents').classList.remove('active');

                
                break;
            case 'contents':
                document.querySelector('.content-page-dashboard').classList.remove('active');
                document.querySelector('.contain-page-user').classList.remove('active');
                document.querySelector('.contain-page-contents').classList.add('active');

                
                break;
        
            default:
                break;
        }
    }
</script>
</html>