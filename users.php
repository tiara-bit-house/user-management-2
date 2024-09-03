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
        header('Location: login.php?message"Unauthorized action"');
        exit();
    }
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
    <table class="table w-50 mx-auto">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Point</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $result = $conn->query('SELECT * FROM users');
            $index = 1;
            while ($user = $result->fetch_object()):
            ?>
                <tr>
                    <th scope="row"><?php echo $index ?></th>
                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->email ?></td>
                    <td><?php echo ($user->point) ?? 'Tidak ada point' ?></td>
                    <td class="d-flex gap-3">
                        <a href="view_user.php?user_id=<?php echo $user->user_id ?>">View</a>
                        <a href="update_user.php?user_id=<?php echo $user->user_id ?>">Update</a>
                        <?php if ($_SESSION['user_id'] != $user->user_id): ?>
                            <form action="app/proses_delete.php" method="POST" onsubmit="return confirm('Yakin ingin mendelete data?')">
                                <input type="hidden" name="user_id" value="<?php echo $user->user_id ?>">
                                <button type="submit" style="border: none;background: none;">Delete</button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php
                $index++;
            endwhile ?>
        </tbody>
    </table>
</body>

</html>