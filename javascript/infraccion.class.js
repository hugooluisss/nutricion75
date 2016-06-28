TInfraccion = function(){
	var self = this;
	
	this.registra = function(id, departamento, area, fecha, hora, servidor, camara, descripcion, inciso, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cinfracciones', {
				"id": id,
				"departamento": departamento,
				"area": area,
				"fecha": fecha,
				"hora": hora,
				"servidor": servidor,
				"camara": camara,
				"descripcion": descripcion,
				"inciso": inciso,
				"action": 'registrar'
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				console.log("Error al eliminar la infracción");
			}
		}, "json");
	};
	
	this.delImagen = function(nombre, infraccion, fn){
		if (fn.before != undefined)
			fn.before();
				
		$.post('?mod=cinfracciones&action=delImagen&infraccion=' + infraccion, {
			"nombre": nombre
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == false){
				console.log("Ocurrió un error al eliminar el objeto");
			}
		}, "json");
	};
	
	this.setAutorizar = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "autorizar"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Error al autorizar la infracción");
			}
		}, "json");
	};
	
	this.setAutorizada = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "autorizar"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Error al autorizar la infracción");
			}
		}, "json");
	};
	
	this.setRechazada = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "rechazar"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Error al rechazar la infracción");
			}
		}, "json");
	};
	
	this.setPagada = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "pagar"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Error al establecer como pagada la infracción");
			}
		}, "json");
	};
	
	this.setRegistrada = function(id, fn){
		$.post('cinfracciones', {
			"id": id,
			"action": "registrada"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Error al establecer como registrada la infracción");
			}
		}, "json");
	};

	
	this.getCarta = function(id, fn){
		if (fn.before != undefined) fn.before();
		
		$.post("cinfracciones", {
			"action": "generarCarta",
			"id": id
		}, function(resp){
			if (fn.after != undefined) fn.after(resp);
			
			if (!resp.band)
				console.log("Ocurrió un error al generar el documento");
				
		}, "json");
	}
	
	this.sendMail = function(id, fn){
		if (fn.before != undefined) fn.before();
		
		this.getCarta(id, {
			after: function(resp){
				if (resp.band){
					$.post("cinfracciones", {
						"action": "sendMail",
						"pdf": resp.doc,
						"id": id
					}, function(resp){
						if (fn.after != undefined) fn.after(resp);
						
						if (!resp.band)
							console.log("Ocurrió un error al enviar el documento");
					}, "json");
				}else
					console.log("El documento no se generó");
			}
		});
	}
};