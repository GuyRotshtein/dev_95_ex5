function getCategories(data){
    const ulFrag = document.createDocumentFragment();
    const defaultSel = document.createElement('option');
    defaultSel.value = '0';
    let sHtml = `All books`;
    defaultSel.innerHTML = sHtml;
    ulFrag.appendChild(defaultSel);
    for (const key in data.categories){
        const sel = document.createElement('option');
        sel.value = `${data.categories[key].id}`;
        sHtml = `${data.categories[key].name}`;
        sel.innerHTML = sHtml;
        ulFrag.appendChild(sel);
    }
    const categoryWindow = document.getElementById('catSelect');
    if (categoryWindow !== null){
        categoryWindow.appendChild(ulFrag);
        categoryWindow.addEventListener("change",(newVal) => {
            const newValue = newVal.target.value;
            const categoryName = categoryWindow.options[newValue].text;
            const allBooks = document.getElementsByTagName("li");
            let booksInCat = 0;
            for(let i = 0, len = allBooks.length;i<len;i++){
                if(allBooks[i].classList.contains(newValue) || newValue == 0){
                    booksInCat ++;
                    allBooks[i].style.display = 'block';
                } else {
                    allBooks[i].style.display = 'none';
                }
            }
            if (booksInCat == 0 && newValue != 0){
                const emptyMessage = document.createElement('div');
                emptyMessage.classList.add('emptyListMessage', 'pt-5');
                sHtml ='<br><h5>it seems there are no books in the '+categoryName+' category...<br>Maybe try switching to another one and try again?</h5>';
                emptyMessage.innerHTML = sHtml;
                document.getElementsByTagName('ul')[0].appendChild(emptyMessage);
            } else {
                const existingErrorMessages = document.getElementsByClassName('emptyListMessage');
                if (existingErrorMessages.length !== 0){
                    for (let j = 0, len = existingErrorMessages.length;j<len;j++){
                        existingErrorMessages[j].remove();
                    }
                }
            }
        });
        if (window.innerWidth >= 1200){
            if (window.location.href.indexOf("book") > -1) {
                document.getElementById('bookCovers').classList.add('flex-column');
            }
        }
        if (window.innerWidth < 1200){
            if (window.location.href.indexOf("book") > -1) {
                document.getElementById('bookCovers').classList.add('flex-column');
            }
        }
        if(window.innerWidth >= 900){
            if (window.location.href.indexOf("index") > -1){
                document.getElementsByTagName('ul')[0].classList.add('list-group-horizontal');
                document.getElementsByTagName('ul')[0].classList.remove('list-group-flush');
            }
        } else {
            if (window.location.href.indexOf("index") > -1){
                document.getElementsByTagName('ul')[0].classList.remove('list-group-horizontal');
                document.getElementsByTagName('ul')[0].classList.add('list-group-flush');
            }
        }
    }
}

fetch("js/data/categories.json")
    .then(response => response.json())
    .then(data => getCategories(data));