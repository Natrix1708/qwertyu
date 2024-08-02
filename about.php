<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - HRMS</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #FAF3E0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: transparent;
        }

        header .logo {
            height: 20px;
        }


        .sidebar {
            width: 15%;
            background-color: #FAF3E0;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Changed to flex-start to align items at the top */
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .sidebar .top, .sidebar .bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: #000000;
            text-decoration: none;
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }

        .sidebar a:hover {
            background-color: #F8A455;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
        }
        nav ul li {
            text-align: center;
            margin: 15px 0;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px 0;
            display: block;
            width: 100%;
        }
        nav ul li a:hover {
            background-color: #575757;
        }
        .divider {
            position: absolute;
            left: 15%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ff4c61;
        }
        .main-content {
            width: 85%;
            padding: 20px;
            overflow-y: auto;
            margin-left: 10px;
            border-radius: 10px;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            margin-top: 20px;
        }
        .about-section h1, .about-section h2 {
            color: #333;
        }
        .about-section p, .about-section ul {
            color: #666;
        }
        .about-section ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .about-section ul li {
            margin-bottom: 10px;
        }
        .divider {
            position: absolute;
            left: 15%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ff4c61; /* Updated divider color */
        }

        .sidebar h1 {
            margin: 0;
            font-size: 24px;
            color: #ff4c61; /* Updated color */
            margin-bottom: 20px; /* Added margin to separate from links */
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="Logo1.1.png" alt="HRMS Logo">
            <br>
            <br>
        </div>
        <a href="main.php">HOME</a>
        <a href="add_cv.php">ADD CV</a>
        <a href="list_cv.php">CVs LIST</a>
        <a href="archive.php">ARCHIVE</a>
        <a href="statistics.php">STATISTICS</a>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <br>
    <div class="bottom">
        <a href="about.php">ABOUT</a>
        <a href="faq.php">FAQ</a>
        <a href="contacts.php">CONTACTS</a>
    </div>
</div>
<div class="divider"></div>
    <div class="main-content">
        <div class="container">
            <section class="about-section">
                <h1>About Us</h1>
                <p>Welcome to our Human Resource Management System, your go-to platform for efficient resume management and HR process optimization.</p>
                
                <h2>Our Mission</h2>
                <p>Our mission is to simplify and enhance the HR operations of companies by providing a centralized, user-friendly system for managing resumes and other HR tasks. We aim to empower HR departments with tools that streamline their workflow and improve overall efficiency.</p>
                
                <h2>What We Do</h2>
                <p>Our platform offers a comprehensive solution for storing, sorting, and managing resumes. By automating these processes, we enable HR professionals to focus on what truly matters – finding and nurturing the best talent for their organizations.</p>
                
                <h2>Why Choose Us?</h2>
                <ul>
                    <li><strong>Efficiency:</strong> Our system significantly reduces the time spent on manual resume management and sorting.</li>
                    <li><strong>Organization:</strong> A centralized database ensures that all resumes are stored securely and can be accessed easily.</li>
                    <li><strong>Scalability:</strong> As your company grows, our platform can expand to meet your needs, supporting an increasing number of resumes and HR functions.</li>
                    <li><strong>User-Friendly Interface:</strong> Designed with ease of use in mind, our platform ensures a smooth and intuitive experience for all users.</li>
                </ul>
                
                <h2>Our Vision</h2>
                <p>We envision a future where HR departments can operate at their highest potential, with technology seamlessly supporting every aspect of their work. Our goal is to be a key player in this transformation, providing innovative solutions that drive the success of businesses worldwide.</p>
                
                <h2>Modernization Plans</h2>
                <p>We are constantly working on improving our system and are excited to share our modernization plans. In the future, we plan to expand the functionality of our platform by adding the capability to send resumes directly to department heads and company executives. This will enable more efficient and accurate allocation of human resources, enhancing the transparency and effectiveness of the hiring process. We believe these improvements will help your company become even more dynamic and successful.</p>
            </section>
        </div>
    </div>
</body>
</html>
