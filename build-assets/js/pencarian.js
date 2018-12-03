$(document).ready(function() { ViewFormS(mode); });

$("#s-sederhana").on('click', function() {
	ViewFormS(0);
});

$("#s-spesifik").on('click', function() {
	ViewFormS(1);
});

$("#s-bantuan").on('click', function() {
	ViewFormS(2);
});

function  ViewFormS(id) {
	$("#SKoleksiForm").empty();
	var form = document.getElementById('SKoleksiForm');
		var input = document.createElement('input');
		input.setAttribute('type','hidden');
		input.setAttribute('class','input-xxlarge');
		input.setAttribute('name','koleksi_tipe');
		input.setAttribute('id','koleksi_tipe');
		input.setAttribute('value',tipe);
	form.appendChild(input);

	if (id == 1) {
		var label = document.createElement('label');
			var txt = document.createTextNode('Judul');
			label.appendChild(txt);
		form.appendChild(label);
		
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('class','input-xxlarge');
		input.setAttribute('name','koleksi_judul');
		input.setAttribute('id','koleksi_judul');
		
		if (typeof per_input['koleksi_judul'] !== 'undefined')
		input.setAttribute('value',per_input['koleksi_judul']);

		form.appendChild(input);

		var label = document.createElement('label');
			var txt = document.createTextNode('Penulis');
			label.appendChild(txt);
		form.appendChild(label);
		
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('class','input-xxlarge');
		input.setAttribute('name','koleksi_penulis');
		input.setAttribute('id','koleksi_penulis');
		
		if (typeof per_input['koleksi_penulis'] !== 'undefined')
		input.setAttribute('value',per_input['koleksi_penulis']);

		form.appendChild(input);
		    
		var label = document.createElement('label');
			var txt = document.createTextNode('Penerbit');
			label.appendChild(txt);
		form.appendChild(label);
		
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('class','input-xxlarge');
		input.setAttribute('name','koleksi_penerbit');
		input.setAttribute('id','koleksi_penerbit');
		
		if (typeof per_input['koleksi_penerbit'] !== 'undefined')
		input.setAttribute('value',per_input['koleksi_penerbit']);

		form.appendChild(input);

		var label = document.createElement('label');
			var txt = document.createTextNode('Abstrak / Sinopsis');
			label.appendChild(txt);
		form.appendChild(label);
		
		var textarea = document.createElement('textarea');
		textarea.setAttribute('row',4);
		textarea.setAttribute('class','input-xxlarge');
		textarea.setAttribute('id','koleksi_sinopsis');
		textarea.setAttribute('name','koleksi_sinopsis');
		
		if (typeof per_input['koleksi_sinopsis'] !== 'undefined') {
			var txt = document.createTextNode(per_input['koleksi_sinopsis']);
			textarea.appendChild(txt);
		}

		form.appendChild(textarea);
	} else { 
		if (id == 2) {
    	var p = document.createElement('p');
			var txt = document.createTextNode('bagai mana cara melakukan pencarian ? ');
			p.appendChild(txt);
		form.appendChild(p);
		} else {
		var input = document.createElement('input');
		input.setAttribute('type','text');
		input.setAttribute('class','input-xxlarge');
		input.setAttribute('name','koleksi_judul');
		input.setAttribute('id','koleksi_judul');
		input.setAttribute('placeholder','Cari Judul');
		
		if (typeof per_input['koleksi_judul'] !== 'undefined')
		input.setAttribute('value',per_input['koleksi_judul']);

		
		form.appendChild(input);
		}
    }

    if (id == 1 || id == 0) {
    	var p = document.createElement('p');
		    var button = document.createElement('button');
			button.setAttribute('class','btn');
			button.setAttribute('type','submit');
			button.setAttribute('name','mode');
			button.setAttribute('value',mode);
				var txt = document.createTextNode('Cari');
				button.appendChild(txt);
			p.appendChild(button);
			var txt = document.createTextNode(' ');
			p.appendChild(txt);
		    var button = document.createElement('button');
			button.setAttribute('class','btn');
			button.setAttribute('type','reset');
				var txt = document.createTextNode('Bersihkan');
				button.appendChild(txt);
			p.appendChild(button);
		form.appendChild(p);
	}
}