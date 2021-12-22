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
            foreach($db->edit($_GET['nik']) as $d){
                ?>
                    <table>
                        <tr>
                            <td>NIK</td>
                            <td><input type="text" name="nik" value="<?php echo $d['nik'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Jalur</td>
                            <td>
                                <select name="jalur">
                                    <option value="umum" <?php if($d['jalur']=="umum") echo 'selected="selected"' ?>>Umum</option>
                                    <option value="beasiswa" <?php if($d['jalur']=="beasiswa") echo 'selected="selected"' ?>>Beasiswa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Akademik</td>
                            <td>
                                <select name="akademik">
                                    <option value="s1" <?php if($d['jalur']=="s1") echo 'selected="selected"' ?>>S1</option>
                                    <option value="s2" <?php if($d['jalur']=="s2") echo 'selected="selected"' ?>>S2</option>
                                    <option value="s3" <?php if($d['jalur']=="s3") echo 'selected="selected"' ?>>S3</option>
                                </select>
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
                            <td>No. HP</td>
                            <td><input type="text" name="nope" value="<?php echo $d['no_hp'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Petugas</td>
                            <td><input type="text" name="petugas" value="<?php echo $d['petugas'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td>
                                <select name="tahun">
                                    <?php
                                        for ($i=date("Y"); $i>=2000;$i--){
                                            ?>
                                            <option value="<?php echo $i ?>" <?php if($d['tahun']==(string)$i) echo 'selected="selected"' ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Biaya</td>
                            <td><input type="text" name="biaya" value="<?php echo $d['biaya'] ?>"></td>
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