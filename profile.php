<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$query = "SELECT name, lastname, email, tel, country, `date` FROM inscription WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $firstName = $row["name"];
    $lastName = $row["lastname"];
    $email = $row["email"];
    $phone = $row["tel"];
    $country = $row["country"];
    $date = $row["date"];
  }
} else {
  echo "No profile information found.";
}
$messg = isset($_GET['messg']) ? $_GET['messg'] : '';

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>My Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #096ab3;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 40px;
      background-color: #ffd249;
      border: 1px solid #ffd249;
      border-radius: 10%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    h1 {
      margin-bottom: 20px;
      text-align: center;
      padding-bottom: 40px;
    }

    .profile-info {
      margin-bottom: 20px;
    }

    .profile-info label {
      font-weight: bold;
      font-size: 20px;
    }

    .profile-info span {
      margin: 4px 0;
      font-size: 20px;
    }

    .user-image {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto;
    }

    .user-image img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .message {
      color: #006f02;
      font-size: 20px;
      font-weight: bold;
    }

    a {
      text-decoration: none;
    }

    .button-container a {
      display: inline-block;
      padding: 10px 20px;
      font-size: 20px;
      background-color: #d50274;
      color: #fff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
    }

    .button-container a:hover {
      background-color: #63006e;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="profile.php?id=<?php echo $id; ?>">
      <div class="message">
        <?php echo $messg; ?>
      </div>
      <br>
      <div class="user-image">
        <img src="../project/image/user.png" alt="Default User Picture">
      </div>
    </a>

    <h1>My Profile</h1>

    <div class="profile-info">
      <label>Name:</label>
      <span>
        <?php echo $firstName . ' ' . $lastName; ?>
      </span>
    </div>
    <div class="profile-info">
      <label>Email:</label>
      <span>
        <?php echo $email; ?>
      </span>
    </div>
    <div class="profile-info">
      <label>Phone:</label>
      <span>
        <?php echo $phone; ?>
      </span>
    </div>
    <div class="profile-info">
      <label>Country:</label>
      <span>
        <?php echo $country; ?>
      </span>
    </div>
    <div class="profile-info">
      <label>Date:</label>
      <span>
        <?php echo $date; ?>
      </span>
    </div>

    <div class="button-container">
      <a href="editprofile.php?id=<?php echo $id; ?>">Update Profile</a>
      <a href="dashboard.php?id=<?php echo $id; ?>">Go back to Dashboard</a>
    </div>

  </div>
</body>

</html>