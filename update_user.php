<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Tiara Dewata | BIT House</title>
</head>

<body>
    <?php
    require_once 'app/database.php';
    require_once 'navbar.php';
    if (!isset($_SESSION['email'])) {
        header('Location: login.php?message="Unauthorized action"');
        exit();
    }

    if (!isset($_GET['user_id'])) {
        header('Location: users.php?message="User id tidak ada"');
        exit();
    }

    $user_id = $_GET['user_id'];
    $stmt = $conn->prepare("SELECT user_id, name, email, point, image_url FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($user_id, $name, $email, $point, $image_url);
    $stmt->fetch();
    ?>
    <?php

    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 0:
                echo '<div class="alert alert-danger" role="alert">
                        ' . $_GET['message'] . '
                        </div>';
                break;
            case 1:
                echo '<div class="alert alert-success" role="alert">
                        ' . $_GET['message'] . '
                        </div>';
                break;
        }
    }

    ?>
    <div class="mx-auto w-25 mt-5">
        <form action="app/proses_update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
            <img id="prevImage" src="<?php echo $image_url ? "app/$image_url" : "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" ?>" width="500">
            <input type="hidden" name="oldImageUrl" value="<?php echo $image_url ?>">
            <div class="mb-3">
                <label for="image" class="form-label">Photo Profile</label>
                <input onchange="prevImages()" name="image" type="file" class="form-control" id="image" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input required value="<?php echo $name ?>" minlength="4" name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input required value="<?php echo $email ?>" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Point</label>
                <input required minlength="8" value="<?php echo $point ?>" name="point" type="number" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>

</html>