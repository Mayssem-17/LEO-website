<?php
session_start();

if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}

$email = $_SESSION["email"];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

try {

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $stmt = $conn->prepare("SELECT * FROM inscription WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $userData = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($userData) {
    $name = $userData["name"];
  } else {
    $name = "Unknown";
  }

  $userId = $userData["id"];


  $stmt = $conn->prepare("SELECT COUNT(*) FROM login_history WHERE user_id = :userId");
  $stmt->bindParam(':userId', $userId);
  $stmt->execute();
  $loginCount = $stmt->fetchColumn();

  if ($loginCount === false) {

    $message = "Error occurred. Please try again.";

  } else if ($loginCount == 0) {

    $message = "Welcome, " . $name . "!";
    $message2 = "Thank you for signing up!";

    $stmt = $conn->prepare("INSERT INTO login_history (user_id) VALUES (:userId)");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  } else {

    $message = "Welcome back, ";
    $message2 = $name . "!";
  }

  $messg = $name;
  $conn = null;
} catch (PDOException $e) {

  echo "Error: " . $e->getMessage();
  exit();
}

if (isset($_POST["disconnect"])) {

  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/bootstrap.min.css" />
  <link rel="stylesheet" href="CSS/styles.css" />
  <link rel="icon" href="../project/image/logo.png">
  <title>LEO</title>
  <style>
    .img {
      width: 500px;
      height: auto;
      padding: 20px;
      animation: MoveUpDown 3.5s linear infinite;
    }


    * {
      margin: 0;
      padding: 0;


    }

    .action {
      position: fixed;
      top: 20px;
      right: 30px;

    }

    .action .profile {
      position: relative;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
      float: right;

    }

    .action .profile img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      float: right;
    }

    .action .menu1 {
      position: :absolute;
      top: 120px;
      right: -10px;
      padding: 10px 20px;
      background: #fff;
      width: 200px;
      box-sizing: 0 5px 25px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
      transition: 0.5s;
      visibility: hidden;
      font-family: 'font6';
      opacity: 0;

    }

    .action .menu1.active {
      top: 80px;
      visibility: visible;
      opacity: 1;
    }

    .action .menu1 h3 {
      width: 100%;
      text-align: center;
      font-size: 18px;
      padding: 20px 0;
      font-weight: 500;
      font-size: 18px;
      color: #555;
      line-height: 1.2em;


    }

    .action .menu1 h3 span {
      font-size: 14px;
      color: #3f5f92;
      font-weight: 400;
      text-transform: capitalize;


    }

    .action .menu1 ul li {
      list-style: none;
      padding: 10px 0;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      display: flex;
      align-items: center;

    }

    .action .menu1 ul li img {
      max-width: 20px;
      margin-right: 10px;
      opacity: 0.5;
      transition: 0.5s;

    }

    .action .menu1 ul li:hover img {
      opacity: 1;
    }

    .action .menu1 ul li a {
      display: inline-block;
      text-decoration: none;
      color: #555;
      font-weight: 500;
      transition: 0.5s;

    }

    .action .menu1 ul li input {
      display: inline-block;
      text-decoration: none;
      color: #555;
      font-weight: 500;
      transition: 0.5s;
      background-color: transparent;
      border: none;

    }

    .action .menu1 ul li:hover a {
      color: #07a5ff;
    }

    .action .menu1 ul li:hover input {
      color: #07a5ff;
    }
  </style>


</head>

<body>
  <button onclick="topFunction()" id="Btn" title="Go to top">^<br /><span class="top">Top</span></button>
  <script>

    let mybutton = document.getElementById("Btn");

    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
  <header class=" container-fluid headerbar">
    <nav class="menu">

      <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 ">

          <div class="col-md-6">

            <a href="#1">
              <h4><img class="logoimg" src="../project/image/logo.png" /><span class="logo">LEO</span></h4>
            </a>

          </div>

        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 ">


          <a href="#2" class="a1">Test</a>
          <a href="#3" class="a1">Learn</a>
          <a href="#4" class="a1">Reading</a>
          <a href="#5" class="a1">Contact</a>
          <div class="action">
            <div class="profile" onclick="menuToggle();">
              <img src="../project/image/user.png" alt="User Picture">
            </div>
            <div class="menu1">
              <h3>Hello<br><span>
                  <?php echo $messg; ?>
                </span></h3>
              <ul>
                <li><img src="../project/image/user1.png" alt="profile"><a
                    href="profile.php?id=<?php echo $userData['id']; ?>">My_profile</a>
                <li>
                <li><img src="../project/image/edit.png" alt="edit"><a
                    href="editprofile.php?id=<?php echo $userData['id']; ?>">Edit_profile</a>
                <li>
                <li><img src="../project/image/question.png" alt="help"><a href="#">Help</a>
                <li>
                <li>
                  <img src="../project/image/log-out.png" alt="logout">
                  <form method="post" action="">
                    <input name="disconnect" value="Logout" type="submit">


                  </form>
                </li>

              </ul>
            </div>


          </div>
        </div>

    </nav>

    </div>
    </div>

    <script>
      function menuToggle() {
        const toggleMenu = document.querySelector('.menu1');
        toggleMenu.classList.toggle('active');

      }
    </script>

  </header>

  <section class=" container-fluid bg" id="1">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-lg-7 col-xs-12 col-sm-12">

          <div class="waviy">
            <span style="--i:1" class="C2">
              <?php echo $message; ?>
            </span>
            <span style="--i:2" class="C1">
              <?php echo $message2; ?>
            </span>

          </div>
          <div class="text2">Learn English with our online course for all levels.
            <br /><br />
            <div>
              <button type="button" class="button3" onclick="location.href='#2'">Start learning </button>
            </div>

          </div>
        </div>
        <div class="col-md-5  col-lg-5 col-xs-12 col-sm-12">
          <img src="../project/image/1.png" alt="image" class="img" />
        </div>
      </div>
    </div>
    </div>


  </section>
  <section class="container-fluid bg1" id="2">

    <div class="container reveal">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
          <p class="text2"><span class="text5">Test your English level</span><br /><br /> This test contains grammar and
            vocabulary questions and your test result will help you choose a level to practise at.</span>
            <br /><br /> <button type="button" onclick="location.href='../project/Quiz.html'" class="button6">Take
              Level Test</button>
          </p>

        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

          <img src="../project/image/img3.png" class="image">

        </div>
      </div>
  </section>
  <section class="container-fluid bg2" id="3">

    <div class="container reveal">
      <div class="cards">
        <div class="text-card" style="box-shadow: 2px 2px 10px 3px #7c7672;background-color:#d0ff77;">
          <h2>Beginner Course</h2>
          <p style="font-size: 18px ; color:#000b1e; text-align:center">Build a strong language base with our
            comprehensive Beginner English Course.</p>


          <!-- <button type="button" onclick="location.href='../project/beginner.html'" class="button">Enroll course</button> -->
        </div>

        <div class="cards">
          <div class="text-card" style="box-shadow: 2px 2px 10px 2px #7c7672;background-color:#07a5ff;">
            <h2>intermdiate Course</h2>
            <p style="font-size: 18px ; color:#000b1e; text-align:center">Take your English skills to the next level
              with our Intermediate English Course!</p>
            <!-- <button type="button" onclick="location.href=''" class="button">Enroll course</button> -->
          </div>


          <div class="cards">
            <div class="text-card" style="box-shadow: 2px 2px 10px 2px #7c7672;background-color:#e5a500;">
              <h2>Advanced Course</h2>
              <p style="font-size: 18px ; color:#000b1e; text-align:center">Elevate your English proficiency to an
                advanced level with our Advanced English Course! </p>

              <!-- <button type="button" onclick="location.href=''" class="button">Enroll course</button> -->
            </div>
          </div>
  </section>
  <script type="text/javascript">
    window.addEventListener('scroll', reveal);

    function reveal() {
      var reveals = document.querySelectorAll('.reveal');

      for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var revealTop = reveals[i].getBoundingClientRect().top;
        var revealPoint = 150;

        if (revealTop < windowHeight - revealPoint) {
          reveals[i].classList.add('active');
        } else {
          reveals[i].classList.remove('active');
        }
      }
    }

  </script>

  <section class="container-fluid bg3" id="4">

    <div class="container reveal">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

          <p class="text5">Practise and improve your skills!</p>
          <P class="text2">Reading is a very important language learning skill.
            It helps you improve all parts of the English language vocabulary, spelling, grammar, and writing.</P>
          <p class="text2">That's why we have English texts for YOU to practice reading , Listening and comprehension
            online and for free.
            <br /><br /><button type="button" onclick="location.href='../project/Reading.html'" class="button7">Let's
              GO</button>
          </p>
        </div>

        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

          <img src="../project/image/img11.png" class="image2" />

        </div>

      </div>
    </div>
  </section>



  <section class="contact container-fluid bg5" id="5">
    <div class="container">
      <h4 class="text3">Contact Us</h4>
      <form id="contactForm">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="">
              <label class="text4">First Name</label>
              <input type="text" class="input2" name="first_name" placeholder="First Name">
            </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="">
              <label class="text4">Last Name</label>
              <input type="text" class="input2" name="last_name" placeholder="Last Name">
            </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="">
              <label class="text4">Email</label>
              <input type="email" class="input2" name="email" placeholder="Email">
            </div>
          </div>

          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="">
              <label class="text4">Phone</label>
              <input type="text" class="input2" name="phone" placeholder="Phone Number">
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <div class="">
              <label class="text4">Message</label>
              <br />
              <textarea class="input2" name="message" placeholder="Write your Message"></textarea>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
              <input type="button" value="Send Message" class="button3" onclick="sendEmail()">
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <script>
    function sendEmail() {
      var formData = new FormData(document.getElementById("contactForm"));


      var body = "First Name: " + formData.get("first_name") + "\n"
        + "Last Name: " + formData.get("last_name") + "\n"
        + "Email: " + formData.get("email") + "\n"
        + "Phone: " + formData.get("phone") + "\n"
        + "Message: " + formData.get("message");


      var mailtoLink = "mailto:mayssemnour2023@gmail.com"
        + "?subject=" + encodeURIComponent("Contact Form Submission")
        + "&body=" + encodeURIComponent(body);

      window.location.href = mailtoLink;


      document.getElementById("contactForm").reset();
    }
  </script>



  <footer>

    <div class="container ">
      <div class="row">
        <div class="">
          <div>
            <h5>About Us</h5>
            <p class="text6">We are an online language school whose mission is to help anyone who wants to learn English
              online with ease and flexibility.</p>
          </div>
          <div>
            <h5>Social Links</h5>
            <nav>
              <img />
              <a href="" class="a3">Facebook</a>
              <a href="" class="a3">Twitter</a>
              <a href="" class="a3">Gmail</a>
              <a href="" class="a3">Youtube</a>
            </nav>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-12">
              <p class="text6">© All Rights Reserved by <a href="" class="a3">LEO</a></p>
            </div>


  </footer>


</body>

</html>