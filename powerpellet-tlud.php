<?php
$page_title = "PowerPellet TLUD Cookstoves";
include 'includes/header.php';
?>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ── Hero ── */
.tlud-hero {
    background: url('assets/images/tlud.jpg') no-repeat center center / cover;
    min-height: 85vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: -80px;
    padding-top: 80px;
}
.tlud-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.65) 55%, rgba(25,135,84,0.4));
}
.tlud-hero-content { position: relative; z-index: 2; }

/* ── Breadcrumb ── */
.project-breadcrumb {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    font-size: 0.88rem;
}
.project-breadcrumb a { color: var(--primary-green); }
.project-breadcrumb .sep { margin: 0 8px; color: var(--text-muted); }

/* ── Impact strip ── */
.impact-strip {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white;
    padding: 52px 0;
}
.impact-strip .s-num { font-size: 2.8rem; font-weight: 900; line-height: 1; }
.impact-strip .s-lbl { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.88; margin-top: 4px; }

/* ── Feature cards ── */
.feature-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 28px;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}
.feature-card:hover { transform: translateY(-5px); }
.f-icon {
    width: 56px; height: 56px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 18px; font-size: 1.3rem;
}

/* ── Gallery ── */
.beneficiary-carousel .carousel-item img {
    height: 250px; width: 100%; object-fit: cover;
    border-top-left-radius: 12px; border-top-right-radius: 12px;
}
.gallery-card {
    border: none; border-radius: 12px; overflow: hidden;
    box-shadow: var(--shadow); background: var(--bg-card);
    height: 100%;
}
.pagination .page-link {
    color: var(--primary-green);
    background: var(--bg-card);
    border-color: var(--border-color);
}
.pagination .page-item.active .page-link {
    background: var(--primary-green);
    border-color: var(--primary-green);
    color: white;
}

/* ── Video cards ── */
.video-card {
    border-radius: 12px; overflow: hidden;
    cursor: pointer; background: #000;
    box-shadow: var(--shadow); transition: transform 0.3s;
}
.video-card:hover { transform: translateY(-5px); }
.video-thumbnail { width: 100%; height: 220px; object-fit: cover; opacity: 0.85; transition: opacity 0.3s; display: block; }
.video-card:hover .video-thumbnail { opacity: 0.65; }
.video-label {
    padding: 12px 14px;
    background: var(--bg-card);
    border-top: 1px solid var(--border-color);
}
.play-btn-overlay {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 58px; height: 58px;
    background: rgba(255,255,255,0.92); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 20px rgba(255,255,255,0.4);
    transition: transform 0.3s;
    pointer-events: none;
}
.play-btn-overlay i { color: var(--primary-green); font-size: 22px; margin-left: 4px; }
.video-card:hover .play-btn-overlay { transform: translate(-50%,-50%) scale(1.1); }
.video-card-wrap { position: relative; }

/* ── Shorts ── */
.shorts-container {
    display: flex; overflow-x: auto; gap: 16px; padding: 16px 4px;
    scrollbar-width: thin;
    scrollbar-color: var(--primary-green) var(--bg-secondary);
}
.shorts-container::-webkit-scrollbar { height: 6px; }
.shorts-container::-webkit-scrollbar-track { background: var(--bg-secondary); border-radius: 4px; }
.shorts-container::-webkit-scrollbar-thumb { background: var(--primary-green); border-radius: 4px; }
.short-card {
    min-width: 200px; max-width: 200px; height: 350px;
    position: relative; border-radius: 14px; overflow: hidden;
    cursor: pointer; flex-shrink: 0;
    box-shadow: var(--shadow); transition: transform 0.3s;
}
.short-card:hover { transform: translateY(-5px); }
.short-thumbnail { width: 100%; height: 100%; object-fit: cover; display: block; }
.short-play {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: 42px; height: 42px;
    background: rgba(255,255,255,0.9); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    pointer-events: none;
}
.short-play i { color: var(--primary-green); font-size: 15px; margin-left: 3px; }

/* ── Partner & team cards ── */
.partner-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 28px 20px;
    text-align: center;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}
.partner-card:hover { transform: translateY(-4px); }
.team-avatar {
    width: 72px; height: 72px;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px;
    font-size: 1.6rem; color: white;
}

.section-alt { background-color: var(--bg-secondary); }

/* ── Progress bar ── */
.progress { border-radius: 50px; }
.progress-bar { border-radius: 50px; }
</style>

<!-- Breadcrumb -->
<div class="project-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a>
        <span class="sep">›</span>
        <a href="projects.php">Projects</a>
        <span class="sep">›</span>
        <span style="color:var(--text-muted);">PowerPellet TLUD Cookstoves</span>
    </div>
</div>

<!-- HERO -->
<section class="tlud-hero">
    <div class="tlud-hero-overlay"></div>
    <div class="tlud-hero-content text-center text-white px-3" data-aos="zoom-in" data-aos-duration="1000">
        <span class="badge bg-success mb-3 px-3 py-2" style="font-size:0.88rem;letter-spacing:1px;">CLEAN ENERGY PROJECT</span>
        <h1 class="display-3 fw-bold mb-3">Service Above Self</h1>
        <p class="lead mb-4" style="max-width:640px;margin:0 auto 28px;">Transforming Health, Homes, and Hope in Bungoma through clean cooking solutions, one stove at a time.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#project" class="btn btn-success btn-lg rounded-pill px-4">Our Story <i class="fas fa-arrow-down ms-2"></i></a>
            <a href="assets/documents/TLUD COOKSTOVE PROJECT REPORT.pdf" class="btn btn-outline-light btn-lg rounded-pill px-4" target="_blank">
                <i class="fas fa-file-pdf me-2"></i>Project Report
            </a>
        </div>
    </div>
</section>

<!-- IMPACT STRIP -->
<div class="impact-strip">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="s-num">500</div>
                <div class="s-lbl">Stoves Distributed</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="s-num">14+</div>
                <div class="s-lbl">Women's Groups</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="s-num">4</div>
                <div class="s-lbl">Rotary Partners</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="s-num">2yr</div>
                <div class="s-lbl">Dec 2023 to Dec 2025</div>
            </div>
        </div>
    </div>
</div>

<!-- PROGRESS DASHBOARD -->
<section class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Project Progress</h2>
            <p class="text-muted">Tracking distribution across Bungoma County.</p>
        </div>
        <div class="row align-items-center g-5">
            <div class="col-md-5 text-center" data-aos="fade-right">
                <div style="height:280px;position:relative;max-width:280px;margin:0 auto;">
                    <canvas id="progressChart"></canvas>
                </div>
            </div>
            <div class="col-md-7" data-aos="fade-left">
                <div class="p-4 rounded-4" style="background:var(--bg-secondary);border:1px solid var(--border-color);">
                    <h3 class="fw-bold mb-1" style="color:var(--primary-green);">500 / 500 Stoves Distributed</h3>
                    <p class="text-muted mb-3">Goal achieved, targeting 14+ Women Self-Help Groups across Bungoma County.</p>
                    <div class="progress mb-4" style="height:22px;">
                        <div class="progress-bar bg-success fw-bold" style="width:100%;">100% Complete</div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-3 text-center" style="background:var(--bg-card);border:1px solid var(--border-color);">
                                <div class="fw-bold fs-4" style="color:var(--primary-green);">500</div>
                                <small class="text-muted">Stoves Delivered</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 text-center" style="background:var(--bg-card);border:1px solid var(--border-color);">
                                <div class="fw-bold fs-4" style="color:var(--logo-teal);">14+</div>
                                <small class="text-muted">Groups Reached</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROJECT DETAILS -->
<section id="project" class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Transforming Health, Homes &amp; Hope</h2>
            <p class="text-muted">A powerful demonstration of what Rotary's spirit of service can achieve when clubs unite across continents.</p>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9" data-aos="fade-up">
                <p class="lead text-muted" style="line-height:1.9;">
                    Through a remarkable Club-to-Club partnership, the Rotary Clubs of Bloomington-Normal (Sunset, Normal, Daybreak, and Thrive) in District 6490 have joined hands with the Rotary Club of Bungoma Magharibi, the Rotary Club of Bungoma, and the Rotaract Club of Bungoma Magharibi to deliver life-changing clean cooking solutions. Launched in December 2023 and progressing through December 2025, this initiative focuses on improving health, protecting the environment, and uplifting livelihoods through the donation of 500 TLUD clean cookstoves.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="f-icon bg-danger bg-opacity-10"><i class="fas fa-fire text-danger"></i></div>
                    <h5 class="fw-bold mb-3">Technology That Changes Lives</h5>
                    <p class="text-muted mb-0">The TLUD cookstove is a modern, efficient, and low-emission stove designed to burn pellets cleanly, dramatically reducing indoor smoke and improving air quality. Women who once endured burning eyes and smoke-filled kitchens can now cook faster, cleaner, and more safely.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="f-icon bg-success bg-opacity-10"><i class="fas fa-users text-success"></i></div>
                    <h5 class="fw-bold mb-3">Community Voices, Real Impact</h5>
                    <p class="text-muted mb-0">From Nengelwa to Mumias, the gratitude is profound. Women elders speak of preparing meals without smoke choking their kitchens. Chairpersons of women's groups celebrate relief from firewood collection, and mothers testify how the stoves bring dignity to meal preparation.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="f-icon bg-primary bg-opacity-10"><i class="fas fa-handshake text-primary"></i></div>
                    <h5 class="fw-bold mb-3">A Partnership Rooted in Service</h5>
                    <p class="text-muted mb-0">This project is made possible by Rotary's unique ability to connect caring hearts across borders. Members from both regions have walked together from idea conception to community outreach to ensure that every cookstove donated brings lasting value.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="f-icon bg-warning bg-opacity-10"><i class="fas fa-leaf text-warning"></i></div>
                    <h5 class="fw-bold mb-3">Beyond Cooking</h5>
                    <ul class="text-muted mb-0 ps-3" style="line-height:2.1;">
                        <li>Better health through reduced indoor air pollution</li>
                        <li>Environmental restoration by reducing firewood reliance</li>
                        <li>Economic empowerment: saving time and money</li>
                        <li>Stronger families through safer cooking options</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENEFICIARY GALLERY -->
<section class="py-5" id="gallery-container" style="background:var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Beneficiaries &amp; Stories</h2>
            <p class="text-muted">Witness the impact on daily lives across Bungoma County.</p>
        </div>

        <div id="gallery" class="row g-4 mb-4">

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-mazingira" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/mazingira1.jpg" class="d-block w-100" alt="Mazingira WSG"></div>
                            <div class="carousel-item"><img src="assets/images/mazingira2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/mazingira3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/mazingira4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-mazingira" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-mazingira" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Mazingira WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 22, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-wabukhonyi" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/wabukhonyi1.jpg" class="d-block w-100" alt="Wabukhonyi WSG"></div>
                            <div class="carousel-item"><img src="assets/images/wabukhonyi2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/wabukhonyi3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/wabukhonyi4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-wabukhonyi" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-wabukhonyi" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Wabukhonyi WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 20, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-kumia" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/kumia1.jpg" class="d-block w-100" alt="Kumia WSG"></div>
                            <div class="carousel-item"><img src="assets/images/kumia2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/kumia3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/kumia4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-kumia" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-kumia" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Kumia WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 19, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-mapema" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/mapema1.jpg" class="d-block w-100" alt="Mapema WSG"></div>
                            <div class="carousel-item"><img src="assets/images/mapema2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/mapema3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/mapema4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-mapema" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-mapema" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Mapema Ndio Best WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 19, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-jamia25" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/jamia tawasul 2025 1.jpg" class="d-block w-100" alt="Jamia Tawasul WSG 2025"></div>
                            <div class="carousel-item"><img src="assets/images/jamia tawasul 2025 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/jamia tawasul 2025 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/jamia tawasul 2025 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-jamia25" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-jamia25" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Jamia Tawasul WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Nov 21, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-jamia24" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Jamia Tawasul 1.jpg" class="d-block w-100" alt="Jamia Tawasul WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Jamia Tawasul 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Jamia Tawasul 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Jamia Tawasul 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-jamia24" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-jamia24" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Jamia Tawasul WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>May 2024 to May 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-sikata" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4500">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Sikata Champions 1.jpg" class="d-block w-100" alt="Sikata Champions WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Sikata Champions 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Sikata Champions 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Sikata Champions 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-sikata" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-sikata" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Sikata Champions WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 5, 2024</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-nalutiri" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Nalutiri Nakhakira 1.jpg" class="d-block w-100" alt="Nalutiri Nakhakira WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Nalutiri Nakhakira 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Nalutiri Nakhakira 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Nalutiri Nakhakira 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-nalutiri" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-nalutiri" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Nalutiri Nakhakira WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Nov 22, 2024</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-daughters" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="3500">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Daughters of Neon 1.jpg" class="d-block w-100" alt="Daughters of Neon WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Daughters of Neon 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Daughters of Neon 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Daughters of Neon 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-daughters" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-daughters" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Daughters of Neon WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Nov 21, 2024</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-senna" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Senna 1.jpg" class="d-block w-100" alt="Senna WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Senna 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Senna 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Senna 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-senna" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-senna" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Senna WSG</h6>
                        <p class="fst-italic text-muted small mt-2 mb-1">"At least women now have an opportunity to improve the environment… The cookstove is family friendly. Carolyne Wameme, Chairperson"</p>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>May 24, 2024</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-naitela24" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="5500">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Naitela 1.jpg" class="d-block w-100" alt="Naitela WSG"></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-naitela24" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-naitela24" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Naitela WSG</h6>
                        <p class="fst-italic text-muted small mt-2 mb-1">"I have come here today to purposely thank you for the donation of cookstoves that are now improving and transforming our lives. Mariam Juma, Chairperson"</p>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>May 24, 2024</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-bidii" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="3200">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Bidii Yefwe 1.jpg" class="d-block w-100" alt="Bidii Yefwe WSG"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-bidii" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-bidii" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Bidii Yefwe WSG</h6>
                        <p class="fst-italic text-muted small mt-2 mb-1">"Today we are very happy and excited because some members shall start cooking their meals without stress. MacLean Kisabuli, Chairperson"</p>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 22, 2023</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card">
                    <div id="c-naitela23" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4800">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="assets/images/Naitela 2023 1.jpg" class="d-block w-100" alt="Naitela WSG 2023"></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 2023 2.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 2023 3.jpg" class="d-block w-100" alt=""></div>
                            <div class="carousel-item"><img src="assets/images/Naitela 2023 4.jpg" class="d-block w-100" alt=""></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#c-naitela23" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#c-naitela23" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="p-3 text-center">
                        <h6 class="fw-bold mb-1">Naitela WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 21, 2023</small>
                    </div>
                </div>
            </div>

        </div>

        <nav>
            <ul class="pagination justify-content-center" id="pagination-controls"></ul>
        </nav>
    </div>
</section>

<!-- VIDEOS -->
<section id="videos" class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Project in Action</h2>
            <p class="text-muted">Demonstrations, training, and community celebrations.</p>
        </div>

        <h5 class="fw-bold mb-4 ps-3" style="border-left:4px solid var(--primary-green);" data-aos="fade-right">Demonstrations &amp; Impact</h5>
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up">
                <div class="video-card-wrap">
                    <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/landscape_1.mp4', false)">
                        <img src="assets/images/landscape1.jpeg" class="video-thumbnail" alt="Jamia Tawasul demonstration">
                        <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                    </div>
                    <div class="video-label">
                        <p class="fw-bold mb-0 small" style="color:var(--text-main);">Jamia Tawasul WSG Cookstove Demonstration</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="video-card-wrap">
                    <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/landscape_2.mp4', false)">
                        <img src="assets/images/landscape2.jpeg" class="video-thumbnail" alt="Joy WSG testimonial">
                        <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                    </div>
                    <div class="video-label">
                        <p class="fw-bold mb-0 small" style="color:var(--text-main);">Joy WSG Chairperson Testimonial</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="video-card-wrap">
                    <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/landscape_3.mp4', false)">
                        <img src="assets/images/landscape3.png" class="video-thumbnail" alt="Field video">
                        <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                    </div>
                    <div class="video-label">
                        <p class="fw-bold mb-0 small" style="color:var(--text-main);">Field Video</p>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="fw-bold mb-2 ps-3" style="border-left:4px solid var(--logo-orange);" data-aos="fade-right">Community Moments</h5>
        <p class="text-muted small mb-3"><i class="fas fa-arrows-alt-h me-1"></i> Swipe to see more</p>
        <div class="shorts-container" data-aos="fade-up">
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_1.mp4', true)">
                <img src="assets/images/portrait1.jpeg" class="short-thumbnail" alt="Short 1">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_2.mp4', true)">
                <img src="assets/images/portrait2.jpeg" class="short-thumbnail" alt="Short 2">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_3.mp4', true)">
                <img src="assets/images/portrait3.jpeg" class="short-thumbnail" alt="Short 3">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_4.mp4', true)">
                <img src="assets/images/portrait4.jpeg" class="short-thumbnail" alt="Short 4">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_5.mp4', true)">
                <img src="assets/images/portrait5.jpeg" class="short-thumbnail" alt="Short 5">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('assets/videos/portrait_6.mp4', true)">
                <img src="assets/images/portrait6.png" class="short-thumbnail" alt="Short 6">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-black border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9" id="videoRatio">
                    <video id="mainVideoPlayer" controls playsinline>
                        <source src="" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PARTNERS -->
<section id="partners" class="py-5" style="background:var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Our Partners</h2>
            <p class="text-muted">This project is built on cross-continental collaboration.</p>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color:var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Clubs of Bloomington-Normal</h6>
                    <small class="text-muted">Sunset · Normal · Daybreak · Thrive</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color:var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Club of Bungoma Magharibi</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color:var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Club of Bungoma</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color:var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotaract Club of Bungoma Magharibi</h6>
                </div>
            </div>
        </div>

        <h5 class="text-center fw-bold mb-4" style="color:var(--primary-green);" data-aos="fade-up">On-Site Team</h5>
        <div class="row justify-content-center g-4">
            <?php
            $team = [
                ['Rtn. Clara Bundotich','Project Lead'],
                ['Rtn. Gilbert Mwangi','Bungoma Magharibi RC'],
                ['Rotaract Stephen Gathutha','Field Coordinator'],
                ['Rotaract Julie Gitau','Community Liaison'],
            ];
            foreach($team as $i => $m):
            ?>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="<?php echo $i*100; ?>">
                <div class="text-center">
                    <div class="team-avatar"><i class="fas fa-user"></i></div>
                    <p class="fw-bold mb-1 small"><?php echo $m[0]; ?></p>
                    <small class="text-muted"><?php echo $m[1]; ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- RESOURCES -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Project Resources</h2>
            <p class="text-muted">Documentation and research behind the project.</p>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-md-4" data-aos="fade-up">
                <a href="assets/documents/TLUD COOKSTOVE PROJECT REPORT.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-pdf fa-2x text-danger flex-shrink-0"></i>
                        <div>
                            <div class="fw-bold" style="color:var(--text-main);">Project Report</div>
                            <small class="text-muted">Full field report PDF</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <a href="assets/documents/TLUD Cookstoves Presentation.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-powerpoint fa-2x text-warning flex-shrink-0"></i>
                        <div>
                            <div class="fw-bold" style="color:var(--text-main);">TLUD Presentation</div>
                            <small class="text-muted">Slide deck overview</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <a href="assets/documents/PowerPellet-TLUD-ETHOS-2024-01-26.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-alt fa-2x text-primary flex-shrink-0"></i>
                        <div>
                            <div class="fw-bold" style="color:var(--text-main);">PowerPellet-TLUD ETHOS</div>
                            <small class="text-muted">Technical reference 2024</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <a href="https://www.woodgas.com" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-external-link-alt fa-2x flex-shrink-0" style="color:var(--logo-teal);"></i>
                        <div>
                            <div class="fw-bold" style="color:var(--text-main);">Woodgas International</div>
                            <small class="text-muted">Dr. Anderson's research hub</small>
                        </div>
                        <i class="fas fa-arrow-up-right-from-square ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background:linear-gradient(135deg,var(--primary-green),var(--logo-teal));color:white;">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Want to Partner With Us?</h2>
        <p class="lead mb-4 opacity-75" data-aos="fade-up">Join the mission to bring clean cooking to more communities across Kenya.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up">
            <a href="contact.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold" style="color:var(--primary-green);">Get in Touch</a>
            <a href="projects.php" class="btn btn-outline-light btn-lg rounded-pill px-4">View All Projects</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ once: true, offset: 80, duration: 800 });

/* ── Gallery pagination ── */
const galleryItems = document.querySelectorAll('.gallery-item');
const itemsPerPage = 3;
const totalPages = Math.ceil(galleryItems.length / itemsPerPage);
const paginationContainer = document.getElementById('pagination-controls');
let currentPage = 1;

function showPage(page) {
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    galleryItems.forEach(item => item.style.display = 'none');
    const start = (page - 1) * itemsPerPage;
    for (let i = start; i < start + itemsPerPage; i++) {
        if (galleryItems[i]) galleryItems[i].style.display = 'block';
    }
    renderPagination();
    document.getElementById('gallery-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function renderPagination() {
    paginationContainer.innerHTML = '';
    const prev = document.createElement('li');
    prev.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
    prev.innerHTML = '<a class="page-link" onclick="showPage(' + (currentPage - 1) + ')">Previous</a>';
    paginationContainer.appendChild(prev);
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = 'page-item' + (i === currentPage ? ' active' : '');
        li.innerHTML = '<a class="page-link" onclick="showPage(' + i + ')">' + i + '</a>';
        paginationContainer.appendChild(li);
    }
    const next = document.createElement('li');
    next.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
    next.innerHTML = '<a class="page-link" onclick="showPage(' + (currentPage + 1) + ')">Next</a>';
    paginationContainer.appendChild(next);
}
showPage(1);

/* ── Progress chart ── */
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('progressChart');
    if (!el) return;
    new Chart(el.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Distributed', 'Remaining'],
            datasets: [{ data: [500, 0], backgroundColor: ['#198754', '#e0e0e0'], borderWidth: 0 }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
            }
        }
    });
});

/* ── Video modal ── */
const videoPlayer = document.getElementById('mainVideoPlayer');
const videoRatio  = document.getElementById('videoRatio');
const videoModal  = document.getElementById('videoModal');

function loadVideo(src, isPortrait) {
    videoPlayer.src = src;
    videoPlayer.muted = true;
    const dlg = videoModal.querySelector('.modal-dialog');
    if (isPortrait) {
        videoRatio.classList.remove('ratio-16x9');
        videoRatio.classList.add('ratio-9x16');
        dlg.classList.remove('modal-lg');
        dlg.style.maxWidth = '300px';
        dlg.style.margin = '1.75rem auto';
    } else {
        videoRatio.classList.remove('ratio-9x16');
        videoRatio.classList.add('ratio-16x9');
        dlg.classList.add('modal-lg');
        dlg.style.maxWidth = '800px';
    }
    videoPlayer.play();
}

videoModal.addEventListener('hidden.bs.modal', function () {
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
    videoPlayer.src = '';
});
</script>

<?php include 'includes/footer.php'; ?>
