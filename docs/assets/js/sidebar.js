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

    // Remove trailing slash for comparison if needed
    // currentUrl = currentUrl.replace(/\/$/, ""); 

    var navLinks = document.querySelectorAll('.bd-links-nav a.bd-links-link');

    navLinks.forEach(function (link) {
        var linkUrl = link.getAttribute('href');

        if (!linkUrl) return;

        try {
            linkUrl = decodeURIComponent(linkUrl);
        } catch (e) { }

        // Logic:
        // 1. Exact match
        // 2. Current URL starts with link URL (parent directory case)
        // Note: Avoid matching root '/' or '#' loosely

        var isMatch = false;

        if (currentUrl === linkUrl) {
            isMatch = true;
        } else if (linkUrl !== '/' && linkUrl !== '#' && currentUrl.startsWith(linkUrl)) {
            isMatch = true;
        }

        if (isMatch) {
            // Mark the link itself as active
            link.classList.add('active');

            // Find parent collapse div
            var collapseDiv = link.closest('.collapse');
            if (collapseDiv) {
                // Expand the dropdown
                collapseDiv.classList.add('show');

                // Update the toggle button state
                var collapseId = collapseDiv.id;
                var toggler = document.querySelector('button[data-bs-target="#' + collapseId + '"]');
                if (toggler) {
                    toggler.classList.remove('collapsed');
                    toggler.setAttribute('aria-expanded', 'true');
                }

                // If there are nested dropdowns (grandparents), expand them too
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
