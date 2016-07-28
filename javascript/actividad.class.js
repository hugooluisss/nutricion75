TActividad = function(){
	var self = this;
	
	this.add = function(id, nombre, tipo, grasas, proteinas, carbohidratos, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cactividades', {
				"id": id,
				"nombre": nombre,
				"tipo": tipo,
				"grasas": grasas,
				"proteinas": proteinas,
				"carbohidratos": carbohidratos,
				"action": 'add'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cactividades', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar el actividad");
			}
		}, "json");
	};
};