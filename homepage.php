<?php
$host="localhost";
$user="root";
$password="";
$db="account";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false) {
    die("Connection error");
}
// Assuming user email is stored in session after login
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = 'Guest'; // Default value if no user is logged in
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HEALot Biomekaniks</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="JS/function.js"></script>
  <style>
  body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
  }
  /* Navbar styling */
  nav {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: white;
    border-bottom: 0px solid #444;
    border-radius: 5px;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px;
    box-shadow: 0px 2px 10px #888888;
  }
  nav .nav-left {
    display: flex;
    align-items: center;
  }
  .nav-left li a{
    color: black;
  }
  nav li {
    display: inline;
    cursor: pointer;
    font-weight: bold;
    margin-right: 20px;
  }
  /* Change font color of anchor tags in the nav */
  nav li a {
    margin-left: 40px;
    color: black; /* Set the color of the links to black */
    text-decoration: none; /* Remove underline */
    position: relative; /* Necessary for positioning the pseudo-element */
  }
  nav li a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0;
    height: 2px;
    background-color: #ff6347; /* Underline color */
    transition: width 0.3s ease; /* Animation timing */
  }
  nav li a:hover::after {
    width: 100%; /* Full width on hover */
  }
  nav li a:hover {
    color: #ff6347;
    text-decoration: none; /* Ensure text isn't underlined when hovered */
  }
  /* Button styling for Register and Login */
  .container {
    display: flex;
    position: absolute; /* Position it in relation to the navbar */
    top: 15px; /* Space from the top */
    right: 90px; /* Adjust horizontal spacing from the right */
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .container .btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    margin-left: 10px;
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .container .btn:hover {
    background-color: #45a049;
  }
  /* Add hover effect to footer links */
  footer a:hover {
    color: black; /* Change color to gray on hover */
  }
  .hamburger-menu {
    width: 35px;
    height: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .line {
    width: 100%;
    height: 5px;
    background-color: lightgreen;
    border-radius: 5px;
    transition: all 0.3s ease;
  }
  .menu {
    display: none;
    background-color: green;
    position: fixed;
    top: 0;
    left: 0;
    height: 500%;
    width: 250px;
    padding-top: 60px;
    box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
    z-index: 100;
  }
  /* User Profile Section inside the Menu */
  .user-profile {
    display: flex;
    align-items: center;
    margin-bottom: 20px; /* Space from the top */
    padding: 10px; /* Space around the profile */
    background-color: lightgreen;  /* Slightly different background for the profile section */
    border-radius: 15px;
    margin-left: 10px;
    margin-right: 10px;
  }
  .user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
  }
  .username {
    font-size: 15.5px;
    font-weight: bold;
    color: black;
  }
  .menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .menu ul li {
    margin: 15px 0;
    text-align: left;
  }
  .menu ul li a {
    margin-bottom: 10px;
    margin-left: 25px;
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: block;
    transition: transform 0.5s, box-shadow 0.3s;
    text-align: left;  /* Align the text to the left */
  }
  .menu ul li a:hover {
    color: #ff6347;
    text-decoration: none; /* Ensure no underline on hover */
  }
  /* Hamburger menu transformation */
  .hamburger-menu.active .line:nth-child(1) {
    transform: rotate(45deg);
    position: relative;
    top: 8px;
  }
  .hamburger-menu.active .line:nth-child(2) {
    opacity: 0;
  }
  .hamburger-menu.active .line:nth-child(3) {
    transform: rotate(-45deg);
    position: relative;
    top: -8px;
  }
  /* Close button style */
  .close-btn {
    background-color: transparent;
    color: #fff;
    border: none;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
    position: absolute;
    top: 13px;
    right: 15px;
  }
  .close-btn:hover {
    color: #ff6347;
  }
  /* Content styling */
  .content {
    border: 1px solid white;
    border-radius: 5px;
    padding: 20px;
    margin: 20px auto;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .content h1 {
    text-align: center;
    text-decoration: none;
    color: black;
    font-size: 50px;
    font-weight: 1000px;
    margin-top: 15px;
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .content h1:hover {
    transform: translateX(50px);
  }
  .content p {
    font-size: 20px;
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .content p:hover {
    transform: translateX(30px);
  }
  .animated-background {
    border-radius: 10px;
    margin-top: 50px;
    height: 500px;
    background-size: cover; /* Ensure the image covers the entire background */
    background-position: center; /* Center the image */  
    animation: BgAnimation 12s linear infinite;
    transition: transform 0.3s, box-shadow 0.3s;
  }
  @keyframes BgAnimation {
    0% {
      background-image: url(IMAGES/testing1.jpg);
    }
    50% {
      background-image: url(IMAGES/testing2.jpg);
    }
    100% {
      background-image: url(IMAGES/testing3.jpg);
    }
  }
  .animated-background:hover {
    transform: translateY(5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  }
  .Benefits:hover {
    transform: translateY(5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  }
  .Book:hover {
    transform: translateY(5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  }
  .Info, .Benefits, .Book {
    border: 3px solid #eee;
    border-radius: 15px;
    box-shadow: 0 4px 80px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px 0;
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .Info h3, a {
    color: black;
  }
  .Info:hover {
    transform: translateY(5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
  }
  .conditions {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 equal columns */
    gap: 15px;
    margin-bottom: 50px;
    margin-left: 90px;
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .conditions h3 {
    margin: 0;
    font-size: 20px;
    transition: transform 0.5s, box-shadow 0.3s;
  }
  .conditions h3 a:hover {
    color: green;
    transform: translateX(30px);
  }
  .Book {
    text-align: center;
    margin: 20px 0;
    font-size: 20px;
  }
  .Book button {
    background-color: green;
    color: white;
    border-radius: 7px;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 1.2em;
    display: block;
    margin: 20px auto;
    transition: background-color 0.3s;
  }
  .Book button:hover {
    background-color: #45a049;
  }
  .Benefits h2 {
    margin-bottom: 10px;
    text-align: center;
  }
  footer {
    border: 0px solid black;
    height: 180px; /* Adjust height as needed */
    background-color: green;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
  }
  .copyright {
    text-align: center;
    margin-bottom: 10px;
    font-size: 0.9em;
  }
  .services {
    flex: 1px;
    text-align: center;
    position: relative;
    right: 110px;
  }
  .contact {
    flex: 1px;
    text-align: center;
    position: relative;
    right: 90px;
    bottom: 10.5px;
  }
  .about {
    text-align: center;
    position: relative;
    right: 70px;
    bottom: 1px;
    left: -15px;
  }
  footer p, footer a {
    margin: 5px;
    padding: 0.5px;
    color: white;
  }
  nav a img {
    margin-left: 40px;
  }
  </style>
</head>
<body>
  <nav>
    <div class="nav-left">
      <div class="hamburger-menu" id="hamburgerMenu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    <div id="menu" class="menu">
    <button id="closeMenu" class="close-btn">X</button>
      <!-- User Profile in the Menu -->
      <div class="user-profile">
          <img src="https://via.placeholder.com/50" alt="User Avatar" class="user-avatar">
          <span class="username"><?php echo htmlspecialchars($email); ?></span>
        </div>
      <ul>
        <li><a href="homepage.php">Home</a></li><br>
        <li><a href="aboutus.php">About Us</a></li><br>
        <li><a href="services.php">Our Services</a></li><br>
        <li><a href="booking.php">Book Now</a></li><br>
        <li><a href="dashboard.php">Settings</a></li><br>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
      <a href="#" onclick="location.reload()"><img src="IMAGES/logo.jpg" alt="logo1" style="height: 40px;"></a>
      <li><a style="text-decoration: none;" href="homepage.php">Home</a></li>
      <li><a style="text-decoration: none;" href="aboutus.php">About Us</a></li>
      <li><a style="text-decoration: none;" href="services.php">Our Services</a></li>
      <li><a style="text-decoration: none;" href="booking.php">Book Now</a></li>
    </div>
    <div class="container">
    <?php if (!isset($_SESSION['user_id'])): ?> <!-- Check if user is not logged in -->
                <button class="btn" onclick="showLogin()">Login</button>
                <button class="btn" onclick="showRegister()">Register</button>
            <?php else: ?> <!-- If logged in, hide the buttons -->
                
            <?php endif; ?>
    </div>
  </nav>      
    <div id="notification" class="notification" style="display: none;"></div>
      <div class="content">
    <div class="animated-background"></div>
    <h1>Healot Biomekaniks</h1>
    <p>Hello! This is HEALot Biomekaniks, a massage company that can help your body to relax and relieve stress. HEALot Biomekaniks is a 100% Filipino technology best relief for Vertigo, Migraine, Deafness, Neck pain, Stiff neck, Shoulder pain, Frozen shoulder, Chest pain, Asthma, Difficulty in Breathing, Back pain, Sciatica, Leg pain, Knee pain, and a lot more!</p>
    <div class="Info">
    <h1>What we can treat:</h1>
    <div class="conditions">
      <h3>Vertigo</h3>
      <h3>Migraine</h3>
      <h3>TMJ</h3>
      <h3>Bulging Eyes</h3>
      <h3>Deafness</h3>
      <h3>Neck Pain</h3>
      <h3>Stiff Neck</h3>
      <h3>Whiplash</h3>
      <h3>Trigeminal Neuralgia</h3>
      <h3>Frozen Shoulder</h3>
      <h3>Shoulder Pain</h3>
      <h3>Carpal Tunnel</h3>
      <h3>Chest Pain</h3>
      <h3>Asthma</h3>
      <h3>Difficulty in Breathing</h3>
      <h3>Back Pain</h3>
      <h3>Sciatica</h3>
      <h3>Polycystic Ovary Syndrome</h3>
      <h3>Hernia</h3>
      <h3>Slip Disc</h3>
      <h3>Joint Disease</h3>
      <h3>Leg Pain</h3>
      <h3>Leg Cramps</h3>
      <h3>Knee Pain</h3>
      <h3>Sprain</h3>
      <h3>Fibromyalgia</h3>
      <h3>Pliformis Syndrome</h3>
      <h3>Rheumatoid</h3>
      <h3>Osteoarthritis</h3>
      <h3><a href="services.php">and a lot more!</a></h3>
    </div>
  </div>
    <div class="Benefits">
      <h2>Benefits of Massages in your body:</h2>
      <p><strong>Pain relief:</strong> Massage can alleviate pain from conditions like chronic back pain, muscle soreness, arthritis, and tension headaches. It can also help reduce the severity and frequency of migraines.</p>
      <p><strong>Muscle relaxation and Tension release:</strong> Massage helps reduce muscle tension, relax tight muscles, and promote flexibility. It can be especially beneficial for people with muscle stiffness from overuse or injury.</p>
      <p><strong>Improved Circulation:</strong> The pressure applied during a massage stimulates blood flow, which can help deliver oxygen and nutrients to tissues and remove waste products from the body. This improved circulation can enhance overall tissue health and promote faster healing.</p>
    </div>
    <div class="Book">
      <h4>Got Interested?</h4>
      <p>Click the button below to schedule your appointment today!</p>
      <a style="text-decoration: none;" href="booking.php">
        <button>BOOK NOW!</button>
      </a>
    </div>   
    </div>
  <!-- References & Copyrights -->
    <footer>
      <div class="services">
        <p><a href="services.php">Our Services:</a></p>
        <p>Vertigo</p>
        <p>Neck Pain</p>
        <p>Migraine</p>
        <p>TMJ</p>
        <p><a href="services.php">Check More:</a></p>
      </div>
      <div class="contact">
        <div class="copyright">
          <p>© 2023 All Rights Reserved. Healot Biomekaniks</p>
        </div>
          <p style="text-decoration: underline;"><a href="aboutus.php">Contact Us:</a></p>
          <p>📞Ms. Lhey     : 09258543916 📞Ms. Archyl   : 09770076818</p>
          <p>📞Ms. Dencie   : 09255510644 📞Mr. Denver   : 09271423805</p>
          <p>📞Ms. Reyna    : 09774174556 📞Mr. Vaughn   : 09772361189</p>
          <p>📞Mr. Julius   : 09772361185</p>
        </div>
      <div class="about">
        <p><a href="aboutus.php">About Us:</a></p>
        <p>Email us at: biomekaniksph@gmail.com</p>
        <p>Facebook: Maning Gomez (Healot Biomekaniks)</p>
        <p>Youtube: HEALotBIOMEKANIKSOfficial</p>
        <p>Tiktok: Maning Gomez</p>
        <p>Instagram: Maning Gomez</p>
      </div>
    </footer>
  <script>
      document.getElementById('hamburgerMenu').addEventListener('click', function () {
        this.classList.toggle('active');
        const menu = document.getElementById('menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
      // Close the menu when the close button is clicked
      document.getElementById('closeMenu').addEventListener('click', function () {
        const menu = document.getElementById('menu');
        menu.style.display = 'none';
        document.getElementById('hamburgerMenu').classList.remove('active'); // Reset the hamburger icon
    });
      // Add click event to the username to redirect
      document.querySelector('.username').addEventListener('click', function() {
        window.location.href = 'profile.php'; // Change this URL to the actual profile page
    });
  </script>
</body>
</html> 