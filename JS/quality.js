// Navigation  Bar Block
{
    const collapsedClass = "nav--collapsed";
    const lsKey = "navCollapsed";

    const nav = document.querySelector(".nav");
    const navBorder = document.getElementById('menu');

    //to save it's state
    if(localStorage.getItem(lsKey) === "true"){
        nav.classList.add(collapsedClass);
    }

    navBorder.addEventListener("click", ()=>{
        nav.classList.toggle(collapsedClass);
        localStorage.setItem(lsKey, nav.classList.contains(collapsedClass));
    });
}

// Switching between navigations tabs, showing which tab is selected
// {
//     const tabs = document.querySelectorAll('[data-tab-target]')
//     const tabContents = document.querySelectorAll('[data-tab-content]')

//     tabs.forEach(tab => {
//         tab.addEventListener('click', () => {
//             const target = document.querySelector(tab.dataset.tabTarget)
//             tabContents.forEach(tabContent => {
//                 tabContent.classList.remove('active')
//             })
//             tabs.forEach(tab => {
//                 tab.classList.remove('active')
//             })
//             tab.classList.add('active')
//             target.classList.add('active')
//         })
//     })
// }