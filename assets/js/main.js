document.addEventListener("DOMContentLoaded", () => {
    // 1. Theme Toggle Logic
    const toggleBtn = document.getElementById('theme-toggle');
    const toggleIcon = toggleBtn ? toggleBtn.querySelector('i') : null;
    const body = document.body;
    
    // Check saved preference
    const savedTheme = localStorage.getItem('theme');
    
    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        if(toggleIcon) {
            toggleIcon.classList.remove('fa-moon');
            toggleIcon.classList.add('fa-sun');
        }
    }

    if(toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                toggleIcon.classList.remove('fa-moon');
                toggleIcon.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                toggleIcon.classList.remove('fa-sun');
                toggleIcon.classList.add('fa-moon');
            }
        });
    }
});

window.addEventListener("load", () => {
    // 2. Loader Logic
    const loader = document.getElementById("loader-wrapper");

    // Force loader hide after 1.5 seconds maximum to prevent blocking
    setTimeout(() => {
        if(loader) {
            loader.classList.add("hidden");
            document.body.classList.add("loaded");
            setTimeout(() => {
                loader.style.display = "none";
            }, 500);
        }
    }, 1500); 
});
// ── Lazy image loading ──────────────────────────────────────────
(function() {
    // Add lazy class to all content images not already marked
    document.querySelectorAll('img:not([loading])').forEach(img => {
        img.setAttribute('loading', 'lazy');
        img.classList.add('lazy');
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', () => img.classList.add('loaded'));
        }
    });

    // IntersectionObserver for browsers that need it
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        }, { rootMargin: '200px' });

        document.querySelectorAll('img.lazy').forEach(img => observer.observe(img));
    }
})();