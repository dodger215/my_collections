<?php

$jsonData = file_get_contents('../data.json');


$data = json_decode($jsonData, true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
      
</head>
<body class="dark-mode">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init(); 
    </script>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="load">
                <div class="container-load">
                    <div class="cube"><div class="cube__inner"></div></div>
                    <div class="cube"><div class="cube__inner"></div></div>
                    <div class="cube"><div class="cube__inner"></div></div>
                </div>
        </div>
        <div class="container">
            <a class="navbar-brand" href="#">My Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="text-center py-5 d-flex align-items-center" data-aos="fade-up">
        <div class="container d-flex flex-column flex-md-row align-items-center">
            <!-- Text Section -->
            <div class="text-center text-md-start">
                <h1 class="display-4 text-light">Hi Guys, I'm Kelvin Enos-Dzah</h1>
                <p class="lead text-secondary">A creative designer crafting unique and stunning visuals.</p>
                <a href="#portfolio" class="btn btn-primary link">View My Work</a>
            </div>
            <!-- Profile Picture Section -->
            <div class="profile-container text-center mt-4 mt-md-0 ms-md-5">
                <img src="profile.png" alt="Your Profile Picture" class="profile-img">
            </div>
        </div>
    </section>

    <section id="portfolio" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center text-light mb-4">My Work</h2>
            
            <!-- Category Navigation -->

            <!-- Portfolio Items -->
            <div class="row g-4" id="portfolio-items">
                <!-- Portfolio Item - Logo -->
                <div class="row">
            <?php
            if (!empty($data)) {
                foreach ($data as $work) {
                    echo '
                    <div class="portfolio-item" data-category="' . htmlspecialchars($work['type']) . '">
                        <div class="card bg-dark text-light">
                            <div class="img-logo">
                            <img src="../' . htmlspecialchars($work['image']) . '" class="card-img-top" alt="' . htmlspecialchars($work['title']) . '">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($work['title']) . '</h5>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No data found!</p>';
            }
            ?>
            </div>
        </div>
    </section>

    <div class="dialog error">
        <div class="container">
            <i class="fas fa-times close-icon"></i>
            <h5 class="show_error" style="text-align: center; color: rgb(27, 27, 27); font-weight: 600; opacity: 60%; margin: 10px 0;"></h5>     
            <button class="btn btn-danger disable">close</button>
        </div>       
    </div>

    <div class="view-container">
        <div class="view-main">
            <button class="btn btn-danger disable">close</button>
            <div class="view" data-category="' . htmlspecialchars($work['type']) . '">
                <div class="content">
                    <div class="img-view">
                        <img src="../' . htmlspecialchars($work['image']) . '" class="card-img-top" alt="' . htmlspecialchars($work['title']) . '">
                    </div>
                </div>  
            </div>  
        </div>
          
    </div>


    <!-- About Section -->
    <section id="about" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center text-light mb-4">About Me</h2>
            <p class="text-center text-light">
                I am a designer with a passion for creating beautiful and user-friendly designs. My expertise includes designing, branding, and illustration.
                With <span class="year"></span> years of experience in graphic design, I am proficient in using Adobe Photoshop and Adobe Illustrator. And skilled in Web Development.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
     <div class="load">
        <div class="container-load">
            <div class="cube"><div class="cube__inner"></div></div>
            <div class="cube"><div class="cube__inner"></div></div>
            <div class="cube"><div class="cube__inner"></div></div>
        </div>
     </div>

     <div class="loader">
        <div class="container-loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
     </div>
    
    <section id="contact" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center text-light mb-4">Contact Me</h2>
            <form id="contact-form">
                <div class="mb-3">
                    <label for="name" class="form-label text-light">Your Name</label>
                    <input type="text" class="form-control bg-dark text-light border-0" id="name" name="user_name" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-light">Your Email</label>
                    <input type="email" class="form-control bg-dark text-light border-0" id="email" name="user_email" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label text-light">Message</label>
                    <textarea class="form-control bg-dark text-light border-0" id="message" name="message" rows="4" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>            
            <fieldset>
                <span class="text-light d-flex align-items-center">OR</span>
                <p class="d-flex align-items-center">
                    Contact Me On: 
                    <span id="phone-number" class="ms-2">+233 53 7946 174</span>
                    <button class="btn btn-primary btn-sm ms-2" id="copy-btn" title="Copy Number">
                        <i class="bi bi-clipboard"></i>
                    </button>
                </p>
            </fieldset>
            
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-secondary">
        <p>&copy; 2024 Portfolio. All Rights Reserved.</p>
        <p> Designed and developed by Kelvin Enos-Dzah</p>
    </footer>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="function.js"></script>
    
</body>
</html>
