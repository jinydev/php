document.addEventListener('DOMContentLoaded', function () {
    const tocContainer = document.getElementById('TableOfContents');
    if (!tocContainer) return;

    const content = document.querySelector('.bd-content');
    if (!content) return;

    const headers = content.querySelectorAll('h2, h3');
    if (headers.length === 0) return;

    const tocList = document.createElement('ul');
    let lastLi = null;
    let subUl = null;

    headers.forEach((header, index) => {
        if (!header.id) header.id = 'toc-header-' + index;

        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#' + header.id;
        a.textContent = header.textContent;
        li.appendChild(a);

        if (header.tagName === 'H2') {
            tocList.appendChild(li);
            lastLi = li;
            subUl = null; // Reset sub-list
        } else if (header.tagName === 'H3') {
            if (!lastLi) {
                // Edge case: H3 before any H2
                tocList.appendChild(li);
                lastLi = li;
            } else {
                if (!subUl) {
                    subUl = document.createElement('ul');
                    lastLi.appendChild(subUl);
                }
                subUl.appendChild(li);
            }
        }
    });

    tocContainer.innerHTML = '';
    tocContainer.appendChild(tocList);
});
