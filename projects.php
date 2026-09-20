<?php
$page_title = "Projects, Biochar Pamoja";
include 'includes/header.php';
?>

<style>
/* Projects Page */
.projects-hero {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--logo-teal) 100%);
    padding: 80px 0 60px;
    color: white;
    text-align: center;
}
.projects-hero h1 { font-weight: 900; }
.projects-hero p { opacity: 0.85; max-width: 580px; margin: 0 auto; }

/* Filter tabs */
.filter-bar {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 16px 0;
    position: sticky;
    top: 80px;
    z-index: 100;
}
.filter-btn {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 50px;
    padding: 7px 20px;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    transition: all 0.25s;
}
.filter-btn:hover, .filter-btn.active {
    background: var(--primary-green);
    border-color: var(--primary-green);
    color: white;
}

/* Project cards */
.project-item {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.project-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.12);
}
.project-img-wrap {
    position: relative;
    overflow: hidden;
    height: 260px;
}
.project-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.project-item:hover .project-img-wrap img { transform: scale(1.05); }
.project-status-badge {
    position: absolute;
    top: 16px; left: 16px;
    border-radius: 50px;
    padding: 5px 14px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    backdrop-filter: blur(6px);
}
.status-active { background: rgba(25,135,84,0.9); color: white; }
.status-completed { background: rgba(13,110,253,0.85); color: white; }
.status-ongoing { background: rgba(230,81,0,0.85); color: white; }

.project-body {
    padding: 28px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.project-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }
.project-tag {
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    border-radius: 50px;
    padding: 3px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
}
.project-title { font-size: 1.35rem; font-weight: 800; margin-bottom: 10px; color: var(--text-main); }
.project-desc { color: var(--text-muted); font-size: 0.93rem; line-height: 1.7; margin-bottom: 20px; flex: 1; }

/* Stat mini-strip inside card */
.project-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 22px;
}
.project-stat {
    background: var(--bg-secondary);
    padding: 12px 8px;
    text-align: center;
}
.project-stat .val {
    font-weight: 800;
    font-size: 1.15rem;
    color: var(--primary-green);
    line-height: 1.1;
}
.project-stat .lbl {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-top: 2px;
}

.btn-view-project {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--primary-green);
    color: white;
    border-radius: 12px;
    padding: 13px 20px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s;
}
.btn-view-project:hover {
    background: var(--logo-teal);
    color: white;
    transform: translateX(3px);
}
.btn-view-project i { transition: transform 0.25s; }
.btn-view-project:hover i { transform: translateX(4px); }

/* Impact section */
.impact-section {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white;
    padding: 70px 0;
}
.impact-section .num { font-size: 3rem; font-weight: 900; }
.impact-section .lbl { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.85; }
</style>

<!-- HERO -->
<section class="projects-hero">
    <div class="container">
        <span class="badge bg-white text-success fw-bold px-3 py-2 mb-3" style="font-size:0.85rem; letter-spacing:1px;">OUR WORK</span>
        <h1 class="display-4 mb-3">Projects & Initiatives</h1>
        <p class="lead">From kiln pilots to cookstove distribution: every project is measured, verified, and built to last.</p>
    </div>
</section>

<!-- FILTER BAR -->
<div class="filter-bar">
    <div class="container">
        <div class="d-flex gap-2 flex-wrap">
            <button class="filter-btn active" onclick="filterProjects('all', this)">All Projects</button>
            <button class="filter-btn" onclick="filterProjects('clean-energy', this)">Clean Energy</button>
            <button class="filter-btn" onclick="filterProjects('carbon', this)">Carbon Removal</button>
            <button class="filter-btn" onclick="filterProjects('agriculture', this)">Agriculture</button>
        </div>
    </div>
</div>

<!-- PROJECTS GRID -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="row g-4" id="projects-grid">

            <!-- PROJECT 1: PowerPellet TLUD -->
            <div class="col-lg-4 col-md-6 project-card-col" data-category="clean-energy carbon">
                <div class="project-item h-100">
                    <div class="project-img-wrap">
                        <img src="assets/images/tlud.jpg" alt="PowerPellet TLUD Cookstoves">
                        <span class="project-status-badge status-active">Active · 2023-2025</span>
                    </div>
                    <div class="project-body">
                        <div class="project-tags">
                            <span class="project-tag">Clean Energy</span>
                            <span class="project-tag">Carbon Removal</span>
                            <span class="project-tag">Bungoma</span>
                        </div>
                        <h3 class="project-title">PowerPellet TLUD Cookstoves</h3>
                        <p class="project-desc">500 TLUD clean cookstoves distributed to 14+ women's self-help groups across Bungoma County. Each stove produces biochar, reduces indoor smoke, and charges phones via TEG, a triple impact per household.</p>
                        <div class="project-stats">
                            <div class="project-stat">
                                <div class="val">500</div>
                                <div class="lbl">Stoves</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">14+</div>
                                <div class="lbl">Groups</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">0.5-1t</div>
                                <div class="lbl">CO₂e/stove/yr</div>
                            </div>
                        </div>
                        <a href="powerpellet-tlud.php" class="btn-view-project">
                            View Full Project <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- PROJECT 2: RoCC Kilns -->
            <div class="col-lg-4 col-md-6 project-card-col" data-category="carbon">
                <div class="project-item h-100">
                    <div class="project-img-wrap">
                        <img src="assets/images/kilnsrocc.jpeg" alt="RoCC Kiln Pilots">
                        <span class="project-status-badge status-completed">Pilot Completed</span>
                    </div>
                    <div class="project-body">
                        <div class="project-tags">
                            <span class="project-tag">Carbon Removal</span>
                            <span class="project-tag">Research</span>
                            <span class="project-tag">Kisii · Nyakach</span>
                        </div>
                        <h3 class="project-title">RoCC Kiln Pilots, Kisii & Nyakach</h3>
                        <p class="project-desc">Kenya's first fabricated Retort-Optimized Cone Kilns, built with Kisii University and KMFRI. Pilot sites in Kisii, Nyakach, and Ahero validated the technology and generated 170+ tonnes CO₂e in verified removals.</p>
                        <div class="project-stats">
                            <div class="project-stat">
                                <div class="val">3</div>
                                <div class="lbl">Pilot Sites</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">170+</div>
                                <div class="lbl">t CO₂e</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">2021</div>
                                <div class="lbl">First Unit</div>
                            </div>
                        </div>
                        <a href="rocc-kilns.php" class="btn-view-project">
                            View Full Project <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- PROJECT 3: Bungoma Biochar Farming -->
            <div class="col-lg-4 col-md-6 project-card-col" data-category="agriculture carbon">
                <div class="project-item h-100">
                    <div class="project-img-wrap">
                        <img src="assets/images/biocharfarm.jpeg" alt="Bungoma Biochar Farming">
                        <span class="project-status-badge status-ongoing">Ongoing</span>
                    </div>
                    <div class="project-body">
                        <div class="project-tags">
                            <span class="project-tag">Agriculture</span>
                            <span class="project-tag">Carbon Removal</span>
                            <span class="project-tag">Bungoma</span>
                        </div>
                        <h3 class="project-title">Bungoma Biochar Farming</h3>
                        <p class="project-desc">Training 1,000+ smallholder farmers to produce biochar from crop residues and apply it to their fields, boosting maize yields 20-30% and generating verified carbon credits as a new income stream.</p>
                        <div class="project-stats">
                            <div class="project-stat">
                                <div class="val">1,000+</div>
                                <div class="lbl">Farmers</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">+30%</div>
                                <div class="lbl">Yield Gain</div>
                            </div>
                            <div class="project-stat">
                                <div class="val">5+</div>
                                <div class="lbl">Women's Groups</div>
                            </div>
                        </div>
                        <a href="bungoma-biochar.php" class="btn-view-project">
                            View Full Project <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Empty state -->
        <div id="no-results" class="text-center py-5 d-none">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <p class="text-muted">No projects in this category yet.</p>
        </div>
    </div>
</section>

<!-- OVERALL IMPACT -->
<section class="impact-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Combined Impact</h2>
            <p style="opacity:0.8;">Across all Biochar Pamoja projects to date.</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="num">5+</div>
                <div class="lbl mt-1">Years in the Field</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="num">170+</div>
                <div class="lbl mt-1">Tonnes CO₂e Removed</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="num">1,000+</div>
                <div class="lbl mt-1">Farmers Trained</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="num">500</div>
                <div class="lbl mt-1">Cookstoves Distributed</div>
            </div>
        </div>
    </div>
</section>

<!-- PARTNER CTA -->
<section class="py-5 text-center" style="background-color: var(--bg-body);">
    <div class="container">
        <h2 class="fw-bold mb-3">Want to Collaborate?</h2>
        <p class="text-muted lead mb-4">We partner with NGOs, county governments, research institutions, and carbon buyers to scale our work across Kenya and beyond.</p>
        <a href="contact.php" class="btn btn-success btn-lg rounded-pill px-5">Get In Touch <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</section>

<script>
function filterProjects(category, btn) {
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const cards = document.querySelectorAll('.project-card-col');
    let visible = 0;

    cards.forEach(card => {
        const cats = card.dataset.category || '';
        if (category === 'all' || cats.includes(category)) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    const noResults = document.getElementById('no-results');
    noResults.classList.toggle('d-none', visible > 0);
}
</script>

<?php include 'includes/footer.php'; ?>
