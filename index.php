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
          <span class="color">|</span>




          <button type="button" class="button1" onclick="document.getElementById('id01').style.display='block'"
            style="width:auto;">Login in </button>

          <?php
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $login = $_POST["uname"];
            $password = $_POST["psw"];

            $servername = "localhost";
            $username = "root";
            $password_db = "";
            $dbname = "project";

            try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $stmt = $conn->prepare("SELECT * FROM inscription WHERE email = :login");
              $stmt->bindParam(':login', $login);
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              if ($row) {
                $storedLogin = $row["email"];
                $storedPassword = $row["password"];

                if ($password == $storedPassword) {
                  session_start();
                  $_SESSION["email"] = $storedLogin;
                  header("Location: dashboard.php");
                  exit();

                } else {
                  $error = "Invalid login or password. Please try again.";
                }
              } else {
                $error = "Invalid login or password. Please try again.";
              }
            } catch (PDOException $e) {

            }

            $conn = null;
          }
          ?>

          <div id="id01" class="modal">
            <form class="modal-content animate" method="post" action="index.php">
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close">&times;</span>
              </div>
              <div class="container">
                <br />
                <br />
                <?php if (isset($error)): ?>
                  <p class="error" style="color: red; font-weight: bold; word-spacing: normal;">
                    <?php echo $error; ?>
                  </p>
                <?php endif; ?>



                <label for="login"><b>Login</b></label>
                <input type="text" class="input1" placeholder="Enter login" name="uname" required>
                <label for="password"><b>Password</b></label>
                <input type="password" class="input1" placeholder="Enter password" name="psw" required>
                <label><input type="checkbox" checked="checked" name="remember">Remember_me</label>
                <p class="center">
                  <button type="submit" name="submit" class="button5">Login</button>
                </p>
              </div>
              <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                  class="cancelbtn">Cancel</button>
                <a href="#" class="pos a2">Forgot_password?</a>
              </div>
            </form>
          </div>



          <button type="button" class="button2" onclick="location.href='inscription.php'">Join for free</button>

    </nav>



    </div>
    </div>
  </header>

  <section class=" container-fluid bg" id="1">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

          <div class="waviy">
            <span style="--i:1" class="C2">L</span>
            <span style="--i:2" class="C1">E</span>
            <span style="--i:3" class="C1">A</span>
            <span style="--i:4" class="C1">R</span>
            <span style="--i:5" class="C1">N</span>
            <span style="--i:6"> </span>
            <span style="--i:7" class="C2">E</span>
            <span style="--i:8" class="C1">N</span>
            <span style="--i:9" class="C1">G</span>
            <span style="--i:10" class="C1">L</span>
            <span style="--i:11" class="C1">I</span>
            <span style="--i:12" class="C1">S</span>
            <span style="--i:13" class="C1">H</span>
            <span style="--i:14"> </span>
            <span style="--i:15" class="C2">O</span>
            <span style="--i:16" class="C1">N</span>
            <span style="--i:17" class="C1">L</span>
            <span style="--i:18" class="C1">I</span>
            <span style="--i:19" class="C1">N</span>
            <span style="--i:20" class="C1">E</span>


          </div>
          <div class="text2">Learn English with our online course for all levels. Start learning for free and improve
            your English language skills today.
            <br /><br /><button type="button" class="button3" onclick="location.href='inscription.php'">Join for
              free</button>
          </div>


        </div>
        <div class="col-md-6  col-lg-6 col-xs-12 col-sm-12">
          <img src="../project/image/1.png" alt="image" class="image" />
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

        </div>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

          <img src="image/test-removebg-preview.png" class="image2">

        </div>
      </div>
  </section>
  <section class="container-fluid bg2" id="3">

    <div class="container reveal">

      <p class="text8">WE offer Free courses online for 3 levels :<br /><br />
      <div class="cards">
        <div class="text-card" style="box-shadow: 2px 2px 10px 3px #7c7672;background-color:#d0ff77;">
          <h2>Beginner Course</h2>
          <p style="font-size: 18px ; color:#000b1e; text-align:center">Build a strong language base with our
            comprehensive Beginner English Course.</p>
        </div>


        <div class="cards">
          <div class="text-card" style="box-shadow: 2px 2px 10px 2px #7c7672;background-color:#07a5ff;">
            <h2>intermdiate Course</h2>
            <p style="font-size: 18px ; color:#000b1e; text-align:center">Take your English skills to the next level
              with our Intermediate English Course!</p>
          </div>

          <div class="cards">
            <div class="text-card" style="box-shadow: 2px 2px 10px 2px #7c7672;background-color:#e5a500;">
              <h2>Advanced Course</h2>
              <p style="font-size: 18px ; color:#000b1e; text-align:center">Elevate your English proficiency to an
                advanced level with our Advanced English Course! </p>
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