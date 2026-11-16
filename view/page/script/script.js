const overlay = document.querySelector(".overlay");
const btnOverlay = document.getElementById("btn-tambah-obat");
const btnOverlayClose = document.getElementById("btn-close");

const inputWaktu = document.getElementById("input-waktu");
const tampilanWaktu = document.getElementById("tampilan-waktu");
const labelWaktu = document.getElementById("label-waktu");

btnOverlay.addEventListener("click", function(){
    overlay.classList.add("aktif");
})

btnOverlayClose.addEventListener("click", function(){
    overlay.classList.remove("aktif");
    labelWaktu.innerHTML= "";
    tampilanWaktu.innerHTML = "";
})

//bagian neriapin frekuensi
// function waktuFrekuensi(){
//     let input = Number(inputWaktu.value);
//     let output= "";
//     let son = "";
    
//     if(input < 5 && input > 0){
//         labelWaktu.innerHTML= "Waktu";
//         output = '<input  class="form-control flex-grow me-1" type="time" name="waktu" required>';

//             for(let i = 0; i < input; i++){
//                 son += output;
//             }
//             tampilanWaktu.innerHTML = son;
        
//     }else{
//         labelWaktu.innerHTML= "";
//         tampilanWaktu.innerHTML = "Frekuensi Maksimal kurang dari 5 dan lebih 0";
//     }

// }



function cekIsiVar(anjay){
    console.log("isinya variabel ini: ", anjay);
}