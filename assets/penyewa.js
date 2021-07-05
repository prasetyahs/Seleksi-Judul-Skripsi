function data_penyewa(base_url,nik,nama,email,address,phone){
    document.getElementById('nik').innerHTML = nik;
    document.getElementById('nama').innerHTML = nama;
    document.getElementById('email').innerHTML = email;
    document.getElementById('alamat').innerHTML = address;
    document.getElementById('hp').innerHTML = phone;

}
function update_penyewaan(base_url){
    document.getElementById("modal_titel").innerHTML = "Form Konfirmasi Penyewaan" ;
    document.getElementById("button").href = base_url ;
}
function cancel_penyewa(base_url){
    document.getElementById('buttondelete').href = base_url
}