<?php
$page_title = "RoCC Kiln Pilots – Kisii & Nyakach";
include '../includes/header.php';
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
.rocc-hero {
    background: url('../assets/images/kilnsrocc.jpeg') no-repeat center center / cover;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: -80px;
    padding-top: 80px;
}
.rocc-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 50%, rgba(0,139,139,0.4));
}
.rocc-hero-content { position: relative; z-index: 2; }

.project-breadcrumb {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    font-size: 0.88rem;
}
.project-breadcrumb a { color: var(--primary-green); }
.project-breadcrumb .separator { margin: 0 8px; color: var(--text-muted); }

.impact-strip {
    background: linear-gradient(135deg, var(--logo-teal), var(--primary-green));
    color: white;
    padding: 50px 0;
}
.impact-strip .stat-num { font-size: 2.8rem; font-weight: 900; line-height: 1; }
.impact-strip .stat-label { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.9; }

.info-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 15px;
    padding: 30px;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}
.info-card:hover { transform: translateY(-5px); }
.info-card .icon-wrap {
    width: 56px; height: 56px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 18px; font-size: 1.3rem;
}

/* Process timeline */
.process-step {
    display: flex;
    gap: 20px;
    margin-bottom: 36px;
    position: relative;
}
.process-step:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 22px;
    top: 48px;
    width: 2px;
    height: calc(100% - 12px);
    background: var(--border-color);
}
.step-number {
    flex-shrink: 0;
    width: 46px; height: 46px;
    border-radius: 50%;
    background: var(--primary-green);
    color: white;
    display: flex; align-items: center; justify-content: center;
    font-weight: 900;
    font-size: 1.1rem;
}
.step-body { padding-top: 8px; }

.section-alt { background-color: var(--bg-secondary); }

.spec-table td, .spec-table th {
    padding: 12px 16px;
    border-color: var(--border-color);
    background: var(--bg-card);
    color: var(--text-main);
}
.spec-table th { background: var(--bg-secondary); font-weight: 700; }

.partner-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 50px;
    padding: 10px 20px;
    font-weight: 600;
    box-shadow: var(--shadow);
}
</style>

<!-- Breadcrumb -->
<div class="project-breadcrumb">
    <div class="container">
        <a href="../index.php">Home</a>
        <span class="separator">›</span>
        <a href="../projects.php">Projects</a>
        <span class="separator">›</span>
        <span style="color: var(--text-muted);">RoCC Kiln Pilots – Kisii & Nyakach</span>
    </div>
</div>

<!-- HERO -->
<section class="rocc-hero">
    <div class="rocc-hero-overlay"></div>
    <div class="rocc-hero-content text-center text-white px-3" data-aos="zoom-in" data-aos-duration="1000">
        <span class="badge mb-3 px-3 py-2" style="background: var(--logo-teal); font-size:0.9rem; letter-spacing:1px;">BIOCHAR PRODUCTION PROJECT</span>
        <h1 class="display-3 fw-bold mb-3">RoCC Kiln Pilots</h1>
        <p class="lead mb-4" style="max-width:650px; margin:0 auto 28px;">Kenya's first fabricated Retort-Optimized Cone Kilns — tested in Kisii, Nyakach, and Ahero in collaboration with Kisii University and KMFRI.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#overview" class="btn btn-success btn-lg rounded-pill px-4">About the Kiln <i class="fas fa-arrow-down ms-2"></i></a>
            <a href="../contact.php" class="btn btn-outline-light btn-lg rounded-pill px-4">Partner With Us</a>
        </div>
    </div>
</section>

<!-- IMPACT STRIP -->
<div class="impact-strip">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-num">3</div>
                <div class="stat-label mt-1">Pilot Sites</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-num">2021</div>
                <div class="stat-label mt-1">First Units Fabricated</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-num">170+</div>
                <div class="stat-label mt-1">Tonnes CO₂e Removed</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-num">2</div>
                <div class="stat-label mt-1">Research Partners</div>
            </div>
        </div>
    </div>
</div>

<!-- OVERVIEW -->
<section id="overview" class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="text-uppercase fw-bold" style="color: var(--primary-green); letter-spacing:2px; font-size:0.85rem;">The Technology</span>
                <h2 class="fw-bold mt-2 mb-4">What is the RoCC Kiln?</h2>
                <p class="text-muted mb-4" style="line-height:1.9;">
                    The RoCC (Retort-Optimized Cone Kiln) was designed by Dr. Paul S. Anderson — "Dr. TLUD" — as a scalable solution for producing high-quality biochar from agricultural waste. Unlike open-burn methods, the RoCC kiln uses a retort mechanism to capture combustion gases and combust them cleanly, dramatically reducing emissions while maximizing biochar yield.
                </p>
                <p class="text-muted" style="line-height:1.9;">
                    In 2021, Biochar Pamoja partnered with Kisii University to fabricate the first RoCC kiln units ever built in Kenya. These were then field-tested across three sites — Kisii, Nyakach, and Ahero — generating critical local data on performance, feedstock suitability, and farmer adoption.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="../assets/images/news-kiln.PNG" alt="RoCC Kiln" class="w-100 rounded-4 shadow" style="object-fit:cover; height:380px;">
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>How the RoCC Kiln Works</h2>
            <p class="text-muted">A four-stage pyrolysis process that turns crop residue into stable biochar.</p>
        </div>
        <div class="row g-5 align-items-start">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-body">
                        <h6 class="fw-bold mb-1">Load & Ignite</h6>
                        <p class="text-muted mb-0">Agricultural biomass (maize cobs, sugarcane bagasse, rice husks) is packed into the cone kiln. The top layer is ignited, initiating top-lit combustion that burns downward.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-body">
                        <h6 class="fw-bold mb-1">Pyrolysis Zone</h6>
                        <p class="text-muted mb-0">As the flame front moves down, the biomass below undergoes oxygen-limited thermal decomposition — pyrolysis — converting it to biochar without burning it away.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-body">
                        <h6 class="fw-bold mb-1">Gas Combustion</h6>
                        <p class="text-muted mb-0">The retort design routes syngas and volatile compounds back through the combustion zone, burning them cleanly and providing additional heat — dramatically cutting smoke and emissions.</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-body">
                        <h6 class="fw-bold mb-1">Quench & Harvest</h6>
                        <p class="text-muted mb-0">Once pyrolysis completes, the biochar is quenched with water to stop combustion. The resulting stable carbon is crushed, quality-tested, and applied to farm soils or sold as carbon credits.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="info-card">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-green);">Technical Specifications</h5>
                    <table class="table spec-table rounded overflow-hidden">
                        <tbody>
                            <tr><th>Kiln Type</th><td>Retort-Optimized Cone (RoCC)</td></tr>
                            <tr><th>Designer</th><td>Dr. Paul S. Anderson (Dr. TLUD)</td></tr>
                            <tr><th>Fabrication</th><td>Kisii University, Kenya (2021)</td></tr>
                            <tr><th>Feedstock</th><td>Maize cobs, sugarcane bagasse, rice husks, wood waste</td></tr>
                            <tr><th>Biochar Yield</th><td>~25–35% of dry biomass weight</td></tr>
                            <tr><th>Carbon Stability</th><td>H/C ratio &lt;0.7 (IBI standard)</td></tr>
                            <tr><th>Pilot Sites</th><td>Kisii, Nyakach, Ahero</td></tr>
                            <tr><th>CO₂e Removed</th><td>170+ tonnes (to 2023)</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESULTS & IMPACT -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Pilot Results & Impact</h2>
            <p class="text-muted">What we learned from Kenya's first field-tested RoCC kilns.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="info-card">
                    <div class="icon-wrap bg-success bg-opacity-10">
                        <i class="fas fa-seedling text-success"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Soil Health Gains</h6>
                    <p class="text-muted mb-0">Biochar applied in Bungoma County pilot farms showed maize yield increases of 20–30%, improving water retention and reducing fertiliser requirements in the region's tropical soils.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="info-card">
                    <div class="icon-wrap bg-primary bg-opacity-10">
                        <i class="fas fa-cloud text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Carbon Removal Verified</h6>
                    <p class="text-muted mb-0">By 2023, over 170 tonnes of CO₂e had been durably removed and verified — setting the foundation for Biochar Pamoja's transition to digital MRV with CharTrac GPS tracking and blockchain records.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="info-card">
                    <div class="icon-wrap bg-warning bg-opacity-10">
                        <i class="fas fa-flask text-warning"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Local Fabrication Proven</h6>
                    <p class="text-muted mb-0">The Kisii University partnership demonstrated that RoCC kilns can be fabricated cost-effectively within Kenya, using locally available steel and skilled welders — a key step toward regional scale-up.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="info-card">
                    <div class="icon-wrap" style="background: rgba(230,81,0,0.1);">
                        <i class="fas fa-users" style="color: var(--logo-orange);"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Farmer Training</h6>
                    <p class="text-muted mb-0">Over 1,000 farmers across pilot counties were trained on biochar production, application rates, and soil amendment techniques — building a self-sustaining community of practitioners.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="info-card">
                    <div class="icon-wrap bg-info bg-opacity-10">
                        <i class="fas fa-recycle text-info"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Waste to Value</h6>
                    <p class="text-muted mb-0">Agricultural residues that were previously burned openly or left to decompose are now feedstock for biochar production — turning a waste problem into an economic and environmental asset.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="info-card">
                    <div class="icon-wrap bg-success bg-opacity-10">
                        <i class="fas fa-chart-line text-success"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Scaling to Panel Kilns</h6>
                    <p class="text-muted mb-0">Lessons from the RoCC pilots directly informed the 2024 transition to Panel Kilns — a more modular and scalable design — alongside the adoption of CharTrac Digital MRV for carbon credit tracking.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PHOTO GALLERY -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Field Gallery</h2>
            <p class="text-muted">From fabrication to field deployment — the RoCC kilns in action.</p>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <img src="../assets/images/kilnsrocc.jpeg" alt="RoCC Kiln" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <img src="../assets/images/news-kiln.PNG" alt="Kiln fabrication" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <img src="../assets/images/biocharfarm.jpeg" alt="Biochar on farm" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <img src="../assets/images/hero1.jpg" alt="Field work" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <img src="../assets/images/hero2.jpg" alt="Kiln operation" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <img src="../assets/images/hero3.jpg" alt="Community training" class="w-100 rounded-3 shadow-sm" style="height:240px; object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- PARTNERS -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Research Partners</h2>
            <p class="text-muted">Collaborators who made Kenya's first RoCC kiln pilots possible.</p>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up">
            <div class="partner-badge">
                <i class="fas fa-university" style="color: var(--primary-green);"></i>
                <span>Kisii University</span>
            </div>
            <div class="partner-badge">
                <i class="fas fa-fish" style="color: var(--logo-teal);"></i>
                <span>KMFRI – Kenya Marine & Fisheries Research Institute</span>
            </div>
            <div class="partner-badge">
                <i class="fas fa-user-tie" style="color: var(--logo-orange);"></i>
                <span>Dr. Paul S. Anderson – Woodgas International</span>
            </div>
            <div class="partner-badge">
                <i class="fas fa-leaf" style="color: var(--primary-green);"></i>
                <span>Biochar Pamoja – Gilbert Mwangi</span>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, var(--logo-teal), var(--primary-green)); color: white;">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Interested in RoCC Kiln Technology?</h2>
        <p class="lead mb-4 opacity-75" data-aos="fade-up">We offer training, fabrication partnerships, and carbon credit pathways for organisations and counties across Kenya.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up">
            <a href="../contact.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold" style="color: var(--logo-teal);">Get in Touch</a>
            <a href="../projects.php" class="btn btn-outline-light btn-lg rounded-pill px-4">View All Projects</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ once: true, offset: 80, duration: 800 });</script>

<?php include '../includes/footer.php'; ?>
