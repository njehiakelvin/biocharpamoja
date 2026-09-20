<?php 
$page_title = "Biochar Pamoja: We Fix Carbon";
include 'includes/header.php'; 
?>
    
<main>
    <section id="home">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 introduction order-2 order-lg-1">
                    <div class="catchphrase mb-4">
                        <h2 class="fw-bold display-4">WE FIX <span style="color: var(--primary-green);">CARBON</span></h2>
                    </div>
                    <p class="lead text-muted mb-4">We are revolutionizing biochar production and application with cutting-edge RoCC kiln, TLUD, and Panel kiln technologies. Our mission is to provide low-cost, sustainable solutions for biochar production, improving soil health, reducing carbon footprints, and creating economic opportunities for communities in Kenya and beyond.</p>
                    <div class="buttons d-flex gap-3">
                        <a href="projects.php" class="btn btn-success btn-lg rounded-pill px-4">Our Projects <i class="fas fa-arrow-right ms-2"></i></a>
                        <a href="contact.php" class="btn btn-outline-success btn-lg rounded-pill px-4">Get In Touch</a>
                    </div>
                </div>
                
                <div class="col-lg-7 heroimage order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="carousel slide carousel-fade shadow-lg rounded-4 overflow-hidden" id="heroCarousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/images/hero2.jpg" alt="Kilns" class="hero-carousel-img">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/biocharfarm.jpeg" alt="Farm" class="hero-carousel-img">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/hero1.jpg" alt="College Farm" class="hero-carousel-img">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/hero3.jpg" alt="College Farm" class="hero-carousel-img">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/images/kilnsrocc.jpeg" alt="RoCC Kilns" class="hero-carousel-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stats">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-3 stat-item">
                    <i class="fas fa-calendar-alt"></i>
                    <h2>5+</h2>
                    <p>Years Experience</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <i class="fas fa-leaf"></i>
                    <h2>170+</h2>
                    <p>Tonnes CO₂e Removed</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <i class="fas fa-users"></i>
                    <h2>1000+</h2>
                    <p>Farmers Trained</p>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <i class="fas fa-handshake"></i>
                    <h2>5+</h2>
                    <p>Women's Groups</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PROJECTS - Enhanced -->
    <section id="projects" class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Featured Projects</h2>
                <p>Each project is field-verified, community-led, and built for measurable long-term impact.</p>
            </div>
            
            <div class="row g-4">

                <!-- PROJECT 1: PowerPellet TLUD -->
                <div class="col-lg-4 col-md-6">
                    <div class="featured-project-card h-100">
                        <div class="fp-img-wrap">
                            <img src="assets/images/tlud.jpg" alt="PowerPellet TLUD Cookstoves">
                            <span class="fp-badge fp-badge-active">Active · 2023-2025</span>
                        </div>
                        <div class="fp-body">
                            <div class="fp-tags">
                                <span class="fp-tag">Clean Energy</span>
                                <span class="fp-tag">Bungoma</span>
                            </div>
                            <h4 class="fp-title">PowerPellet TLUD Cookstoves</h4>
                            <p class="fp-desc">500 clean cookstoves distributed to 14+ women's groups , reducing indoor smoke, generating biochar, and charging phones via TEG technology.</p>
                            <div class="fp-stats">
                                <div class="fp-stat">
                                    <span class="fp-val">500</span>
                                    <span class="fp-lbl">Stoves</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">14+</span>
                                    <span class="fp-lbl">Groups</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">~1t</span>
                                    <span class="fp-lbl">CO₂e/yr</span>
                                </div>
                            </div>
                            <a href="powerpellet-tlud.php" class="fp-cta">
                                View Project <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- PROJECT 2: RoCC Kilns -->
                <div class="col-lg-4 col-md-6">
                    <div class="featured-project-card h-100">
                        <div class="fp-img-wrap">
                            <img src="assets/images/news-kiln.PNG" alt="RoCC Kiln Pilots">
                            <span class="fp-badge fp-badge-completed">Pilot Completed</span>
                        </div>
                        <div class="fp-body">
                            <div class="fp-tags">
                                <span class="fp-tag">Carbon Removal</span>
                                <span class="fp-tag">Kisii · Nyakach</span>
                            </div>
                            <h4 class="fp-title">RoCC Kiln Pilots</h4>
                            <p class="fp-desc">Kenya's first fabricated Retort-Optimized Cone Kilns, built with Kisii University and KMFRI, generating 170+ tonnes of verified CO₂e removals across 3 sites.</p>
                            <div class="fp-stats">
                                <div class="fp-stat">
                                    <span class="fp-val">3</span>
                                    <span class="fp-lbl">Sites</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">170+</span>
                                    <span class="fp-lbl">t CO₂e</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">2021</span>
                                    <span class="fp-lbl">Launched</span>
                                </div>
                            </div>
                            <a href="rocc-kilns.php" class="fp-cta">
                                View Project <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- PROJECT 3: Bungoma Biochar Farming -->
                <div class="col-lg-4 col-md-6">
                    <div class="featured-project-card h-100">
                        <div class="fp-img-wrap">
                            <img src="assets/images/biocharfarm.jpeg" alt="Bungoma Biochar Farming">
                            <span class="fp-badge fp-badge-ongoing">Ongoing</span>
                        </div>
                        <div class="fp-body">
                            <div class="fp-tags">
                                <span class="fp-tag">Agriculture</span>
                                <span class="fp-tag">Bungoma</span>
                            </div>
                            <h4 class="fp-title">Bungoma Biochar Farming</h4>
                            <p class="fp-desc">Training 1,000+ farmers to turn crop residues into biochar, boosting maize yields 20-30% and creating carbon credit income for smallholder families.</p>
                            <div class="fp-stats">
                                <div class="fp-stat">
                                    <span class="fp-val">1,000+</span>
                                    <span class="fp-lbl">Farmers</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">+30%</span>
                                    <span class="fp-lbl">Yield</span>
                                </div>
                                <div class="fp-stat">
                                    <span class="fp-val">5+</span>
                                    <span class="fp-lbl">Groups</span>
                                </div>
                            </div>
                            <a href="bungoma-biochar.php" class="fp-cta">
                                View Project <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row mt-5">
                <div class="col text-center">
                    <a href="projects.php" class="fp-cta">
                                View All Projects <i class="fas fa-arrow-right"></i>
                            </a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Featured project cards — home page */
.featured-project-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}
.featured-project-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.12);
}
.fp-img-wrap {
    position: relative;
    height: 220px;
    overflow: hidden;
}
.fp-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}
.featured-project-card:hover .fp-img-wrap img { transform: scale(1.06); }

.fp-badge {
    position: absolute;
    top: 14px; left: 14px;
    border-radius: 50px;
    padding: 4px 12px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.4px;
}
.fp-badge-active   { background: rgba(25,135,84,0.92); color: white; }
.fp-badge-completed{ background: rgba(13,110,253,0.85); color: white; }
.fp-badge-ongoing  { background: rgba(230,81,0,0.85);  color: white; }

.fp-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.fp-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; }
.fp-tag {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 50px;
    padding: 2px 10px;
    font-size: 0.73rem;
    font-weight: 600;
    color: var(--text-muted);
}
.fp-title { font-size: 1.2rem; font-weight: 800; margin-bottom: 8px; color: var(--text-main); }
.fp-desc  { color: var(--text-muted); font-size: 0.9rem; line-height: 1.7; flex: 1; margin-bottom: 18px; }

.fp-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border-color);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 18px;
}
.fp-stat {
    background: var(--bg-secondary);
    padding: 10px 6px;
    text-align: center;
    display: flex;
    flex-direction: column;
}
.fp-val {
    font-weight: 900;
    font-size: 1.05rem;
    color: var(--primary-green);
    line-height: 1.1;
}
.fp-lbl {
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-top: 2px;
}
.fp-cta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--primary-green);
    color: white;
    border-radius: 10px;
    padding: 11px 18px;
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.25s;
}
.fp-cta:hover { background: var(--logo-teal); color: white; }
.fp-cta i { transition: transform 0.25s; }
.fp-cta:hover i { transform: translateX(4px); }
</style>

<?php include 'includes/footer.php'; ?>
