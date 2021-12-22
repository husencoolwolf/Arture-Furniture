<?php
    include 'database.php';
    $db = new database();
?>

<h1>CRUD PHP</h1>
<h1?>User Data</h1>

<a href="input.php">Input Dasta</a>
<table border="1">
    <tr>
        <th>No</th>
        <th>id</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama Lengkap</th>
        <th>Opsi</th>
    </tr>

    <?php
        $no=1;
        if(!empty($db->tampil_data())){
                foreach($db->tampil_data() as $d){
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d["id"] ?></td>
                            <td><?php echo $d["username"] ?></td>
                            <td><?php echo $d["password"] ?></td>
                            <td><?php echo $d["nama"] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $d["id"]; ?>&aksi=edit">Edit</a>
                                <a href="proses.php?id=<?php echo $d["id"]; ?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php
                }
        }
    ?>

</table>