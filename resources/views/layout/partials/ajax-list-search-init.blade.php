@props([
    'indexUrl',
    'searchInputId' => 'searchInput',
    'filterSelectId' => null,
    'filterParam' => 'role',
])

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof initAjaxListSearch !== 'function') {
            return;
        }

        initAjaxListSearch({
            indexUrl: @json($indexUrl),
            searchInputId: @json($searchInputId),
            filterSelectId: @json($filterSelectId),
            filterParam: @json($filterParam),
        });
    });
</script>
