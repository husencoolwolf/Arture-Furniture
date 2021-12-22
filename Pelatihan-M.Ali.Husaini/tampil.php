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
        <th>NIK</th>
        <th>Jalur</th>
        <th>Akademik</th>
        <th>Password</th>
        <th>Nama</th>
        <th>No. HP</th>
        <th>Petugas</th>
        <th>Tahun</th>
        <th>Biaya</th>
        <th>Tanggal Bayar</th>
        <th>Opsi</th>
    </tr>
    <?php
        $no=1;
        if(!empty($db->tampil_data())){
                foreach($db->tampil_data() as $d){
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d["nik"] ?></td>
                            <td><?php echo $d["jalur"] ?></td>
                            <td><?php echo $d["akademik"] ?></td>
                            <td><?php echo $d["password"] ?></td>
                            <td><?php echo $d["nama"] ?></td>
                            <td><?php echo $d["no_hp"] ?></td>
                            <td><?php echo $d["petugas"] ?></td>
                            <td><?php echo $d["tahun"] ?></td>
                            <td><?php echo $d["biaya"] ?></td>
                            <td><?php echo $d["tgl_daftar"] ?></td>
                            <td>
                                <a href="edit.php?nik=<?php echo $d["nik"]; ?>&aksi=edit">Edit</a>
                                <a href="proses.php?nik=<?php echo $d["nik"]; ?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php
                }
        }
    ?>

</table>