// <header className="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
//     <a href="/" className="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
//         <svg className="bi me-2" width="40" height="32">
//             <use xlink:href="#bootstrap"></use>
//         </svg>
//         <span className="fs-4">Simple header</span>
//     </a>
//
//     <ul className="nav nav-pills">
//         <li className="nav-item"><a href="#" className="nav-link active" aria-current="page">Home</a></li>
//         <li className="nav-item"><a href="#" className="nav-link">Features</a></li>
//         <li className="nav-item"><a href="#" className="nav-link">Pricing</a></li>
//         <li className="nav-item"><a href="#" className="nav-link">FAQs</a></li>
//         <li className="nav-item"><a href="#" className="nav-link">About</a></li>
//     </ul>
// </header>

window.onload = function(){
    const ulFrag = document.createDocumentFragment();
    const headerFrag = document.createElement('header');
    headerFrag.classList.add('d-flex','flex-wrap','justify-content-center', 'py-3','mb-4','border-bottom');
    const logo = document.createElement('a');
    logo.classList.add('d-flex','align-items-center','mb-3','mb-md-0','me-md-auto','link-body-emphasis','text-decoration-none','headerLogo');
    if (window.location.href.indexOf("index") > -1){
        logo.href = `#`;
    } else {
        logo.href = `./index.php`;
    }
    const logoText = document.createElement('span');
    logoText.classList.add('fs-4');
    logo.appendChild(logoText);
    headerFrag.appendChild(logo);
    ulFrag.appendChild(headerFrag);
    document.body.insertBefore(ulFrag,document.body.firstChild);

};
window.onresize = updateHeader;
function updateHeader(){
    let windowWidth = window.innerWidth;
    if(windowWidth >= 900){
        console.log('change to big!');
    } else {
        console.log('change to small!');
    }
}