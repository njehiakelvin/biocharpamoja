<?php
$page_title = "Bungoma Biochar Farming";
include '../includes/header.php';
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.farm-hero {
    background: url('../assets/images/biocharfarm.jpeg') no-repeat center center / cover;
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: -80px;
    padding-top: 80px;
}
.farm-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(160deg, rgba(0,0,0,0.65) 40%, rgba(25,135,84,0.5));
}
.farm-hero-content { position: relative; z-index: 2; }

.project-breadcrumb {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    font-size: 0.88rem;
}
.project-breadcrumb a { color: var(--primary-green); }
.project-breadcrumb .separator { margin: 0 8px; color: var(--text-muted); }

.impact-strip {
    background: linear-gradient(135deg, var(--primary-green), #2e7d32);
    color: white;
    padding: 50px 0;
}
.impact-strip .stat-num { font-size: 2.8rem; font-weight: 900; line-height: 1; }
.impact-strip .stat-label { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.9; }

.benefit-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 15px;
    padding: 28px;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
    position: relative;
    overflow: hidden;
}
.benefit-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px;
    height: 100%;
}
.benefit-card.green::before { background: var(--primary-green); }
.benefit-card.teal::before { background: var(--logo-teal); }
.benefit-card.orange::before { background: var(--logo-orange); }
.benefit-card.blue::before { background: #0d6efd; }
.benefit-card:hover { transform: translateY(-5px); }

.section-alt { background-color: var(--bg-secondary); }

/* Yield comparison bars */
.yield-bar-wrap { margin-bottom: 20px; }
.yield-label { font-weight: 600; margin-bottom: 6px; font-size: 0.9rem; }
.yield-bar {
    height: 36px; border-radius: 8px;
    display: flex; align-items: center;
    padding: 0 14px;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
}

/* Testimonial */
.testimonial-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 15px;
    padding: 30px;
    box-shadow: var(--shadow);
    position: relative;
}
.testimonial-card::before {
    content: '\201C';
    position: absolute;
    top: -10px; left: 20px;
    font-size: 5rem;
    color: var(--primary-green);
    opacity: 0.2;
    line-height: 1;
    font-family: Georgia, serif;
}

.phase-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 24px;
    height: 100%;
    box-shadow: var(--shadow);
    text-align: center;
    transition: transform 0.3s;
}
.phase-card:hover { transform: translateY(-4px); }
.phase-icon {
    width: 64px; height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 1.5rem;
    color: white;
}
</style>

<!-- Breadcrumb -->
<div class="project-breadcrumb">
    <div class="container">
        <a href="../index.php">Home</a>
        <span class="separator">›</span>
        <a href="../projects.php">Projects</a>
        <span class="separator">›</span>
        <span style="color: var(--text-muted);">Bungoma Biochar Farming</span>
    </div>
</div>

<!-- HERO -->
<section class="farm-hero">
    <div class="farm-hero-overlay"></div>
    <div class="farm-hero-content text-center text-white px-3" data-aos="zoom-in" data-aos-duration="1000">
        <span class="badge mb-3 px-3 py-2" style="background: var(--primary-green); font-size:0.9rem; letter-spacing:1px;">SUSTAINABLE AGRICULTURE PROJECT</span>
        <h1 class="display-3 fw-bold mb-3">Bungoma Biochar Farming</h1>
        <p class="lead mb-4" style="max-width:660px; margin:0 auto 28px;">Training 1,000+ farmers to turn crop waste into biochar — boosting maize yields by 20–30% while removing carbon from the atmosphere.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#overview" class="btn btn-success btn-lg rounded-pill px-4">The Project <i class="fas fa-arrow-down ms-2"></i></a>
            <a href="../contact.php" class="btn btn-outline-light btn-lg rounded-pill px-4">Partner With Us</a>
        </div>
    </div>
</section>

<!-- IMPACT STRIP -->
<div class="impact-strip">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-num">1,000+</div>
                <div class="stat-label mt-1">Farmers Trained</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-num">20–30%</div>
                <div class="stat-label mt-1">Yield Increase</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-num">170+</div>
                <div class="stat-label mt-1">Tonnes CO₂e Removed</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-num">5+</div>
                <div class="stat-label mt-1">Women's Groups</div>
            </div>
        </div>
    </div>
</div>

<!-- OVERVIEW -->
<section id="overview" class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="text-uppercase fw-bold" style="color: var(--primary-green); letter-spacing:2px; font-size:0.85rem;">The Initiative</span>
                <h2 class="fw-bold mt-2 mb-4">From Crop Waste to Soil Gold</h2>
                <p class="text-muted mb-4" style="line-height:1.9;">
                    Bungoma County sits in the heart of Kenya's western agricultural belt — rich in maize, sugarcane, and banana production, but also generating vast quantities of crop residue that is typically burned openly, releasing carbon and degrading local soils.
                </p>
                <p class="text-muted mb-4" style="line-height:1.9;">
                    Biochar Pamoja's flagship farming programme turns that waste into an asset. Farmers are trained to produce biochar from their own residues using RoCC and Panel kilns, then apply it to their fields as a permanent soil amendment — increasing yields, reducing synthetic fertiliser dependence, and generating verified carbon credits.
                </p>
                <p class="text-muted" style="line-height:1.9;">
                    Since pilot projects in Bungoma County began, the programme has demonstrated consistent maize yield increases of 20–30%, confirmed by independent field measurements, while removing over 170 tonnes of CO₂e from the atmosphere.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="../assets/images/biocharfarm.jpeg" alt="Biochar farming Bungoma" class="w-100 rounded-4 shadow" style="object-fit:cover; height:400px;">
            </div>
        </div>
    </div>
</section>

<!-- YIELD IMPACT -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Yield Impact</h2>
            <p class="text-muted">Measured field results from Bungoma County pilot farms.</p>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h5 class="fw-bold mb-4">Maize Yield: With vs. Without Biochar</h5>
                <div class="yield-bar-wrap">
                    <div class="yield-label">Without Biochar (Baseline)</div>
                    <div class="yield-bar" style="width:72%; background: var(--text-muted);">2.2 t/ha</div>
                </div>
                <div class="yield-bar-wrap">
                    <div class="yield-label">With Biochar (20% Application)</div>
                    <div class="yield-bar" style="width:88%; background: var(--logo-teal);">2.6 t/ha (+20%)</div>
                </div>
                <div class="yield-bar-wrap">
                    <div class="yield-label">With Biochar + Organic Fertiliser</div>
                    <div class="yield-bar" style="width:100%; background: var(--primary-green);">2.9 t/ha (+30%)</div>
                </div>
                <p class="text-muted mt-4 small">Field measurements from Bungoma County, 2022–2023 season. Results vary by soil type and biochar application rate.</p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div style="height: 280px; position: relative; max-width: 280px; margin: 0 auto;">
                    <canvas id="yieldChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENEFITS -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Why Biochar Farming Works</h2>
            <p class="text-muted">The science and community impact behind every tonne of biochar applied.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="benefit-card green">
                    <i class="fas fa-tint fa-2x mb-3" style="color: var(--primary-green);"></i>
                    <h6 class="fw-bold mb-2">Water Retention</h6>
                    <p class="text-muted mb-0">Biochar's porous structure holds water in the soil, reducing drought stress during dry spells. Bungoma farmers report up to 40% less irrigation requirement after biochar application.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="benefit-card teal">
                    <i class="fas fa-vial fa-2x mb-3" style="color: var(--logo-teal);"></i>
                    <h6 class="fw-bold mb-2">Soil pH Improvement</h6>
                    <p class="text-muted mb-0">Western Kenya's red soils tend to be acidic. Biochar raises pH, increasing nutrient availability and reducing the amount of lime farmers need to purchase each season.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="benefit-card orange">
                    <i class="fas fa-coins fa-2x mb-3" style="color: var(--logo-orange);"></i>
                    <h6 class="fw-bold mb-2">Carbon Credit Income</h6>
                    <p class="text-muted mb-0">Each tonne of biochar incorporated into soil represents ~2.2 tonnes of CO₂e permanently removed. Farmers earn carbon credit income on top of their improved harvests — a direct financial incentive.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="benefit-card blue">
                    <i class="fas fa-recycle fa-2x mb-3 text-primary"></i>
                    <h6 class="fw-bold mb-2">Waste Elimination</h6>
                    <p class="text-muted mb-0">Crop residues that were previously burned openly — releasing smoke and CO₂ — are now feedstock for biochar. This eliminates a local air quality problem while creating value on the farm.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW FARMERS PARTICIPATE -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>How Farmers Participate</h2>
            <p class="text-muted">A four-phase pathway from training to carbon credit earnings.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="phase-card">
                    <div class="phase-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h6 class="fw-bold mb-2">1. Training</h6>
                    <p class="text-muted small mb-0">3-day hands-on training on kiln operation, biochar quality testing, and field application rates. Delivered via women's groups and cooperative networks.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="phase-card">
                    <div class="phase-icon"><i class="fas fa-fire"></i></div>
                    <h6 class="fw-bold mb-2">2. Production</h6>
                    <p class="text-muted small mb-0">Farmers collect crop residue and produce biochar using shared kilns. Production is logged with GPS coordinates and photos using CharTrac Digital MRV.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="phase-card">
                    <div class="phase-icon"><i class="fas fa-seedling"></i></div>
                    <h6 class="fw-bold mb-2">3. Application</h6>
                    <p class="text-muted small mb-0">Biochar is crushed, mixed with compost or manure, and incorporated into soil at planting. Application rates and field GPS are recorded for verification.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="phase-card">
                    <div class="phase-icon"><i class="fas fa-certificate"></i></div>
                    <h6 class="fw-bold mb-2">4. Carbon Credits</h6>
                    <p class="text-muted small mb-0">Verified removals are issued as carbon credits. Revenue is split between farmers and the programme — giving smallholders a new, recurring income stream.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Farmer Voices</h2>
            <p class="text-muted">Real stories from Bungoma County farmers.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="testimonial-card">
                    <p class="text-muted mb-4" style="line-height:1.8;">"Before biochar, I was spending more on fertiliser every season. Now I use half the amount and my maize is taller and greener. It has changed how I farm."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg, var(--primary-green), var(--logo-teal)); display:flex; align-items:center; justify-content:center; color:white;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:0.9rem;">Mary W., Bungoma</div>
                            <small class="text-muted">Smallholder Farmer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card">
                    <p class="text-muted mb-4" style="line-height:1.8;">"We used to burn our sugarcane trash every harvest. Now we turn it into biochar and put it back in the soil. The difference in our crops after two seasons is very clear."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg, var(--logo-teal), var(--primary-green)); display:flex; align-items:center; justify-content:center; color:white;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:0.9rem;">James O., Bungoma</div>
                            <small class="text-muted">Sugarcane & Maize Farmer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <p class="text-muted mb-4" style="line-height:1.8;">"The women in our group were the first to try it. When others saw our yields, they wanted to join too. Now we have over 30 members making biochar together every season."</p>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg, var(--logo-orange), #e65100); display:flex; align-items:center; justify-content:center; color:white;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:0.9rem;">Agnes N., Group Chair</div>
                            <small class="text-muted">Women's Self-Help Group</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Field Gallery</h2>
        </div>
        <div class="row g-3">
            <div class="col-md-8" data-aos="fade-up">
                <img src="../assets/images/biocharfarm.jpeg" alt="Biochar farming" class="w-100 rounded-4 shadow" style="height:380px; object-fit:cover;">
            </div>
            <div class="col-md-4 d-flex flex-column gap-3" data-aos="fade-up" data-aos-delay="100">
                <img src="../assets/images/hero1.jpg" alt="Farm field" class="w-100 rounded-4 shadow" style="height:182px; object-fit:cover;">
                <img src="../assets/images/hero3.jpg" alt="Community training" class="w-100 rounded-4 shadow" style="height:182px; object-fit:cover;">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <img src="../assets/images/hero2.jpg" alt="Kiln operation" class="w-100 rounded-4 shadow" style="height:220px; object-fit:cover;">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <img src="../assets/images/kilnsrocc.jpeg" alt="RoCC kiln" class="w-100 rounded-4 shadow" style="height:220px; object-fit:cover;">
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <img src="../assets/images/news-kiln.PNG" alt="Kiln news" class="w-100 rounded-4 shadow" style="height:220px; object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, var(--primary-green), var(--logo-teal)); color: white;">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Ready to Bring Biochar Farming to Your Region?</h2>
        <p class="lead mb-4 opacity-75" data-aos="fade-up">We partner with cooperatives, county governments, and NGOs to scale biochar adoption across Kenya.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up">
            <a href="../contact.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold" style="color: var(--primary-green);">Start a Conversation</a>
            <a href="../projects.php" class="btn btn-outline-light btn-lg rounded-pill px-4">View All Projects</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ once: true, offset: 80, duration: 800 });

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('yieldChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Yield Increase', 'Baseline'],
                datasets: [{
                    data: [30, 70],
                    backgroundColor: ['#198754', '#e0e0e0'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '72%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => ctx.label + ': ' + (ctx.label === 'Yield Increase' ? '+30%' : 'Baseline')
                        }
                    }
                }
            }
        });
    }
});
</script>

<?php include '../includes/footer.php'; ?>
