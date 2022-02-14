<?php  
  session_start();

  error_reporting(0);

  include('config/dbconn.php');

  if (!isset($_SESSION['username'])) {
    header("Location: authentication");
    exit(0);
  }

  $sql = "SELECT * FROM attended"; //  WHERE column IS NOT NULL AND column <> ''
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    foreach ($result as $row) {
        ?>
            <tr>
                <td><?php echo $row['event_id']; ?></td>
                <td><?php echo $row['field_1']; ?></td>
                <td><?php echo $row['field_2']; ?></td>
                <td><?php echo $row['field_3']; ?></td>
                <td><?php echo $row['field_4']; ?></td>
                <td><?php echo $row['field_5']; ?></td>
                <td><?php echo $row['field_6']; ?></td>
                <td><?php echo $row['field_7']; ?></td>
                <td><?php echo $row['attended_at']; ?></td>
            </tr>
        <?php
    }
  }
  else {
    ?>
        <tr>
            <td>No Data Found</td>
        </tr>
    <?php
  }
?>