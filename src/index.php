<?php include "header.php" ?>
<?php 
include "connection.php";
?>  
<body>
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1>Welcome to Cheese Cake Shop</h1>
            <h2>Cheese is better when it's on a cake</h2>
            <a href="subcategory.php" class="btn-get-started">Get Started</a>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Contact Section ======= -->
        <section id="contact">
            <div class="container">
                <div class="section-header">
                    <h3 class="section-title">Contact


                    </h3>
                    <p class="section-description">Contact us via email, phone or fill up the form.</p>
                </div>
            </div>

            <!-- Uncomment below if you wan to use dynamic maps -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424146.1026707229!2d150.6517951944037!3d-33.8473567183704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b129838f39a743f%3A0x3017d681632a850!2sSydney%20NSW%2C%20Australia!5e0!3m2!1sen!2snp!4v1652982330277!5m2!1sen!2snp" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="container mt-5">
                <div class="row justify-content-center">

                    <div class="col-lg-3 col-md-4">

                        <div class="info">
                            <div>
                                <i class="bi bi-geo-alt"></i>
                                <p>Penshurst <br> Sydney</p>
                            </div>

                            <div>
                                <i class="bi bi-envelope"></i>
                                <p>info@cheesecakeshopt.com</p>
                            </div>

                            <div>
                                <i class="bi bi-phone"></i>
                                <p>+1 5589 55488 55s</p>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>

                    </div>

                    <div class="col-lg-5 col-md-8">
                        <div class="form">
                            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center"><button type="submit">Send Message</button></div>
                            </form>
                        </div>
                    </div>

                </div>


            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
</body>
<?php include "footer.php" ?>