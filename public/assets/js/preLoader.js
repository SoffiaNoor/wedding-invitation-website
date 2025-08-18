document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('page-preloader');
    const percentEl = document.getElementById('preloader-percent');
    const barEl = document.getElementById('preloader-bar');
    const main = document.getElementById('mainContent');

    function collectImageUrls() {
        const urls = new Set();

        document.querySelectorAll('img').forEach(img => {
            const dataSrc = img.getAttribute('data-src') || img.getAttribute('data-lazy') || img.dataset.src;
            const src = dataSrc || img.getAttribute('src');
            if (src) urls.add(src);
        });

        document.querySelectorAll('[data-bg]').forEach(el => {
            const bg = el.getAttribute('data-bg');
            if (bg) urls.add(bg);
        });

        const allElems = Array.from(document.querySelectorAll('body *'));
        const limit = 1500;
        const candidates = allElems.slice(0, Math.min(limit, allElems.length));
        const urlRegex = /url\(["']?([^"')]+)["']?\)/g;
        candidates.forEach(el => {
            try {
                const cs = getComputedStyle(el);
                const bg = cs && cs.backgroundImage;
                if (bg && bg !== 'none') {
                    let match;
                    while ((match = urlRegex.exec(bg)) !== null) {
                        if (match[1]) urls.add(match[1]);
                    }
                }
            } catch (e) {
            }
        });

        return Array.from(urls).filter(u => u && !u.startsWith('data:'));
    }

    function preloadUrls(urls, onProgress) {
        let loaded = 0;
        const total = urls.length;
        if (total === 0) return Promise.resolve();

        return new Promise(resolve => {
            urls.forEach(url => {
                const img = new Image();
                img.onload = img.onerror = function () {
                    loaded++;
                    onProgress(loaded, total, url);
                    if (loaded >= total) resolve();
                };
                img.src = url;
            });
        });
    }

    async function startPreload() {
        const bgEl = document.getElementById('preloader-bg');
        if (bgEl && bgEl.dataset && bgEl.dataset.bg) {
            bgEl.style.backgroundImage = `url('${bgEl.dataset.bg}')`;
        }

        const urls = collectImageUrls();
        let lastPercent = -1;

        await preloadUrls(urls, (loaded, total) => {
            const p = Math.round((loaded / total) * 100);
            if (p !== lastPercent) {
                lastPercent = p;
                percentEl.textContent = p + '%';
                barEl.style.width = p + '%';
            }
        });

        setTimeout(() => {
            preloader.classList.remove('preloader-visible');
            preloader.classList.add('preloader-hidden');
            document.dispatchEvent(new Event('pageImagesLoaded'));
            setTimeout(() => preloader.remove(), 700);
        }, 220);
    }

    startPreload().catch(() => {
        preloader.classList.add('preloader-hidden');
        document.dispatchEvent(new Event('pageImagesLoaded'));
    });
});
