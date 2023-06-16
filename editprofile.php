<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$messg = "";
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $country = $_POST["country"];

  $query = "UPDATE inscription SET name='$firstName', lastname='$lastName', email='$email', tel='$phone', country='$country' WHERE id=$id";

  if ($conn->query($query) === TRUE) {
    $messg = "Profile updated successfully!";

    header("Location: profile.php?id=$id&messg=" . urlencode($messg));
  } else {
    $messg = "Error updating profile: " . $conn->error;
  }
}

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

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>

  <title>Edit Profile</title>
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
      padding-bottom: 20px;
    }

    .profile-info {
      margin-bottom: 20px;
    }

    .profile-info label {
      font-weight: bold;
      font-size: 20px;
    }

    .profile-info input {
      margin: 4px 0;
      font-size: 20px;
      width: 100%;
      padding: 5px;
      background-color: #fffba4;
      border-color: #ffd249;
    }

    .button-container {
      text-align: center;
    }

    .button-container button {
      padding: 10px 20px;
      font-size: 20px;
      background-color: #d50274;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .button-container button:hover {
      background-color: #63006e;
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
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
    <h1>Edit Profile</h1>
    <form action="" method="POST">
      <div class="profile-info">
        <label>Name:</label>
        <input type="text" name="firstName" value="<?php echo $firstName; ?>">
      </div>
      <div class="profile-info">
        <label>Last Name:</label>
        <input type="text" name="lastName" value="<?php echo $lastName; ?>">
      </div>
      <div class="profile-info">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
      </div>
      <div class="profile-info">
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>">
      </div>
      <div class="profile-info">
        <label>Country:</label>
        <input type="text" name="country" value="<?php echo $country; ?>">
      </div>

      <div class="button-container">
        <button type="submit">Update Profile</button>
        <a href="dashboard.php?id=<?php echo $id; ?>">Go back to Dashboard</a>
      </div>
    </form>
  </div>
</body>

</html>