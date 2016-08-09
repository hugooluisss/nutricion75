$(document).ready(function(){
	getLista();
	
	$("#txtNombre" ).autocomplete({
		source: 'index.php?mod=cplantilla&action=getAlimentos',
		select: function(event, ui) {
			$("#id").val(ui.item.id);
			$("#txtCantidad").focus();
        }
    });
	
	$("#frmAdd").validate({
		debug: true,
		errorClass: "validateError",
		rules: {
			txtNombre: "required",
			txtCantidad: {
				required : true,
				number: true,
				min: 1,
			}
		},
		wrapper: 'span', 
		submitHandler: function(form){
			var obj = new TPlantilla;
			form = $(form);
			obj.add($("#id").val(), $("#txtCantidad").val(), {
				before: function(){
					form.find("[type=submit]").prop("disabled", true);
				},
				after: function(data){
					form.find("[type=submit]").prop("disabled", false);
					
					if (data.band == false){
						alert("No se pudo guardar el alimento");
					}else{
						$("#frmAdd").get(0).reset();
						getLista();
					}
				}
			});
		}
	});
	
	function getLista(){
		$.get("listaAlimentosPlantilla", function(html){
			$("#dvLista").html(html);
			
			$("#dvLista").find("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				var cantidad = prompt("¿Cual es la nueva cantidad?", el.cantidad);
				if (isNaN(cantidad) || cantidad == '')
					alert("Esto no es un número");
				else{
					var obj = new TPlantilla;
					obj.add(el.idAlimento, cantidad, {
						after: function(data){
							if (data.band == false){
								alert("No se pudo guardar la cantidad de alimento");
							}else{
								$("#frmAdd").get(0).reset();
								getLista();
							}
						}
					});
				}
					
			});
			
			$("#dvLista").find("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TPlantilla;
					obj.del($(this).attr("identificador"), {
						after: function(data){
							if (data.band == false)
								alert("Ocurrió un error al eliminar el alimento de la lista");
							getLista();
						}
					});
				}
			});
			
			$("#dvLista").find(".posicion").click(function(){
				var posicion = prompt("¿Cual es la nueva posición?", $(this).html());
				if (isNaN(posicion) || posicion == '')
					alert("Esto no es un número");
				else{
					var obj = new TPlantilla;
					obj.setPosicion($(this).attr("identificador"), posicion, {
						after: function(data){
							if (data.band == false){
								alert("No se pudo guardar la nueva posicion");
							}else{
								getLista();
							}
						}
					});
				}
			});
			
			$("#tblLista").DataTable({
				"responsive": true,
				"language": espaniol,
				"paging": false,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": true
			});
		});
	}
});