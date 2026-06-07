<script>
(function () {
    var root = document.documentElement;
    var btn = document.getElementById('theme-toggle');

    function applyTheme(theme) {
        if (theme === 'dark') {
            root.setAttribute('data-theme', 'dark');
        } else {
            root.removeAttribute('data-theme');
            theme = 'light';
        }
        localStorage.setItem('kiu-theme', theme);
    }

    if (btn) {
        btn.addEventListener('click', function () {
            var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
        });
    }
})();
</script>
