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

function closeModal(){
    document.querySelector('.modal').style.display = 'none';
}

function openModal(){
    document.querySelector('.modal').style.display = 'flex';
}
