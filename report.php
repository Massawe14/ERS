<?php  
  session_start();

  error_reporting(0);

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');

  if (!isset($_SESSION['username'])) {
    // code...
    header("Location: authentication.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Report</title>
  <style>

    /*.content-table {
      border-collapse: collapse;
      padding: 25px;
      margin: 25px auto 0;
      font-size: 0.9em;
      width: 1000px;
      border-radius: 5px 5px 0 0;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .content-table thead tr {
      background-color: #e1251b;
      color: #ffffff;
      text-align: left;
      font-weight: bold;
    }

    .content-table th,
    .content-table td {
      padding: 12px 15px;
    }

    .content-table tbody tr {
      border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
      border-bottom: 2px solid #e1251b;
    }*/

    /*.content-table tbody tr.active-row {
      font-weight: bold;
      color: #009879;
    }*/

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

  </style>
</head>
<body>
  <div class="report-container">
    <p>
      <button class="btn">Print</button>
    </p>
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
  <?php include('includes/script.php'); ?>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $('.btn').click(function(){
      var printme = document.getElementById('table');
      var wme = window.open("","","width=900,height=700");
      wme.document.write(printme.outerHTML);
      wme.document.close();
      wme.focus();
      wme.print();
      wme.close();
    });
  </script>
</body>
</html>