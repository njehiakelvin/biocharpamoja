<?php
$page_title = "PowerPellet TLUD Cookstoves";
include '../includes/header.php';
?>

<!-- AOS + Chart.js -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* ── Page-scoped styles ── */
.tlud-hero {
    background: url('../assets/images/tlud.jpg') no-repeat center center / cover;
    min-height: 85vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-top: -80px; /* bleed under fixed nav */
    padding-top: 80px;
}
.tlud-hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.65) 60%, rgba(25,135,84,0.45));
}
.tlud-hero-content { position: relative; z-index: 2; }

/* Breadcrumb */
.project-breadcrumb {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-color);
    padding: 12px 0;
    font-size: 0.88rem;
}
.project-breadcrumb a { color: var(--primary-green); }
.project-breadcrumb .separator { margin: 0 8px; color: var(--text-muted); }

/* Impact strip */
.impact-strip {
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    color: white;
    padding: 50px 0;
}
.impact-strip .stat-num {
    font-size: 2.8rem;
    font-weight: 900;
    line-height: 1;
}
.impact-strip .stat-label {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.9;
}

/* Feature cards */
.feature-card {
    border: none;
    border-radius: 15px;
    padding: 30px;
    height: 100%;
    background: var(--bg-card);
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}
.feature-card:hover { transform: translateY(-5px); }
.feature-card .icon-wrap {
    width: 60px; height: 60px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    font-size: 1.4rem;
}

/* Beneficiary gallery */
.beneficiary-carousel .carousel-item img {
    height: 250px;
    width: 100%;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.gallery-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    background: var(--bg-card);
}
.pagination .page-link { color: var(--primary-green); background: var(--bg-card); border-color: var(--border-color); }
.pagination .page-item.active .page-link { background: var(--primary-green); border-color: var(--primary-green); color: white; }

/* Video cards */
.video-card {
    position: relative; border-radius: 12px; overflow: hidden;
    cursor: pointer; transition: transform 0.3s; background: #000;
    box-shadow: var(--shadow);
}
.video-card:hover { transform: translateY(-5px); }
.video-thumbnail { width: 100%; height: 220px; object-fit: cover; opacity: 0.8; transition: opacity 0.3s; }
.video-card:hover .video-thumbnail { opacity: 0.6; }
.play-btn-overlay {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: 60px; height: 60px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    box-shadow: 0 0 20px rgba(255,255,255,0.5);
    transition: transform 0.3s;
}
.play-btn-overlay i { color: var(--primary-green); font-size: 22px; margin-left: 4px; }
.video-card:hover .play-btn-overlay { transform: translate(-50%,-50%) scale(1.1); }

/* Shorts scroll */
.shorts-container {
    display: flex; overflow-x: auto; gap: 20px; padding: 20px 5px;
    scrollbar-width: thin; scrollbar-color: var(--primary-green) var(--bg-secondary);
}
.shorts-container::-webkit-scrollbar { height: 8px; }
.shorts-container::-webkit-scrollbar-track { background: var(--bg-secondary); border-radius: 4px; }
.shorts-container::-webkit-scrollbar-thumb { background: var(--primary-green); border-radius: 4px; }
.short-card {
    min-width: 200px; max-width: 200px; height: 350px;
    position: relative; border-radius: 15px; overflow: hidden;
    cursor: pointer; flex-shrink: 0;
    box-shadow: var(--shadow); transition: transform 0.3s;
}
.short-card:hover { transform: translateY(-5px); }
.short-thumbnail { width: 100%; height: 100%; object-fit: cover; }
.short-play {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: 40px; height: 40px;
    background: rgba(255,255,255,0.9); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.short-play i { color: var(--primary-green); font-size: 16px; margin-left: 3px; }

/* Partner cards */
.partner-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    height: 100%;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}
.partner-card:hover { transform: translateY(-4px); }

/* Team */
.team-card { text-align: center; }
.team-card .avatar {
    width: 80px; height: 80px;
    background: linear-gradient(135deg, var(--primary-green), var(--logo-teal));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.8rem; color: white;
}

/* Section bg alternation */
.section-alt { background-color: var(--bg-secondary); }

/* Progress bar */
.progress { border-radius: 50px; }
.progress-bar { border-radius: 50px; }
</style>

<!-- Breadcrumb -->
<div class="project-breadcrumb">
    <div class="container">
        <a href="../index.php">Home</a>
        <span class="separator">›</span>
        <a href="../projects.php">Projects</a>
        <span class="separator">›</span>
        <span style="color: var(--text-muted);">PowerPellet TLUD Cookstoves</span>
    </div>
</div>

<!-- HERO -->
<section class="tlud-hero">
    <div class="tlud-hero-overlay"></div>
    <div class="tlud-hero-content text-center text-white px-3" data-aos="zoom-in" data-aos-duration="1000">
        <span class="badge bg-success mb-3 px-3 py-2" style="font-size:0.9rem; letter-spacing:1px;">CLEAN ENERGY PROJECT</span>
        <h1 class="display-3 fw-bold mb-3">Service Above Self</h1>
        <p class="lead mb-4" style="max-width:650px; margin:0 auto 28px;">Transforming Health, Homes, and Hope in Bungoma through clean cooking solutions — one stove at a time.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#project" class="btn btn-success btn-lg rounded-pill px-4">Our Story <i class="fas fa-arrow-down ms-2"></i></a>
            <a href="../assets/documents/TLUD COOKSTOVE PROJECT REPORT.pdf" class="btn btn-outline-light btn-lg rounded-pill px-4" target="_blank">
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
                <div class="stat-num">500</div>
                <div class="stat-label mt-1">Stoves Distributed</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-num">14+</div>
                <div class="stat-label mt-1">Women's Groups</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-num">4</div>
                <div class="stat-label mt-1">Rotary Club Partners</div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-num">2yr</div>
                <div class="stat-label mt-1">Dec 2023 – Dec 2025</div>
            </div>
        </div>
    </div>
</div>

<!-- PROGRESS DASHBOARD -->
<section class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Project Progress</h2>
            <p class="text-muted">Tracking our distribution across Bungoma County.</p>
        </div>
        <div class="row align-items-center g-5">
            <div class="col-md-5 text-center" data-aos="fade-right">
                <div style="height: 280px; position: relative; max-width: 280px; margin: 0 auto;">
                    <canvas id="progressChart"></canvas>
                </div>
            </div>
            <div class="col-md-7" data-aos="fade-left">
                <div class="p-4 rounded-4" style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                    <h3 class="fw-bold mb-1" style="color: var(--primary-green);">500 / 500 Stoves Distributed</h3>
                    <p class="text-muted mb-3">Goal achieved — targeting 14+ Women Self-Help Groups across Bungoma County.</p>
                    <div class="progress mb-4" style="height: 22px;">
                        <div class="progress-bar bg-success fw-bold" style="width: 100%;">100% Complete</div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-3 text-center" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                                <div class="fw-bold fs-4" style="color: var(--primary-green);">500</div>
                                <small class="text-muted">Stoves Delivered</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 text-center" style="background: var(--bg-card); border: 1px solid var(--border-color);">
                                <div class="fw-bold fs-4" style="color: var(--logo-teal);">14+</div>
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
            <h2>Transforming Health, Homes & Hope</h2>
            <p class="text-muted">A powerful demonstration of what Rotary's spirit of service can achieve when clubs unite across continents.</p>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9" data-aos="fade-up">
                <p class="lead text-muted" style="line-height:1.9;">
                    Through a remarkable Club-to-Club partnership, the Rotary Clubs of Bloomington–Normal (Sunset, Normal, Daybreak, and Thrive) in District 6490 have joined hands with the Rotary Club of Bungoma Magharibi, the Rotary Club of Bungoma, and the Rotaract Club of Bungoma Magharibi to deliver life-changing clean cooking solutions. Launched in December 2023 and progressing through December 2025, this initiative focuses on improving health, protecting the environment, and uplifting livelihoods through the donation of 500 TLUD clean cookstoves.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card">
                    <div class="icon-wrap bg-danger bg-opacity-10">
                        <i class="fas fa-fire text-danger"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Technology That Changes Lives</h5>
                    <p class="text-muted mb-0">The TLUD cookstove is a modern, efficient, and low-emission stove designed to burn pellets cleanly — dramatically reducing indoor smoke and improving air quality. Women who once endured burning eyes and smoke-filled kitchens can now cook faster, cleaner, and more safely.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="icon-wrap bg-success bg-opacity-10">
                        <i class="fas fa-users text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Community Voices, Real Impact</h5>
                    <p class="text-muted mb-0">From Nengelwa to Mumias, the gratitude is profound. Women elders speak of preparing meals without smoke choking their kitchens. Chairpersons of women's groups celebrate relief from firewood collection, and mothers testify how the stoves bring dignity to meal preparation.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="icon-wrap bg-primary bg-opacity-10">
                        <i class="fas fa-handshake text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">A Partnership Rooted in Service</h5>
                    <p class="text-muted mb-0">This project is made possible by Rotary's unique ability to connect caring hearts across borders. Members from both regions have walked together from idea conception to community outreach to ensure that every cookstove donated brings lasting value.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="icon-wrap bg-warning bg-opacity-10">
                        <i class="fas fa-leaf text-warning"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Beyond Cooking</h5>
                    <ul class="text-muted mb-0 ps-3" style="line-height:2;">
                        <li>Better health through reduced indoor air pollution</li>
                        <li>Environmental restoration by reducing firewood reliance</li>
                        <li>Economic empowerment by saving time and money</li>
                        <li>Stronger families through safer cooking options</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENEFICIARY GALLERY -->
<section class="py-5" id="gallery" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Beneficiaries & Stories</h2>
            <p class="text-muted">Witness the impact on daily lives across Bungoma County.</p>
        </div>

        <div id="gallery-container" class="row g-4 mb-4">

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-300" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/mazingira1.jpg" class="d-block w-100" alt="Mazingira WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/mazingira2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/mazingira3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/mazingira4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-300" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-300" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Mazingira WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 22, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-200" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/wabukhonyi1.jpg" class="d-block w-100" alt="Wabukhonyi WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/wabukhonyi2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/wabukhonyi3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/wabukhonyi4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-200" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-200" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Wabukhonyi WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 20, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-1" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/kumia1.jpg" class="d-block w-100" alt="Kumia WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/kumia2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/kumia3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/kumia4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-1" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-1" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Kumia WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 19, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-100" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/mapema1.jpg" class="d-block w-100" alt="Mapema WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/mapema2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/mapema3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/mapema4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-100" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-100" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Mapema Ndio Best WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Dec 19, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-t" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/jamia tawasul 2025 1.jpg" class="d-block w-100" alt="Jamia Tawasul WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/jamia tawasul 2025 2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/jamia tawasul 2025 3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/jamia tawasul 2025 4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-t" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-t" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Jamia Tawasul WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>Nov 21, 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-j" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/Jamia Tawasul 1.jpg" class="d-block w-100" alt="Jamia Tawasul WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/Jamia Tawasul 2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/Jamia Tawasul 3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/Jamia Tawasul 4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-j" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-j" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Jamia Tawasul WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>May 2024 – May 2025</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 gallery-item">
                <div class="gallery-card h-100">
                    <div id="carousel-2" class="carousel slide beneficiary-carousel" data-bs-ride="carousel" data-bs-interval="4500">
                        <div class="carousel-inner">
                            <div class="carousel-item active"><img src="../assets/images/Sikata Champions 1.jpg" class="d-block w-100" alt="Sikata Champions WSG"></div>
                            <div class="carousel-item"><img src="../assets/images/Sikata Champions 2.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/Sikata Champions 3.jpg" class="d-block w-100" alt="Photo"></div>
                            <div class="carousel-item"><img src="../assets/images/Sikata Champions 4.jpg" class="d-block w-100" alt="Photo"></div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-2" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-2" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                    </div>
                    <div class="card-body p-3 text-center">
                        <h6 class="fw-bold mb-1">Sikata Champions WSG</h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt text-success me-1"></i>2024</small>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <nav aria-label="Gallery pagination">
            <ul class="pagination justify-content-center" id="pagination-controls"></ul>
        </nav>
    </div>
</section>

<!-- VIDEOS SECTION -->
<section class="py-5 section-alt">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Field Videos</h2>
            <p class="text-muted">See the project in action across Bungoma County.</p>
        </div>

        <!-- Landscape videos -->
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/video_1.mp4', false)">
                    <img src="../assets/images/thumbnail1.jpg" class="video-thumbnail" alt="Video 1" onerror="this.src='../assets/images/tlud.jpg'">
                    <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/video_2.mp4', false)">
                    <img src="../assets/images/thumbnail2.jpg" class="video-thumbnail" alt="Video 2" onerror="this.src='../assets/images/tlud.jpg'">
                    <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="video-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/video_3.mp4', false)">
                    <img src="../assets/images/thumbnail3.jpg" class="video-thumbnail" alt="Video 3" onerror="this.src='../assets/images/tlud.jpg'">
                    <div class="play-btn-overlay"><i class="fas fa-play"></i></div>
                </div>
            </div>
        </div>

        <!-- Shorts -->
        <h5 class="fw-bold mb-3" data-aos="fade-up">Shorts <span class="text-muted fw-normal fs-6">— swipe to explore</span></h5>
        <div class="shorts-container" data-aos="fade-up">
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_1.mp4', true)">
                <img src="../assets/images/portrait1.png" class="short-thumbnail" alt="Short 1" onerror="this.src='../assets/images/tlud.jpg'">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_2.mp4', true)">
                <img src="../assets/images/portrait2.png" class="short-thumbnail" alt="Short 2" onerror="this.src='../assets/images/tlud.jpg'">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_3.mp4', true)">
                <img src="../assets/images/portrait3.png" class="short-thumbnail" alt="Short 3" onerror="this.src='../assets/images/tlud.jpg'">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_4.mp4', true)">
                <img src="../assets/images/portrait4.png" class="short-thumbnail" alt="Short 4" onerror="this.src='../assets/images/tlud.jpg'">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_5.mp4', true)">
                <img src="../assets/images/portrait5.png" class="short-thumbnail" alt="Short 5" onerror="this.src='../assets/images/tlud.jpg'">
                <div class="short-play"><i class="fas fa-play"></i></div>
            </div>
            <div class="short-card" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="loadVideo('../assets/videos/portrait_6.mp4', true)">
                <img src="../assets/images/portrait6.png" class="short-thumbnail" alt="Short 6" onerror="this.src='../assets/images/tlud.jpg'">
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
<section id="partners" class="py-5" style="background-color: var(--bg-body);">
    <div class="container">
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2>Our Partners</h2>
            <p class="text-muted">This project is built on cross-continental collaboration.</p>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color: var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Clubs of Bloomington-Normal</h6>
                    <small class="text-muted">Sunset · Normal · Daybreak · Thrive</small>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color: var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Club of Bungoma Magharibi</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color: var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotary Club of Bungoma</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="partner-card">
                    <i class="fas fa-handshake fa-2x mb-3" style="color: var(--primary-green);"></i>
                    <h6 class="fw-bold">Rotaract Club of Bungoma Magharibi</h6>
                </div>
            </div>
        </div>

        <!-- On-site team -->
        <h4 class="text-center fw-bold mb-4" style="color: var(--primary-green);" data-aos="fade-up">On-Site Team</h4>
        <div class="row justify-content-center g-4">
            <?php
            $team = [
                ['name' => 'Rtn. Clara Bundotich', 'role' => 'Project Lead'],
                ['name' => 'Rtn. Gilbert Mwangi', 'role' => 'Bungoma Magharibi RC'],
                ['name' => 'Rotaract Stephen Gathutha', 'role' => 'Field Coordinator'],
                ['name' => 'Rotaract Julie Gitau', 'role' => 'Community Liaison'],
            ];
            foreach($team as $i => $member):
            ?>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                <div class="team-card">
                    <div class="avatar"><i class="fas fa-user"></i></div>
                    <p class="fw-bold mb-1"><?php echo $member['name']; ?></p>
                    <small class="text-muted"><?php echo $member['role']; ?></small>
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
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <a href="../assets/documents/TLUD COOKSTOVE PROJECT REPORT.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                        <div>
                            <div class="fw-bold">Project Report</div>
                            <small class="text-muted">Full field report PDF</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <a href="../assets/documents/TLUD Cookstoves Presentation.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-powerpoint fa-2x text-warning"></i>
                        <div>
                            <div class="fw-bold">TLUD Presentation</div>
                            <small class="text-muted">Slide deck overview</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <a href="../assets/documents/PowerPellet-TLUD-ETHOS-2024-01-26.pdf" target="_blank" class="text-decoration-none">
                    <div class="feature-card d-flex align-items-center gap-3">
                        <i class="fas fa-file-alt fa-2x text-primary"></i>
                        <div>
                            <div class="fw-bold">PowerPellet-TLUD ETHOS</div>
                            <small class="text-muted">Technical reference 2024</small>
                        </div>
                        <i class="fas fa-download ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background: linear-gradient(135deg, var(--primary-green), var(--logo-teal)); color: white;">
    <div class="container">
        <h2 class="fw-bold mb-3" data-aos="fade-up">Want to Partner With Us?</h2>
        <p class="lead mb-4 opacity-75" data-aos="fade-up">Join the mission to bring clean cooking to more communities across Kenya.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap" data-aos="fade-up">
            <a href="../contact.php" class="btn btn-light btn-lg rounded-pill px-4 fw-bold" style="color: var(--primary-green);">Get in Touch</a>
            <a href="../projects.php" class="btn btn-outline-light btn-lg rounded-pill px-4">View All Projects</a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ once: true, offset: 80, duration: 800 });

// Gallery Pagination
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
    document.getElementById('gallery').scrollIntoView({ behavior: 'smooth' });
}

function renderPagination() {
    paginationContainer.innerHTML = '';
    const prev = document.createElement('li');
    prev.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prev.innerHTML = `<a class="page-link" onclick="showPage(${currentPage - 1})">Previous</a>`;
    paginationContainer.appendChild(prev);
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<a class="page-link" onclick="showPage(${i})">${i}</a>`;
        paginationContainer.appendChild(li);
    }
    const next = document.createElement('li');
    next.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
    next.innerHTML = `<a class="page-link" onclick="showPage(${currentPage + 1})">Next</a>`;
    paginationContainer.appendChild(next);
}
showPage(1);

// Progress Chart
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('progressChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Distributed', 'Remaining'],
                datasets: [{ data: [500, 0], backgroundColor: ['#198754', '#e0e0e0'], borderWidth: 0 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '72%',
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
                }
            }
        });
    }
});

// Video Modal
const videoPlayer = document.getElementById('mainVideoPlayer');
const videoRatio = document.getElementById('videoRatio');
const videoModal = document.getElementById('videoModal');

function loadVideo(src, isPortrait = false) {
    videoPlayer.src = src;
    videoPlayer.muted = true;
    const modalDialog = document.querySelector('#videoModal .modal-dialog');
    if (isPortrait) {
        videoRatio.classList.remove('ratio-16x9');
        videoRatio.classList.add('ratio-9x16');
        modalDialog.classList.remove('modal-lg');
        modalDialog.style.maxWidth = '300px';
    } else {
        videoRatio.classList.remove('ratio-9x16');
        videoRatio.classList.add('ratio-16x9');
        modalDialog.style.maxWidth = '800px';
        modalDialog.classList.add('modal-lg');
    }
    videoPlayer.play();
}

videoModal.addEventListener('hidden.bs.modal', function () {
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
    videoPlayer.src = "";
});
</script>

<?php include '../includes/footer.php'; ?>
