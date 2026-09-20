<?php
$page_title = "Contact Us, Biochar Pamoja";
include 'includes/header.php';
?>

<style>
.contact-hero {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--logo-teal) 100%);
    padding: 70px 0 50px;
    color: white;
    text-align: center;
}
.contact-hero h1 { font-weight: 900; }
.contact-hero p  { opacity: 0.85; max-width: 520px; margin: 10px auto 0; }

.info-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 36px 32px;
    box-shadow: var(--shadow);
    height: 100%;
}
.info-item {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    padding: 18px 0;
    border-bottom: 1px solid var(--border-color);
}
.info-item:last-child { border-bottom: none; padding-bottom: 0; }
.info-icon {
    width: 46px; height: 46px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.05rem;
}
.info-label  { font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 3px; }
.info-value  { color: var(--text-main); font-weight: 500; }
.info-value a { color: var(--text-main); }
.info-value a:hover { color: var(--primary-green); }

.form-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    padding: 36px 32px;
    box-shadow: var(--shadow);
}

/* Override Bootstrap form-floating for dark mode */
.form-floating > .form-control,
.form-floating > .form-select {
    background-color: var(--bg-secondary);
    color: var(--text-main);
    border-color: var(--border-color);
    border-radius: 10px;
}
.form-floating > .form-control:focus {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 0.22rem rgba(25,135,84,0.22);
    background-color: var(--bg-secondary);
    color: var(--text-main);
}
.form-floating > label { color: var(--text-muted); }

body.dark-mode .form-floating > .form-control,
body.dark-mode .form-floating > .form-select {
    background-color: #2d2d2d;
    border-color: #404040;
    color: #e0e0e0;
}
body.dark-mode .form-floating > .form-control:focus {
    background-color: #333;
    color: #fff;
}
body.dark-mode .form-floating > label { color: #b0b0b0; }

.btn-send {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    border: none;
    color: white;
    border-radius: 12px;
    padding: 14px 28px;
    font-weight: 700;
    width: 100%;
    font-size: 1rem;
    transition: opacity 0.25s, transform 0.25s;
}
.btn-send:hover { opacity: 0.9; transform: translateY(-2px); color: white; }

.map-wrap {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
}

/* Social links */
.social-links { display: flex; gap: 12px; margin-top: 24px; }
.social-link {
    width: 42px; height: 42px;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted);
    font-size: 1rem;
    transition: all 0.25s;
    text-decoration: none;
}
.social-link:hover { background: var(--primary-green); color: white; border-color: var(--primary-green); }
</style>

<!-- HERO -->
<section class="contact-hero">
    <div class="container">
        <span class="badge bg-white text-success fw-bold px-3 py-2 mb-3" style="font-size:0.82rem;letter-spacing:1px;">GET IN TOUCH</span>
        <h1 class="display-5 mb-2">Contact Us</h1>
        <p class="lead">We would love to hear from you, whether it's about partnerships, research, or bringing biochar to your community.</p>
    </div>
</section>

<section class="py-5" style="background:var(--bg-body);">
    <div class="container">

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i><strong>Message sent!</strong> We will get back to you soon.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            } elseif ($_GET['status'] == 'error') {
                echo '<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Something went wrong.</strong> Please try again or email us directly.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            } elseif ($_GET['status'] == 'invalid') {
                echo '<div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i><strong>Invalid input.</strong> Please check your fields and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }
        }
        ?>

        <div class="row g-4 align-items-start">

            <!-- Info card -->
            <div class="col-lg-4">
                <div class="info-card">
                    <h4 class="fw-bold mb-4" style="color:var(--primary-green);">Contact Information</h4>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value">Bungoma, Kenya</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div class="info-label">Email</div>
                            <div class="info-value"><a href="mailto:info@biocharpamoja.co.ke">info@biocharpamoja.co.ke</a></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <div class="info-label">Phone</div>
                            <div class="info-value"><a href="tel:+254723545858">+254 723 545 858</a></div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-box"></i></div>
                        <div>
                            <div class="info-label">Postal Address</div>
                            <div class="info-value">P.O Box 1157-50200, Bungoma</div>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="#" class="social-link" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" title="Twitter / X"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Form card -->
            <div class="col-lg-8">
                <div class="form-card">
                    <h4 class="fw-bold mb-1">Send Us a Message</h4>
                    <p class="text-muted mb-4">Fill in the form and we'll get back to you within 2 business days.</p>

                    <form action="assets/php/process-contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="Firstname" id="firstName" placeholder="First Name" required>
                                    <label for="firstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="Email" id="emailAddr" placeholder="Email" required>
                                    <label for="emailAddr">Email Address</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-control form-select" name="Subject" id="subject">
                                        <option value="" disabled selected>Select a subject</option>
                                        <option value="Partnership">Partnership Inquiry</option>
                                        <option value="Biochar">Biochar / Soil Amendment</option>
                                        <option value="Cookstoves">TLUD Cookstoves</option>
                                        <option value="Carbon">Carbon Credits</option>
                                        <option value="Research">Research Collaboration</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="Message" id="messageBox" placeholder="Message" style="height:160px;" required></textarea>
                                    <label for="messageBox">Your Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn-send" type="submit">Send Message <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127720.67860484783!2d34.49735!3d0.56985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x17806462d5dc76d7%3A0x69d76e6a7fc31a27!2sBungoma%2C%20Kenya!5e0!3m2!1sen!2ske!4v1700000000000"
                        width="100%" height="360" style="border:0;display:block;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
