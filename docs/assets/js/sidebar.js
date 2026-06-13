// sidebar.js
// Automatically expand sidebar dropdowns based on current URL

document.addEventListener("DOMContentLoaded", function () {
    var currentUrl = window.location.pathname;

    // Normalize path: decode URI components to handle Korean characters
    try {
        currentUrl = decodeURIComponent(currentUrl);
    } catch (e) {
        console.error("Error decoding URL:", e);
    }

    var navLinks = document.querySelectorAll('.bd-links-nav a.bd-links-link');

    navLinks.forEach(function (link) {
        var linkUrl = link.getAttribute('href');

        if (!linkUrl) return;

        try {
            linkUrl = decodeURIComponent(linkUrl);
        } catch (e) { }

        var isMatch = false;

        if (currentUrl === linkUrl) {
            isMatch = true;
        } else if (linkUrl !== '/' && linkUrl !== '#' && currentUrl.startsWith(linkUrl)) {
            isMatch = true;
        }

        if (isMatch) {
            link.classList.add('active');

            var collapseDiv = link.closest('.collapse');
            if (collapseDiv) {
                collapseDiv.classList.add('show');

                var collapseId = collapseDiv.id;
                var toggler = document.querySelector('button[data-bs-target="#' + collapseId + '"]');
                if (toggler) {
                    toggler.classList.remove('collapsed');
                    toggler.setAttribute('aria-expanded', 'true');
                }

                var parentCollapse = collapseDiv.parentElement.closest('.collapse');
                if (parentCollapse) {
                    parentCollapse.classList.add('show');
                    var parentToggler = document.querySelector('button[data-bs-target="#' + parentCollapse.id + '"]');
                    if (parentToggler) {
                        parentToggler.classList.remove('collapsed');
                        parentToggler.setAttribute('aria-expanded', 'true');
                    }
                }
            }
        }
    });
});
