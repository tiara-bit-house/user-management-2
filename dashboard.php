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
    require_once 'navbar.php';

    if (!isset($_SESSION['email'])) {
        header('Location: login.php?message"Unauthorized action"');
        exit();
    } ?>

    <h1 class="text-center">
        Hallo, <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'utf-8') ?>
        <p>Login sebagai : <?php echo $_SESSION['is_admin'] ? 'Admin' : 'Member' ?></p>
    </h1>

    <div class="mx-auto w-50">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d75047.7985616875!2d115.20382537611451!3d-8.671183400150856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24149216c058f%3A0x5d8dd5076a7a4d06!2sLapangan%20Puputan%20Badung%20(I%20Gusti%20Ngurah%20Made%20Agung)!5e0!3m2!1sen!2sid!4v1725952243275!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


</body>

</html>