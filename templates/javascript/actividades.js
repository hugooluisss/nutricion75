$(document).ready(function(){
	getLista();
	
	$('.nav a[href="#add"]').click(function(){
		$("#frmAdd")[0].reset();
		$("#frmAdd #id").val("");
	});
	
	$("#frmAdd").validate({
		debug: true,
		errorClass: "validateError",
		rules: {
			txtNombre: "required",
			setGrasas: {
				required : true
			},
			selProteinas: {
				required : true
			},
			selCarbohidratos: {
				required : true
			}
		},
		wrapper: 'span', 
		submitHandler: function(form){
			if (parseInt($("#selGrasas").val()) + parseInt($("#selProteinas").val()) + parseInt($("#selCarbohidratos").val()) == 100){
				var obj = new TActividad;
				form = $(form)
				obj.add($("#id").val(), $("#txtNombre").val(), $("#selGrasas").val(), $("#selProteinas").val(), $("#selCarbohidratos").val(), {
					before: function(){
						form.find("[type=submit]").prop("disabled", true);
					},
					after: function(data){
						form.find("[type=submit]").prop("disabled", false);
						
						if (data.band == false){
							alert("No se pudo guardar el registro");
						}else{
							$("#frmAdd").get(0).reset();
							$('.nav a[href="#listas"]').tab('show');
							getLista();
						}
					}
				});
			}else
				alert("La suma de grasas, proteinas y carbohidratos deben de dar un total de 100%");
		}
	});
	
	function getLista(){
		$.get("listaActividades", function(html){
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
				"paging": true,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": true
			});
		});
	}
});