/**
 * AJAX search & pagination tanpa reload halaman.
 * Membutuhkan #ajax-list-tbody dan #ajax-list-footer di halaman.
 */
window.initAjaxListSearch = function (config) {
    const indexUrl = config.indexUrl;
    const searchInput = document.getElementById(config.searchInputId || 'searchInput');
    const filterSelect = config.filterSelectId
        ? document.getElementById(config.filterSelectId)
        : null;
    const filterParam = config.filterParam || 'role';
    const tbody = document.getElementById('ajax-list-tbody');
    const footer = document.getElementById('ajax-list-footer');

    if (!tbody || !footer) {
        return;
    }

    let searchTimeout;

    function buildUrl(pageUrl) {
        if (pageUrl) {
            return new URL(pageUrl, window.location.origin);
        }

        const url = new URL(indexUrl, window.location.origin);

        if (searchInput && searchInput.value.trim()) {
            url.searchParams.set('search', searchInput.value.trim());
        }

        if (filterSelect && filterSelect.value) {
            url.searchParams.set(filterParam, filterSelect.value);
        }

        return url;
    }

    async function fetchList(url) {
        tbody.style.opacity = '0.5';

        try {
            const response = await fetch(url.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });

            if (!response.ok) {
                throw new Error('Gagal memuat data');
            }

            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newTbody = doc.getElementById('ajax-list-tbody');
            const newFooter = doc.getElementById('ajax-list-footer');

            if (newTbody) {
                tbody.innerHTML = newTbody.innerHTML;
            }

            if (newFooter) {
                footer.innerHTML = newFooter.innerHTML;
            }

            window.history.pushState({}, '', url.toString());

            if (typeof initFlowbite === 'function') {
                initFlowbite();
            }

            if (typeof AOS !== 'undefined') {
                AOS.refreshHard();
            }
        } catch (error) {
            console.error('Ajax search error:', error);
        } finally {
            tbody.style.opacity = '1';
        }
    }

    function triggerSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => fetchList(buildUrl()), 300);
    }

    if (searchInput) {
        searchInput.addEventListener('input', triggerSearch);
    }

    if (filterSelect) {
        filterSelect.addEventListener('change', () => fetchList(buildUrl()));
    }

    document.addEventListener('click', function (e) {
        const link = e.target.closest('#ajax-list-footer a[href]');
        if (!link || link.classList.contains('pointer-events-none')) {
            return;
        }

        const href = link.getAttribute('href');
        if (!href || href === '#') {
            return;
        }

        e.preventDefault();
        fetchList(buildUrl(href));
    });

    window.addEventListener('popstate', function () {
        fetchList(new URL(window.location.href));
    });
};
