TEstado = function(){
	var self = this;
	
	this.update = function(id,	color, termino, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cestados', {
				"id": id,
				"color": color,
				"termino": termino,
				"action": 'update'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
};