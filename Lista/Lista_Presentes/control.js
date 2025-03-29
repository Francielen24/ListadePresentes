function markAsBought(button, id) {
    let item = button.parentElement;
    let name = prompt("Digite seu nome para reservar este presente:");
   
    if (name) {
        item.classList.add("comprado");
        button.innerText = "Reservado por " + name;
        button.disabled = true;
       
        // Salvar no LocalStorage
        let savedGifts = JSON.parse(localStorage.getItem("gifts")) || {};
        savedGifts[id] = name;
        localStorage.setItem("gifts", JSON.stringify(savedGifts));
    }
}


function loadSavedGifts() {
    let savedGifts = JSON.parse(localStorage.getItem("gifts")) || {};
    document.querySelectorAll(".item").forEach(item => {
        let id = item.getAttribute("data-id");
        if (savedGifts[id]) {
            let button = item.querySelector("button");
            item.classList.add("comprado");
            button.innerText = "Reservado por " + savedGifts[id];
            button.disabled = true;
        }
    });
}


document.addEventListener("DOMContentLoaded", loadSavedGifts);