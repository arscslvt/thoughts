document.getElementById("sharebt").addEventListener("click", () => {
    if(document.getElementById("share").style.display == "grid"){
        document.getElementById("share").style.display = "none";
        document.getElementById("sharebt").innerText = "Share with friends ⌲"
    }else{
        document.getElementById("share").style.display = "grid";
        document.getElementById("sharebt").innerText = "Hide ↑"
    }
})