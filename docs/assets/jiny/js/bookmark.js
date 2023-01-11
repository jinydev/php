/* 컴포넌트 생성*/
class BookMark extends HTMLElement {
    connectedCallback() {
        this.setAttribute("id", this.innerHTML);
        //alert(this.id);

        let bookmark = document.getElementById('book-mark');
        let item = document.createElement('li');
        let link = document.createElement('a');
        link.setAttribute("href", "#"+this.innerHTML);
        link.innerHTML = this.innerHTML;

        link.addEventListener('click',function(e){
            let list = e.target.parentElement.parentElement;
            let mark = list.querySelectorAll('a');
            mark.forEach(el => {
                el.classList.remove("active");
            });

            e.target.classList.add("active");
        });

        //console.log(bookmark);
        this.innerHTML = null;

        item.appendChild(link);
        bookmark.appendChild(item);
    }
}

customElements.define('jiny-book-mark', BookMark);