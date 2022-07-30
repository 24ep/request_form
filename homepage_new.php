<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New ui content service gate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&family=Quicksand:wght@400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="css-theam/light-new.css">
</head>
<body>
        <div class="col-2 list_bra shadow">
            <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="navbar-brand" href="#">ONLINE CONTENT</a>
                <hr class="hr_manu_bra">
                <span class="name_manu_bra">Jaroonwit P.</span>
                <small class="dept_manu_bra">Admin</small>
                <hr class="hr_manu_bra">
                <small class="header_manu_bra">Manu</small>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <a class="nav-link"  type="button" onclick="get_list_update_job();"><ion-icon name="notifications" ></ion-icon>Notifications
                        <div id="get_count_nt_unread">
                            <?php include('get/get_count_nt_unread.php'); ?>
                        </div>
                    </a>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link active"  data-bs-toggle="pill" type="button" role="tab" aria-selected="false"><ion-icon name="home" ></ion-icon>Dashboard</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link"  data-bs-toggle="pill" type="button" role="tab" aria-selected="false"><ion-icon name="ticket" ></ion-icon>Create New</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link"  data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="ticket"></ion-icon>Update content</a>
                    </li>
                <hr class="hr_manu_bra_in">
                <small class="header_manu_bra">Internals</small>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="code" ></ion-icon>Script</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="cube" ></ion-icon>Assests</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="people" ></ion-icon>Account</a>
                    </li>
                <hr class="hr_manu_bra_in">
                <small class="header_manu_bra">Others</small>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="globe" ></ion-icon>Quick link</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="settings" ></ion-icon>Settings</a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                        <a class="nav-link" data-bs-toggle="pill" type="button" role="tab"  aria-selected="false"><ion-icon name="log-out" ></ion-icon>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
</body>
</html>