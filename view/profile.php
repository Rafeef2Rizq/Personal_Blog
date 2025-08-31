<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Designer & Developer</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f5f7fa;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 2rem;
    }

    .profile-header {
      display: flex;
      align-items: center;
      gap: 2rem;
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      margin-bottom: 2rem;
    }

    .profile-header img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #0077b6;
    }

    .profile-header h1 {
      font-size: 2rem;
      margin-bottom: .5rem;
    }

    .profile-header p {
      color: #555;
    }

    section {
      margin-bottom: 2rem;
      background: #fff;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    section h2 {
      margin-bottom: 1rem;
      color: #0077b6;
    }

    .skills-list, .projects-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1rem;
    }

    .skill, .project {
      background: #f0f9ff;
      padding: 1rem;
      border-radius: 10px;
      text-align: center;
      transition: transform 0.2s ease;
    }

    .skill:hover, .project:hover {
      transform: translateY(-5px);
    }

    .footer {
      text-align: center;
      margin-top: 2rem;
      padding: 1rem;
      color: #666;
    }

    .btn {
      display: inline-block;
      padding: 0.6rem 1.2rem;
      margin-top: 1rem;
      background: #0077b6;
      color: #fff;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #023e8a;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Profile Header -->
    <div class="profile-header">
      <img src="https://via.placeholder.com/150" alt="Profile Picture">
      <div>
        <h1>Rafeef Rezeq</h1>
        <p>Software Engineer | Web Developer | Freelancer</p>
        <a href="mailto:rfyfrzq7@gmail.com" class="btn">Contact Me</a>
      </div>
    </div>

    <!-- About Section -->
    <section>
      <h2>About Me</h2>
      <p>
        I am a creative and detail-oriented software engineer with expertise in web development 
        and UI/UX design. Passionate about building modern, user-friendly applications with clean 
        and efficient code.
      </p>
    </section>

    <!-- Skills Section -->
    <section>
      <h2>Skills</h2>
      <div class="skills-list">
        <div class="skill">HTML5 / CSS3</div>
        <div class="skill">JavaScript (ES6+)</div>
        <div class="skill">PHP & Laravel</div>
        <div class="skill">WordPress</div>
        <div class="skill">MySQL</div>
        <div class="skill">UI/UX Design</div>
      </div>
    </section>

    <!-- Projects Section -->
    <section>
      <h2>Projects</h2>
      <div class="projects-list">
        <div class="project">BookHaven - Online Bookstore</div>
        <div class="project">Food Reservation System</div>
        <div class="project">Personal Blog Platform</div>
        <div class="project">School Management System</div>
      </div>
    </section>

    <!-- Footer -->
    <div class="footer">
      &copy; 2025 Rafeef Rezeq. All rights reserved.
    </div>
  </div>
</body>
</html>
