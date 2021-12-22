<?php
    include 'database.php';
    $db = new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h3>Edit Data</h3>
    <form action="proses.php?aksi=update" method="post">
        <?php
            foreach($db->edit($_GET['id']) as $d){
                ?>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $d['id'] ?>">
                                <input type="text" name="username" value="<?php echo $d['username'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="password" name="password" value="<?php echo $d['password'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input type="text" name="nama" value="<?php echo $d['nama'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Simpan"></td>
                        </tr>
                    </table>
                <?php
            }
        ?>
    </form>
</body>
</html>