TPlantilla = function(){
	var self = this;
	
	this.add = function(id, cantidad, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cplantilla', {
				"alimento": id,
				"cantidad": cantidad,
				"action": 'add'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cplantilla', {
			"alimento": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar el alimento de la lista");
			}
		}, "json");
	};
};