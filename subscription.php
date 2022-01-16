<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subscription</title>
  <style>
    * {
      box-sizing: border-box;
    }

    .columns {
      float: left;
      width: 33.3%;
      padding: 8px;
    }

    .price {
      list-style-type: none;
      border: 1px solid #eee;
      margin: 0;
      padding: 0;
      -webkit-transition: 0.3s;
      transition: 0.3s;
    }

    .price:hover {
      box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
    }

    .price .header {
      background-color: #111;
      color: white;
      font-size: 25px;
    }

    .price li {
      border-bottom: 1px solid #eee;
      padding: 20px;
      text-align: center;
    }

    .price .grey {
      background-color: #eee;
      font-size: 20px;
    }

    .button {
      background-color: #287bff;
      border: none;
      color: white;
      padding: 10px 25px;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
    }

    @media only screen and (max-width: 600px) {
      .columns {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <h2 style="text-align:center">Subscribe to enjoy our services</h2>
  <br>
  <div class="columns">
    <ul class="price">
      <li class="header" style="background-color:#287bff">Basic</li>
      <li class="grey">TZS 1000 / users</li>
      <li>100 Users</li>
      <li>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Debitis, ex ratione. Aliquid!
        </p>
      </li>
      <li class="grey"><a href="index.php" class="button">Subscribe</a></li>
    </ul>
  </div>

  <div class="columns">
    <ul class="price">
      <li class="header" style="background-color:#287bff">Pro</li>
      <li class="grey">TZS 500 / users</li>
      <li>500 Users</li>
      <li>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Debitis, ex ratione. Aliquid!
        </p>
      </li>
      <li class="grey"><a href="#" class="button">Subscribe</a></li>
    </ul>
  </div>

  <div class="columns">
    <ul class="price">
      <li class="header" style="background-color:#287bff">Premium</li>
      <li class="grey">TZS 100 / users</li>
      <li>1000 users</li>
      <li>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
          Debitis, ex ratione. Aliquid!
        </p>
      </li>
      <li class="grey"><a href="#" class="button">Subscribe</a></li>
    </ul>
  </div>

</body>
</html>
