/**
 * On Solutions - Main JavaScript
 * Microanimações, scroll effects, interatividade
 */
document.addEventListener('DOMContentLoaded', function() {

    // === Navbar Scroll Effect ===
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        const handleScroll = () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // === Scroll Animations (Intersection Observer) ===
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -40px 0px',
        threshold: 0.05
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observar elementos animáveis
    const animateElements = document.querySelectorAll(
        '.service-card, .portfolio-card, .blog-card, .testimonial-card, .process-step, .partner-card, .stat'
    );
    animateElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1) ${index % 4 * 0.1}s, transform 0.7s cubic-bezier(0.4, 0, 0.2, 1) ${index % 4 * 0.1}s`;
        observer.observe(el);
    });

    // Observar elementos com classe reveal-up (About page, etc.)
    const revealElements = document.querySelectorAll('.reveal-up');
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { root: null, rootMargin: '0px', threshold: 0 });

    revealElements.forEach((el, index) => {
        // Se o elemento já está visível na viewport ao carregar, revelar direto
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            setTimeout(() => { el.classList.add('revealed'); }, 100 + index * 120);
        } else {
            el.style.transitionDelay = `${(index % 4) * 0.1}s`;
            revealObserver.observe(el);
        }
    });

    // Fallback: se após 2s ainda houver elementos escondidos, revelar tudo
    setTimeout(() => {
        document.querySelectorAll('.reveal-up:not(.revealed)').forEach(el => {
            el.classList.add('revealed');
        });
    }, 2000);

    // === Cookie Banner ===
    const cookieBanner = document.getElementById('cookieBanner');
    if (cookieBanner && !localStorage.getItem('cookieConsent')) {
        setTimeout(() => { cookieBanner.style.display = 'block'; }, 1500);
    }
    document.getElementById('cookieAccept')?.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieBanner.style.display = 'none';
    });
    document.getElementById('cookieReject')?.addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'rejected');
        cookieBanner.style.display = 'none';
    });

    // === Portfolio Filter ===
    const filterBtns = document.querySelectorAll('.portfolio-filters .btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            portfolioItems.forEach(item => {
                const show = filter === 'all' || item.dataset.category === filter;
                item.style.opacity = show ? '1' : '0';
                item.style.transform = show ? 'scale(1)' : 'scale(0.9)';
                setTimeout(() => { item.style.display = show ? '' : 'none'; }, show ? 0 : 300);
            });
        });
    });

    // === Smooth Scroll ===
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // === Flash Messages Auto-dismiss ===
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // === Newsletter AJAX ===
    document.querySelectorAll('form[action*="newsletter/subscribe"]').forEach(form => {
        // Ignorar formulário da home (tem handler próprio inline)
        if (form.id === 'newsletterHomeForm') return;
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const btn = this.querySelector('button[type="submit"]');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                const message = data.message || data.error || 'Inscrição realizada com sucesso!';
                const type = data.success ? 'success' : 'danger';
                showToast(message, type);
                if (data.success) this.reset();
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            })
            .catch((err) => {
                showToast('Ocorreu um erro. Tente novamente.', 'danger');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        });
    });

    // === Toast Notification ===
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed; top: 20px; right: 20px; z-index: 10000;
            padding: 1rem 1.5rem; border-radius: 10px; font-size: 0.9rem; font-weight: 500;
            color: white; max-width: 360px;
            background: ${type === 'success' ? '#059669' : type === 'danger' ? '#dc2626' : '#0d9488'};
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            animation: fadeInUp 0.3s ease;
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-10px)';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    // === Counter Animation for Stats ===
    const statNumbers = document.querySelectorAll('.hero-stats .stat strong');
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.textContent);
                if (isNaN(target)) return;
                let current = 0;
                const increment = Math.ceil(target / 40);
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) { current = target; clearInterval(timer); }
                    el.textContent = current + (el.textContent.includes('%') ? '%' : '+');
                }, 30);
                statsObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    statNumbers.forEach(el => statsObserver.observe(el));
});
