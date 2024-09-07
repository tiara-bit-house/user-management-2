<div style="margin: auto;">
    <h1 style="text-align: center;">Tiara Dewata</h1>
    <p style="text-align: center;">Jl. Alamat tiara</p>
    <hr>
</div>

<table border="1" width="100" style="margin: auto;">
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Point</th>
    </tr>
    <?php
    require_once 'app/database.php';
    $result = $conn->query('SELECT * FROM users ORDER BY point DESC');
    $index = 1;
    while ($user = $result->fetch_object()):
    ?>

        <tr>
            <td><?php echo $index ?></td>
            <td><?php echo $user->name ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->point ?></td>
        </tr>

    <?php
        $index++;
    endwhile;
    ?>
</table>
<script>
    window.print();
</script>