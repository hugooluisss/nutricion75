TDepartamento = function(){
	var self = this;
	
	this.add = function(id, clave, condominio, inquilino, correo, referencia, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cdepartamentos', {
				"id": id,
				"clave": clave,
				"condominio": condominio,
				"inquilino": inquilino,
				"correo": correo,
				"referencia": referencia,
				"action": 'add'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cdepartamentos', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar el departamento");
			}
		}, "json");
	};
};