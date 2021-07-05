function add_type(base_url){
    document.getElementById("modal_title").innerHTML = "Form Tambah Type";
	document.getElementById("id_type").value = "";
	document.getElementById("type_name").value = "";
	document.getElementById("button").innerHTML = "Tambah Data";
	document.getElementById("form").action = base_url;
}
function update_type(base_url, id, name, score) {
	document.getElementById("modal_title").innerHTML = "Form Ubah Type";
	document.getElementById("id_type").value = id;
	document.getElementById("type_name").value = name;
	document.getElementById("score").value = score;
	document.getElementById("button").innerHTML = "Ubah Data";
	document.getElementById("form").action = base_url;
}