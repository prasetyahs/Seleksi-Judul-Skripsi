function add_merk(base_url) {
	document.getElementById("modal_title").innerHTML = "Form Tambah Merk";
	document.getElementById("id_merk").value = "";
	document.getElementById("merk_name").value = "";
	document.getElementById("button").innerHTML = "Tambah Data";
	document.getElementById("form").action = base_url;
}
function update_merk(base_url, id, name, score) {
	document.getElementById("modal_title").innerHTML = "Form Ubah Merk";
	document.getElementById("id_merk").value = id;
	document.getElementById("merk_name").value = name;
	document.getElementById("score").value = score;
	document.getElementById("button").innerHTML = "Ubah Data";
	document.getElementById("form").action = base_url;
}
function delete_merk(base_url) {
	document.getElementById("buttondelete").href = base_url;
}
