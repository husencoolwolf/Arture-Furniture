<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data</title>
</head>
<body>
    <h2>Tambah Data</h2>
    <form action="proses.php?aksi=tambah" method="post">
        <table>
            <tr>
                <td>NIK</td>
                <td><input type="text" name="nik"></td>
            </tr>
            <tr>
                <td>Jalur</td>
                <td>
                    <select name="jalur">
                        <option value="umum">Umum</option>
                        <option value="beasiswa">Beasiswa</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Akademik</td>
                <td>
                    <select name="akademik">
                        <option value="s1">S1</option>
                        <option value="s2">S2</option>
                        <option value="s3">S3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td><input type="text" name="nope"></td>
            </tr>
            <tr>
                <td>Petugas</td>
                <td><input type="text" name="petugas"></td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>
                    <select name="tahun">
                        <?php
                            for ($i=date("Y"); $i>=2000;$i--){
                                ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Biaya</td>
                <td><input type="text" name="biaya"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>