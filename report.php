<?php  
  session_start();

  error_reporting(0);

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('config/dbconn.php');

  if (!isset($_SESSION['username'])) {
    header("Location: authentication");
    exit(0);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Report</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <style>

    .report-container {
      width: 940px;
			margin: 80px 25px 25px 25px;
      padding: 25px;
    }

    .table {
      border-collapse: collapse;
      padding: 25px;
      margin: 25px auto 0;
      font-size: 0.9em;
      width: 100%;
      border-radius: 5px 5px 0 0;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    th, td {
      border: 1px solid #bbb;
      padding: 10px;
      text-align: left;
    }

    tr:hover {
      background-color: #e5e5e5;
    }

    .tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th {
      background-color: #e1251b;
      color: white;
      border: #e1251b;
    }

    .table tbody tr:last-of-type {
      border-bottom: 2px solid #e1251b;
    }

    .btn {
      background-color: #e1251b;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
      float: right;
    }

    .btn:hover {
      opacity: 0.8;
    }

    @media print {
      /* Hide every other element */
      body * {
        visibility: hidden;
      }

      /* Then displaying report container elements */
      .table, .table * {
        visibility: visible;
      }
    }

    .print-btn {
      padding-top: 20px;
    }

    .dropdown {
      width: 200px;
      position: relative;
    }

    .dropdown:hover .dropdown-list {
      opacity: 1;
      visibility: visible;
    }

    .dropdown-select {
      padding: 15px 32px;
      border-radius: 4px;
      color: #fff;
      background-color: #e1251b;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 16px;
      cursor: pointer;
    }

    .dropdown-select:hover {
      opacity: 0.8;
    }

    .dropdown-list {
      border-radius: 4px;
      background-color: #e1251b;
      color: #fff;
      position: absolute;
      top: 110%;
      left: 0;
      right: 0;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.2s linear, visibility 0.2s linear;
    }

    .dropdown-list-item {
      padding: 1rem;
      font-size: 16px;
    }

    .dropdown-list-item:hover {
      background-color: #fff;
      color: #e1251b;
      cursor: pointer;
    }

  </style>
</head>
<body>
  <div class="report-container">
    <div class="print-btn">
      <p>
        <button onclick="printJS('printJS-table', 'html')" class="btn">Print</button>
      </p>
    </div>
    <div class="dropdown">
      <div class="dropdown-select">
        <span class="select">Reports</span>
        <ion-icon name="arrow-dropdown"></ion-icon>
      </div>
      <div class="dropdown-list">
        <div id="all" class="dropdown-list-item">All</div>
        <div id="registration" class="dropdown-list-item">Registered</div>
        <div id="attended" class="dropdown-list-item">Attended</div>
      </div>
    </div>
    <div id="printReport" class="print-table">
      <table id="printJS-table" class="table">
        <thead>
          <tr>
            <th>Event ID</th>
            <th>Field1</th>
            <th>Field2</th>
            <th>Field3</th>
            <th>Field4</th>
            <th>Field5</th>
            <th>Field6</th>
            <th>Field7</th>
            <th>Registered At</th>
          </tr>
        </thead>
        <!-- <tbody>
          <?php  
            $sql = "SELECT * FROM registered"; //  WHERE column IS NOT NULL AND column <> ''
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
                    <td><?php echo $row['registered_at']; ?></td>
                  </tr>
                <?php
              }
            }
            else{
              ?>
                <tr>
                  <td>No Event Found</td>
                </tr>
              <?php
            }
          ?>
        </tbody> -->
        <tbody id="response">

        </tbody>
      </table>
    </div>
  </div>
  <?php include('includes/script.php'); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("home").className = "";
      document.getElementById("event").className = "";
      document.getElementById("report").className = "btn-active";
      document.getElementById("form-setting").className = "";
    });
  </script>
  <script>
    $('#registration').click(function() {
      $.ajax({
        url: 'registration-report.php',
        type: 'POST',
        success: function name(responsedata) {
          $('#response').html(responsedata);
        }
      });
    });

    $('#attended').click(function() {
      $.ajax({
        url: 'attendance-report.php',
        type: 'POST',
        success: function name(responsedata) {
          $('#response').html(responsedata);
        }
      });
    });
  </script>
</body>
</html>