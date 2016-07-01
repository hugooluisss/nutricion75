$(document).ready(function(){
	$("input[clave]").change(function(){
		var el = $(this);
		el.prop("disabled", true);
		
		$.post("cconfiguracion", {
			"clave": el.attr("clave"),
			"valor": el.val(),
			"action": "update"
		}, function(resp){
			el.prop("disabled", false);
			
			if (!resp.band)
				alert("Upss... este valor no pudo ser actualizado");
		}, "json");
	});
});