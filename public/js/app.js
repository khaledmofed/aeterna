/* AeternaX ; Main JS */

document.addEventListener("DOMContentLoaded", () => {
    initNavbar();
    initMobileMenu();
    initScrollReveal();
    initStickyNavHighlight();
    initSubscribeForm();
    initArchitectureTabs();
    initBackToTop();
    initHeroCanvas();
    initCardSpotlight();
});

// 1. Navbar scroll effect
function initNavbar() {
    const nav = document.getElementById("main-nav");
    if (!nav) return;
    window.addEventListener(
        "scroll",
        () => {
            nav.classList.toggle("scrolled", window.scrollY > 50);
        },
        { passive: true },
    );
}

// 2. Mobile menu
function initMobileMenu() {
    const btn = document.getElementById("menu-toggle");
    const menu = document.getElementById("mobile-menu");
    const close = document.getElementById("menu-close");
    if (!btn || !menu) return;

    btn.addEventListener("click", () => {
        menu.classList.remove("hidden");
        menu.classList.add("flex");
        document.body.style.overflow = "hidden";
    });

    const closeMenu = () => {
        menu.classList.add("hidden");
        menu.classList.remove("flex");
        document.body.style.overflow = "";
    };

    if (close) close.addEventListener("click", closeMenu);
    menu.querySelectorAll("a").forEach((a) =>
        a.addEventListener("click", closeMenu),
    );
}

// 3. Scroll reveal via IntersectionObserver
function initScrollReveal() {
    const elements = document.querySelectorAll("[data-animate]");
    if (!elements.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animated");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1 },
    );

    elements.forEach((el) => observer.observe(el));
}

// 4. Sticky nav section highlight
function initStickyNavHighlight() {
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll("[data-nav-link]");
    if (!sections.length || !navLinks.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    navLinks.forEach((link) => {
                        link.classList.toggle(
                            "text-nexus-yellow",
                            link.getAttribute("href") === "#" + entry.target.id,
                        );
                    });
                }
            });
        },
        { rootMargin: "-30% 0px -60% 0px" },
    );

    sections.forEach((s) => observer.observe(s));
}

// 5. Email subscribe AJAX
function initSubscribeForm() {
    const form = document.getElementById("subscribe-form");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const email = form.querySelector('input[name="email"]').value;
        const msgEl = document.getElementById("subscribe-message");
        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;

        try {
            const res = await fetch("/subscribe", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,
                    Accept: "application/json",
                },
                body: JSON.stringify({ email }),
            });
            const data = await res.json();
            if (msgEl) {
                msgEl.textContent = data.message;
                msgEl.className = res.ok
                    ? "text-nexus-yellow text-sm mt-2"
                    : "text-red-400 text-sm mt-2";
                msgEl.style.display = "block";
            }
            if (res.ok) form.reset();
        } catch {
            if (msgEl) {
                msgEl.textContent = "An error occurred. Please try again.";
                msgEl.style.display = "block";
            }
        } finally {
            btn.disabled = false;
        }
    });
}

// 6. Architecture tabs
function initArchitectureTabs() {
    const tabs = document.querySelectorAll("[data-arch-tab]");
    const panels = document.querySelectorAll("[data-arch-panel]");
    if (!tabs.length) return;

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            const target = tab.getAttribute("data-arch-tab");
            tabs.forEach((t) => t.classList.remove("active-tab"));
            tab.classList.add("active-tab");

            panels.forEach((panel) => {
                const show = panel.getAttribute("data-arch-panel") === target;
                panel.classList.toggle("hidden", !show);
                if (show) {
                    panel.classList.remove("animate-fade-in-up");
                    void panel.offsetWidth; // reflow
                    panel.classList.add("animate-fade-in-up");
                }
            });
        });
    });

    // Activate first tab
    if (tabs[0]) tabs[0].click();
}

// 7. Back to top
function initBackToTop() {
    const btn = document.getElementById("back-to-top");
    if (!btn) return;

    window.addEventListener(
        "scroll",
        () => {
            btn.classList.toggle("opacity-100", window.scrollY > 400);
            btn.classList.toggle("opacity-0", window.scrollY <= 400);
        },
        { passive: true },
    );

    btn.addEventListener("click", () =>
        window.scrollTo({ top: 0, behavior: "smooth" }),
    );
}

// 8. Hero canvas particle network
function initHeroCanvas() {
    const canvas = document.getElementById("hero-canvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");
    let W, H;

    const resize = () => {
        W = canvas.clientWidth;
        H = canvas.clientHeight;
        canvas.width = W;
        canvas.height = H;
    };
    resize();
    window.addEventListener("resize", resize, { passive: true });

    const COUNT = 110;
    const CONNECT = 130;
    const particles = Array.from({ length: COUNT }, () => ({
        x: Math.random() * (W || 1440),
        y: Math.random() * (H || 900),
        vx: (Math.random() - 0.5) * 0.25,
        vy: (Math.random() - 0.5) * 0.25,
        r: Math.random() * 1.4 + 0.3,
        o: Math.random() * 0.55 + 0.1,
    }));

    // Scroll parallax on wrapper
    const wrapper = document.getElementById("hero-canvas-wrapper");
    window.addEventListener(
        "scroll",
        () => {
            if (wrapper)
                wrapper.style.transform = `translateY(${window.scrollY * 0.35}px)`;
        },
        { passive: true },
    );

    let raf;
    function draw() {
        ctx.clearRect(0, 0, W, H);

        for (const p of particles) {
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0) p.x = W;
            if (p.x > W) p.x = 0;
            if (p.y < 0) p.y = H;
            if (p.y > H) p.y = 0;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(0,0,0,${p.o * 0.4})`;
            ctx.fill();
        }

        ctx.lineWidth = 0.6;
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < CONNECT) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(0,0,0,${(1 - dist / CONNECT) * 0.08})`;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }

        raf = requestAnimationFrame(draw);
    }
    draw();
}

// 9. Card spotlight ; mouse-follow glow
function initCardSpotlight() {
    document.querySelectorAll(".card-spotlight").forEach((card) => {
        card.addEventListener("mousemove", (e) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty("--mouse-x", e.clientX - rect.left + "px");
            card.style.setProperty("--mouse-y", e.clientY - rect.top + "px");
        });
    });
}
