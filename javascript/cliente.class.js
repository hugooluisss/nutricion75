TCliente = function(){
	var self = this;
	
	this.add = function(id, nombre, sexo, email, pass, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cclientes', {
				"id": id,
				"nombre": nombre,
				"sexo": sexo,
				"email": email,
				"pass": pass,
				"action": 'add'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cclientes', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar al cliente");
			}
		}, "json");
	};
};