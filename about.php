<?php
$page_title = "About Us, Biochar Pamoja";
include 'includes/header.php';
?>

<style>
/* ── About Hero ── */
.about-hero {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--logo-teal) 100%);
    padding: 80px 0 60px;
    color: white;
}
.about-hero h1 { font-weight: 900; }

/* ── Mission / Vision cards ── */
.mv-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 32px 28px;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
    position: relative;
    overflow: hidden;
}
.mv-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 4px;
}
.mv-card.green::before { background: var(--primary-green); }
.mv-card.teal::before  { background: var(--logo-teal); }
.mv-card.orange::before{ background: var(--logo-orange); }
.mv-card:hover { transform: translateY(-5px); }
.mv-icon {
    width: 56px; height: 56px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 18px; font-size: 1.3rem; color: white;
}

/* ── Team ── */
.team-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 28px 24px;
    text-align: center;
    box-shadow: var(--shadow);
    height: 100%;
    transition: transform 0.3s;
}
.team-card:hover { transform: translateY(-5px); }
.team-avatar-lg {
    width: 90px; height: 90px;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 2rem; color: white;
}

/* ── Timeline ── */
.timeline {
    position: relative;
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 0;
}
.timeline::after {
    content: '';
    position: absolute;
    width: 4px;
    background: var(--primary-green);
    top: 0; bottom: 0;
    left: 50%;
    margin-left: -2px;
}
.tl-container {
    padding: 10px 48px;
    position: relative;
    width: 50%;
}
.tl-left  { left: 0; }
.tl-right { left: 50%; }

.tl-container::after {
    content: '';
    position: absolute;
    width: 20px; height: 20px;
    right: -10px;
    background: var(--bg-body);
    border: 4px solid var(--logo-orange);
    top: 28px;
    border-radius: 50%;
    z-index: 1;
}
.tl-right::after { left: -10px; right: auto; }

.tl-content {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 22px 26px;
    box-shadow: var(--shadow);
}
.tl-year {
    color: var(--primary-green);
    font-weight: 900;
    font-size: 1.8rem;
    display: block;
    margin-bottom: 6px;
}
.tl-title { font-weight: 700; margin-bottom: 8px; color: var(--text-main); }
.tl-text  { color: var(--text-muted); font-size: 0.93rem; line-height: 1.7; margin: 0; }

/* ── Values ── */
.value-item {
    display: flex;
    gap: 18px;
    align-items: flex-start;
    margin-bottom: 28px;
}
.value-num {
    flex-shrink: 0;
    width: 44px; height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white;
    display: flex; align-items: center; justify-content: center;
    font-weight: 900; font-size: 1rem;
}

/* ── Stats ── */
.about-stats {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white; padding: 60px 0;
}
.about-stats .s-num { font-size: 2.8rem; font-weight: 900; line-height: 1; }
.about-stats .s-lbl { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.88; margin-top: 4px; }

.section-alt { background-color: var(--bg-secondary); }

/* Mobile timeline */
@media (max-width: 767px) {
    .timeline::after { left: 28px; }
    .tl-container { width: 100%; padding-left: 64px; padding-right: 16px; }
    .tl-container::after { left: 18px; right: auto; }
    .tl-right { left: 0; }
}
</style>

<!-- HERO -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge bg-white text-success fw-bold px-3 py-2 mb-3" style="font-size:0.82rem;letter-spacing:1px;">OUR STORY</span>
                <h1 class="display-4 mb-4">About Biochar Pamoja</h1>
                <p class="lead mb-4" style="opacity:0.9;">We believe in transforming agricultural waste into an opportunity for farmers, communities, and the planet. Founded in Kenya, we combine local innovation with global expertise to deliver clean energy, sustainable agriculture, and verified carbon removals.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="projects.php" class="btn btn-light fw-bold rounded-pill px-4" style="color:var(--primary-green);">Our Projects</a>
                    <a href="contact.php" class="btn btn-outline-light rounded-pill px-4">Get in Touch</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="assets/images/biocharfarm.jpeg" alt="Biochar Pamoja" class="w-100 rounded-4 shadow-lg" style="height:380px;object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="about-stats">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3"><div class="s-num">5+</div><div class="s-lbl">Years Experience</div></div>
            <div class="col-6 col-md-3"><div class="s-num">170+</div><div class="s-lbl">Tonnes CO₂e Removed</div></div>
            <div class="col-6 col-md-3"><div class="s-num">1,000+</div><div class="s-lbl">Farmers Trained</div></div>
            <div class="col-6 col-md-3"><div class="s-num">500</div><div class="s-lbl">Cookstoves Distributed</div></div>
        </div>
    </div>
</div>

<!-- MISSION / VISION / VALUES -->
<section class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>What Drives Us</h2>
            <p class="text-muted">The principles that guide every kiln fired and every farmer trained.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="mv-card green">
                    <div class="mv-icon" style="background:linear-gradient(135deg,var(--primary-green),#2e7d32);">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Our Mission</h5>
                    <p class="text-muted mb-0">To provide low-cost, scalable biochar solutions that improve soil health, reduce carbon footprints, and create economic opportunities for farming communities in Kenya and beyond.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mv-card teal">
                    <div class="mv-icon" style="background:linear-gradient(135deg,var(--logo-teal),#006666);">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Our Vision</h5>
                    <p class="text-muted mb-0">A Kenya where every smallholder farm produces its own biochar, eliminates crop waste burning, and earns verified carbon credits, turning climate action into household income.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mv-card orange">
                    <div class="mv-icon" style="background:linear-gradient(135deg,var(--logo-orange),#bf360c);">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Our Approach</h5>
                    <p class="text-muted mb-0">Community-led, science-backed, and transparency-first. We don't sell carbon credits we haven't measured. Every tonne reported is GPS-tracked, photographed, and blockchain-recorded via CharTrac MRV.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JOURNEY TIMELINE -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Our Journey</h2>
            <p class="text-muted">From the first TLUD stove to Kenya's leading biochar programme.</p>
        </div>

        <div class="timeline">

            <div class="tl-container tl-left">
                <div class="tl-content">
                    <span class="tl-year">1985</span>
                    <h5 class="tl-title">The First TLUD Stove</h5>
                    <p class="tl-text">Dr. Paul S. Anderson ("Dr. TLUD") begins experimenting with Top-Lit UpDraft stoves, designed to provide clean cooking and leave behind biochar.</p>
                </div>
            </div>

            <div class="tl-container tl-right">
                <div class="tl-content">
                    <span class="tl-year">1998-2010</span>
                    <h5 class="tl-title">Global TLUD Expansion</h5>
                    <p class="tl-text">TLUDs spread to more than 30 countries. Research confirms their ability to produce clean energy and climate-positive biochar at household scale.</p>
                </div>
            </div>

            <div class="tl-container tl-left">
                <div class="tl-content">
                    <span class="tl-year">2011-2020</span>
                    <h5 class="tl-title">RoCC Kiln Development</h5>
                    <p class="tl-text">Dr. Anderson designs the RoCC kiln (Retort-Optimized Cone Kiln). In 2021, first units are fabricated at Kisii University and tested in Kisii, Nyakach, and Ahero.</p>
                </div>
            </div>

            <div class="tl-container tl-right">
                <div class="tl-content">
                    <span class="tl-year">2021-2023</span>
                    <h5 class="tl-title">Establishing Biochar Pamoja</h5>
                    <p class="tl-text">Founded by Gilbert Mwangi with support from Dr. Anderson. Pilot projects in Bungoma County show biochar increases maize yields by 20-30%. By 2023, more than 170 tonnes CO₂e removed.</p>
                </div>
            </div>

            <div class="tl-container tl-left">
                <div class="tl-content">
                    <span class="tl-year">2024</span>
                    <h5 class="tl-title">Scaling with Panel Kilns</h5>
                    <p class="tl-text">Transition from RoCC to Panel Kilns for easier, modular, and scalable production. CharTrac Digital MRV adopted to track carbon credits with GPS, photos, and blockchain.</p>
                </div>
            </div>

            <div class="tl-container tl-right">
                <div class="tl-content">
                    <span class="tl-year">2025</span>
                    <h5 class="tl-title">PowerPellet TLUD Deployment</h5>
                    <p class="tl-text">500 household TLUD cookstoves with phone charging (TEG) and biochar collection introduced in Bungoma, supported by women's groups and Rotary partners.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TEAM -->
<section class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>The Team</h2>
            <p class="text-muted">The people behind Biochar Pamoja's work in the field and beyond.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="team-card">
                    <div class="team-avatar-lg"><i class="fas fa-user"></i></div>
                    <h5 class="fw-bold mb-1">Gilbert Mwangi</h5>
                    <p class="text-muted small mb-3">Founder & Executive Director</p>
                    <p class="text-muted small mb-0">Rotary Club of Bungoma Magharibi member and the driving force behind Biochar Pamoja's community biochar programmes in Western Kenya.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="team-card">
                    <div class="team-avatar-lg"><i class="fas fa-user"></i></div>
                    <h5 class="fw-bold mb-1">Dr. Paul S. Anderson</h5>
                    <p class="text-muted small mb-3">Technical Advisor, Dr. TLUD</p>
                    <p class="text-muted small mb-0">Pioneer of TLUD cookstove and RoCC kiln technology. Founder of Woodgas International and a 40-year veteran of clean biomass energy research.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="team-card">
                    <div class="team-avatar-lg"><i class="fas fa-user"></i></div>
                    <h5 class="fw-bold mb-1">Clara Bundotich</h5>
                    <p class="text-muted small mb-3">Community Programmes Lead</p>
                    <p class="text-muted small mb-0">Coordinates the distribution of TLUD cookstoves and farmer training across Bungoma County's women's self-help groups.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="text-uppercase fw-bold" style="color:var(--primary-green);letter-spacing:2px;font-size:0.82rem;">What We Stand For</span>
                <h2 class="fw-bold mt-2 mb-5">Our Core Values</h2>
                <div class="value-item">
                    <div class="value-num">1</div>
                    <div>
                        <h6 class="fw-bold mb-1">Transparency</h6>
                        <p class="text-muted mb-0">Every tonne of carbon removed is measured, GPS-tracked, photographed, and recorded on blockchain. No guesses, no inflated numbers.</p>
                    </div>
                </div>
                <div class="value-item">
                    <div class="value-num">2</div>
                    <div>
                        <h6 class="fw-bold mb-1">Community First</h6>
                        <p class="text-muted mb-0">Farmers and women's groups are the programme, not just beneficiaries. Carbon credit revenue goes back to the people doing the work.</p>
                    </div>
                </div>
                <div class="value-item">
                    <div class="value-num">3</div>
                    <div>
                        <h6 class="fw-bold mb-1">Local Innovation</h6>
                        <p class="text-muted mb-0">We fabricate kilns in Kenya, train Kenyan welders, and adapt technology to local feedstocks, climates, and farming calendars.</p>
                    </div>
                </div>
                <div class="value-item" style="margin-bottom:0;">
                    <div class="value-num">4</div>
                    <div>
                        <h6 class="fw-bold mb-1">Permanence Over Volume</h6>
                        <p class="text-muted mb-0">Biochar persists in soil for hundreds of years. We prioritise high-quality, stable biochar over fast, shallow carbon claims.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="assets/images/hero2.jpg" alt="Biochar values" class="w-100 rounded-4 shadow" style="height:420px;object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background:linear-gradient(135deg,var(--primary-green),var(--logo-teal));color:white;">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Work Together?</h2>
        <p class="lead mb-4 opacity-75">Whether you're a farmer, researcher, NGO, or carbon buyer: there's a role for you in the Biochar Pamoja network.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="contact.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold" style="color:var(--primary-green);">Get In Touch</a>
            <a href="projects.php" class="btn btn-outline-light btn-lg rounded-pill px-4">See Our Projects</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
