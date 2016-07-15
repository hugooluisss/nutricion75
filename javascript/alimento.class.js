TAlimento = function(){
	var self = this;
	
	this.add = function(id, nombre, carbohidratos, proteinas, grasas, fibra, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('calimentos', {
				"id": id,
				"nombre": nombre,
				"carbohidratos": carbohidratos,
				"proteinas": proteinas,
				"grasas": grasas,
				"fibra": fibra,
				"action": 'add'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('calimentos', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar el alimento");
			}
		}, "json");
	};
};