$(document).ready(function(){
	getLista();
	
	$("#txtNombre" ).autocomplete({
		source: 'index.php?mod=cplantilla&action=getAlimentos',
		select: function(event, ui) {
			$("#id").val(ui.item.id);
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
				
				$("#id").val(el.idActividad);
				$("#txtNombre").val(el.nombre);
				$("#selGrasas").val(el.grasas);
				$("#selProteinas").val(el.proteinas);
				$("#selCarbohidratos").val(el.carbohidratos);
				
				$('.nav a[href="#add"]').tab('show');
			});
			
			$("#dvLista").find("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TActividad;
					obj.del($(this).attr("identificador"), {
						after: function(data){
							if (data.band == false)
								alert("Ocurrió un error al eliminar la actividad");
							getLista();
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