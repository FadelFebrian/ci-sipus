function  edit(id) {
	$("#table_list button").attr('disabled',true);
	$("#tr_"+id+" button").attr('disabled',false);
	
	var code = $("#tr_"+id+" td:eq(1)").attr('id');
	$("#tr_"+id+" td:eq(1) span").addClass('hidden');
	$("#tr_"+id+" td:eq(1) input").attr('disabled',false).removeClass('hidden');
	
	var nama = $("#tr_"+id+" td:eq(2)").attr('id');
	$("#tr_"+id+" td:eq(2) span").addClass('hidden');
	$("#tr_"+id+" td:eq(2) input").attr('disabled',false).removeClass('hidden');
	
	var jabatan = $("#tr_"+id+" td:eq(3)").attr('id');
	$("#tr_"+id+" td:eq(3) span").addClass('hidden');
	$("#tr_"+id+" td:eq(3) input").attr('disabled',false).removeClass('hidden');

	$("#tr_"+id+" button:eq(0)").addClass('hidden');
	$("#tr_"+id+" button:eq(1)").removeClass('hidden');
	$("#tr_"+id+" button:eq(2)").removeClass('hidden');
	$("#tr_"+id+" button:eq(3)").addClass('hidden');
}

function  batal(id) {
	$("#table_list button").attr('disabled',false);
	$("#tr_"+id+" button").attr('disabled',true);
	
	var code = $("#tr_"+id+" td:eq(1)").attr('id');
	$("#tr_"+id+" td:eq(1) span").removeClass('hidden');
	$("#tr_"+id+" td:eq(1) input").attr('disabled',true).addClass('hidden');
	
	var nama = $("#tr_"+id+" td:eq(2)").attr('id');
	$("#tr_"+id+" td:eq(2) span").removeClass('hidden');
	$("#tr_"+id+" td:eq(2) input").attr('disabled',true).addClass('hidden');
	
	var jabatan = $("#tr_"+id+" td:eq(3)").attr('id');
	$("#tr_"+id+" td:eq(3) span").removeClass('hidden');
	$("#tr_"+id+" td:eq(3) input").attr('disabled',true).addClass('hidden');

	$("#tr_"+id+" button:eq(0)").removeClass('hidden').attr('disabled',false);
	$("#tr_"+id+" button:eq(1)").addClass('hidden');
	$("#tr_"+id+" button:eq(2)").addClass('hidden');
	$("#tr_"+id+" button:eq(3)").removeClass('hidden').attr('disabled',false);
}