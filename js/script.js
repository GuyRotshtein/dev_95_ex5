function getCategories(data){
    const ulFrag = document.createDocumentFragment();
    const defaultSel = document.createElement('option');
    defaultSel.value = '0';
    sHtml = `All books`;
    defaultSel.innerHTML = sHtml;
    ulFrag.appendChild(defaultSel);
    for (const key in data.categories){
        const sel = document.createElement('option');
        sel.value = `${data.categories[key].id}`;
        sHtml = `${data.categories[key].name}`;
        sel.innerHTML = sHtml;
        ulFrag.appendChild(sel);
    }
    document.getElementById('catSelect').appendChild(ulFrag);
    document.getElementById('catSelect').addEventListener("change",(newVal) => {
        const newValue = newVal.target.value;
        const allBooks = document.getElementsByTagName("li");

        for(let i = 0, len = allBooks.length;i<len;i++){
            if(allBooks[i].classList.contains(newValue) || newValue == 0){
                allBooks[i].style.display = 'block';
            } else {
                allBooks[i].style.display = 'none';
            }
        }
    });
}

fetch("js/data/categories.json")
    .then(response => response.json())
    .then(data => getCategories(data));