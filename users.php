<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

    <title>Tiara Dewata | BIT House</title>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let table = new DataTable('#myTable', {});
        }, false);
    </script>
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
    <?php if ($_SESSION['is_admin']): ?>
        <div class="d-flex justify-content-center">
            <a href="laporan.php" class="mx-auto">
                Print Laporan User
            </a>
        </div>
    <?php endif ?>

    <div class="w-50 mx-auto">
        <table class="display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Profile</th>
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
                        <td><img src="app/<?php echo $user->image_url ?>" alt="Photo profile" width="150"></td>
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
    </div>

</body>

</html>