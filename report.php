<?php  
  session_start();

  error_reporting(0);

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');

  if (!isset($_SESSION['username'])) {
    // code...
    header("Location: authentication.php");
    exit(0);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Report</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <style>

    .report-container {
      width: 940px;
      margin: 0 auto;
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

    .print-table {
      padding-top: 20px;
    }

  </style>
</head>
<body>
  <div class="report-container">
    <div class="print-btn">
      <p>
        <button onclick="window.print();" class="btn">Print</button>
      </p>
    </div>
    <div class="print-table">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Points</th>
            <th>Team</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Domenic</td>
            <td>88,110</td>
            <td>dcode</td>
          </tr>
          <tr class="active-row">
            <td>2</td>
            <td>Sally</td>
            <td>72,400</td>
            <td>Students</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Nick</td>
            <td>52,300</td>
            <td>dcode</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <?php include('includes/script.php'); ?>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script
  src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#table').DataTable();
    });
  </script>
</body>
</html>