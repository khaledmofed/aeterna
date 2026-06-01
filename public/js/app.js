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

// 8. Hero canvas — ON-CHAIN AI circuit board animation
function initHeroCanvas() {
    const canvas = document.getElementById("hero-canvas");
    if (!canvas) return;

    const ctx = canvas.getContext("2d");
    let W = 0, H = 0, raf;

    // ── Config (light mode) ──────────────────────────────────
    const LINE_COLOR  = "rgba(26,26,26,0.13)";
    const NODE_COLOR  = "rgba(26,26,26,0.22)";
    const LINE_W      = 1.2;
    const COLS        = 11;
    const ROWS        = 7;
    const P_COUNT     = 32;   // particles
    const P_COLORS    = [
        { rgb: "100,180,60",  hex: "#64B43C" },  // green (saturated for light bg) ×3
        { rgb: "100,180,60",  hex: "#64B43C" },
        { rgb: "100,180,60",  hex: "#64B43C" },
        { rgb: "26,26,26",    hex: "#1A1A1A" },  // dark
    ];

    let segs = [];      // [{x1,y1,x2,y2}]
    let nodes = [];     // [{x,y}]
    let particles = [];

    // ── Build circuit grid ───────────────────────────────────
    function buildGrid() {
        segs  = [];
        nodes = [];
        const cw = W / COLS;
        const rh = H / ROWS;

        // Grid points with organic jitter
        const pts = [];
        for (let r = 0; r <= ROWS + 1; r++) {
            pts[r] = [];
            for (let c = 0; c <= COLS + 1; c++) {
                const edge = (r === 0 || r === ROWS || c === 0 || c === COLS);
                const jx = edge ? 0 : (Math.random() - 0.5) * cw * 0.4;
                const jy = edge ? 0 : (Math.random() - 0.5) * rh * 0.4;
                pts[r][c] = { x: (c - 0.5) * cw + jx, y: (r - 0.5) * rh + jy };
            }
        }

        // Density: avoid only the immediate text area (center ~15%), high elsewhere
        const edgeDensity = (x, y) => {
            const cx = Math.abs(x / W - 0.5) * 2;   // 0=center, 1=edge
            const cy = Math.abs(y / H - 0.5) * 2;
            const d  = Math.max(cx, cy);
            if (d < 0.12) return 0.03;  // text core — almost empty
            if (d < 0.28) return 0.30;  // close ring around text
            if (d < 0.60) return 0.65;  // main visible ring (where gradient is transparent)
            return 0.45;                 // outer (gradient will fade these out)
        };

        // Horizontal segments
        for (let r = 0; r <= ROWS + 1; r++) {
            for (let c = 0; c < COLS + 1; c++) {
                const a = pts[r][c], b = pts[r][c + 1];
                const density = edgeDensity((a.x + b.x) / 2, (a.y + b.y) / 2);
                if (Math.random() < density) {
                    segs.push({ x1: a.x, y1: a.y, x2: b.x, y2: b.y });
                    nodes.push(a, b);
                }
            }
        }

        // Vertical segments
        for (let r = 0; r < ROWS + 1; r++) {
            for (let c = 0; c <= COLS + 1; c++) {
                const a = pts[r][c], b = pts[r + 1][c];
                const density = edgeDensity((a.x + b.x) / 2, (a.y + b.y) / 2);
                if (Math.random() < density) {
                    segs.push({ x1: a.x, y1: a.y, x2: b.x, y2: b.y });
                    nodes.push(a, b);
                }
            }
        }

        // Deduplicate nodes (keep unique positions)
        const seen = new Set();
        nodes = nodes.filter(n => {
            const k = `${Math.round(n.x)},${Math.round(n.y)}`;
            if (seen.has(k)) return false;
            seen.add(k);
            return true;
        });

        // Spawn particles
        particles = [];
        for (let i = 0; i < P_COUNT; i++) spawnParticle();
    }

    function spawnParticle(existingSeg) {
        if (!segs.length) return;
        const s = existingSeg || segs[Math.floor(Math.random() * segs.length)];
        const col = P_COLORS[Math.floor(Math.random() * P_COLORS.length)];
        particles.push({
            s,
            t:     Math.random(),
            dir:   Math.random() > 0.5 ? 1 : -1,
            speed: Math.random() * 0.0015 + 0.0006,
            rgb:   col.rgb,
            hex:   col.hex,
            size:  Math.random() * 2.0 + 1.8,
            phase: Math.random() * Math.PI * 2,
        });
    }

    // ── Resize ───────────────────────────────────────────────
    const resize = () => {
        W = canvas.clientWidth  || window.innerWidth;
        H = canvas.clientHeight || window.innerHeight;
        canvas.width  = W;
        canvas.height = H;
        buildGrid();
    };

    window.addEventListener("resize", () => {
        cancelAnimationFrame(raf);
        resize();
        raf = requestAnimationFrame(draw);
    }, { passive: true });

    // Scroll parallax
    const wrapper = document.getElementById("hero-canvas-wrapper");
    window.addEventListener("scroll", () => {
        if (wrapper) wrapper.style.transform = `translateY(${window.scrollY * 0.28}px)`;
    }, { passive: true });

    // ── Draw loop ────────────────────────────────────────────
    function draw() {
        ctx.clearRect(0, 0, W, H);
        const now = performance.now() * 0.001;

        // Circuit lines
        ctx.lineWidth = LINE_W;
        ctx.lineCap   = "round";
        ctx.strokeStyle = LINE_COLOR;
        for (const seg of segs) {
            ctx.beginPath();
            ctx.moveTo(seg.x1, seg.y1);
            ctx.lineTo(seg.x2, seg.y2);
            ctx.stroke();
        }

        // Junction nodes
        ctx.fillStyle = NODE_COLOR;
        for (const n of nodes) {
            ctx.beginPath();
            ctx.arc(n.x, n.y, 2, 0, Math.PI * 2);
            ctx.fill();
        }

        // Particles
        for (const p of particles) {
            p.t += p.speed * p.dir;

            // At end: pick a new random segment (simulate routing)
            if (p.t >= 1 || p.t <= 0) {
                const newSeg = segs[Math.floor(Math.random() * segs.length)];
                p.s   = newSeg;
                p.t   = p.dir > 0 ? 0 : 1;
                p.dir = Math.random() > 0.5 ? 1 : -1;
            }

            const x = p.s.x1 + (p.s.x2 - p.s.x1) * p.t;
            const y = p.s.y1 + (p.s.y2 - p.s.y1) * p.t;
            const pulse = 0.85 + Math.sin(now * 2.8 + p.phase) * 0.15;
            const glowR = p.size * 16 * pulse;

            // Outer glow halo
            const grd = ctx.createRadialGradient(x, y, 0, x, y, glowR);
            grd.addColorStop(0,    `rgba(${p.rgb},0.55)`);
            grd.addColorStop(0.3,  `rgba(${p.rgb},0.20)`);
            grd.addColorStop(0.7,  `rgba(${p.rgb},0.06)`);
            grd.addColorStop(1,    `rgba(${p.rgb},0)`);
            ctx.fillStyle = grd;
            ctx.beginPath();
            ctx.arc(x, y, glowR, 0, Math.PI * 2);
            ctx.fill();

            // Core dot
            ctx.beginPath();
            ctx.arc(x, y, p.size * 1.4 * pulse, 0, Math.PI * 2);
            ctx.fillStyle = p.hex;
            ctx.fill();

            // Trailing tail
            const dx = (p.s.x2 - p.s.x1);
            const dy = (p.s.y2 - p.s.y1);
            const len = Math.sqrt(dx * dx + dy * dy) || 1;
            const tx = -(dx / len) * p.dir * 28;
            const ty = -(dy / len) * p.dir * 28;
            const tail = ctx.createLinearGradient(x, y, x + tx, y + ty);
            tail.addColorStop(0, `rgba(${p.rgb},0.35)`);
            tail.addColorStop(1, `rgba(${p.rgb},0)`);
            ctx.lineWidth = p.size * 1.4;
            ctx.strokeStyle = tail;
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + tx, y + ty);
            ctx.stroke();
        }

        raf = requestAnimationFrame(draw);
    }

    resize();
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
