<html>

<head>
  <title>MySQL Database Spesification Creator</title>
  <style type="text/css">
    table.db-table {
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
    }

    table.db-table th {
      background: #eee;
      padding: 5px;
      border-left: 1px solid #ccc;
      border-top: 1px solid #ccc;
    }

    table.db-table td {
      padding: 5px;
      border-left: 1px solid #ccc;
      border-top: 1px solid #ccc;
    }
  </style>
</head>

<body>
  <?php
  /* connect to the db */
  $connection = mysqli_connect('localhost', 'root', '', 'arture_furniture');

  /* show tables */
  $result = mysqli_query($connection, 'SHOW TABLES') or die('cannot show tables');
  while ($tableName = mysqli_fetch_array($result)) {

    $table = $tableName[0];

    echo '<h3>', $table, '</h3>';
    $result2 = mysqli_query($connection, 'SELECT * FROM ' . $table . ' LIMIT 1') or die('cannot select from ' . $table);
    $i = 0;
    echo '<table cellpadding="0" cellspacing="0" class="db-table">';
    echo '<tr><th>No</th><th>Nama Field</th><th>Type</th><th>Panjang</th><th>Keterangan</th></tr>';
    // $i < mysqli_num_fields($result2)
    while ($meta = mysqli_fetch_field($result2)) {
      // $meta = mysqli_fetch_field($result2, $i);
      $length = mysqli_num_rows($result2);
      echo '<tr>';
      echo '<td>' . ($i + 1) . '</td>'; //nomor
      echo '<td>' . (($meta['primary_key']) ? '<u>' . $meta['name'] . '</u>' : $meta['name']) . '</td>'; //nama field
      echo '<td>' . $meta['type'] . '</td>'; //tipe field
      echo '<td>' . $length . '</td>'; //panjang
      echo '<td>' . $meta['name'] . '</td>'; //keterangan
      echo '</tr>';
      $i++;
    }
    echo '</table><br />';
  }
  ?>
</body>

</html>