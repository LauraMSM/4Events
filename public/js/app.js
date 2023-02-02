const $ = sel => document.querySelector(sel);
const $$ = sel => document.querySelectorAll(sel);



const menu = () => {
    const menuBtn = $(".btn-menu");

    menuBtn.addEventListener("click", () => {
        $(".menu").style.display = $(".menu").style.display === "none" ? "flex" : "none";
    });
};

menu();
console.log("SCRIPTS CARGADOS");
