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
    $stmt = $conn->prepare("SELECT user_id, name, email, point FROM users WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($user_id, $name, $email, $point);
    $stmt->fetch();
    ?>
    <div class="card mx-auto" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $name ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $email ?></h6>
            <p class="card-text"><?php echo $point ?? 'Tidak ada point' ?></p>
        </div>
    </div>
</body>

</html>