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
			selTipo: {
				required : true
			}
		},
		wrapper: 'span', 
		submitHandler: function(form){
			var obj = new TActividad;
			form = $(form)
			obj.add($("#id").val(), $("#txtNombre").val(), $("#selTipo").val(), {
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
		}
	});
	
	function getLista(){
		$.get("listaActividades", function(html){
			$("#dvLista").html(html);
			
			$("#dvLista").find("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idActividad);
				$("#txtNombre").val(el.nombre);
				$("#selTipo").val(el.idTipo);
				
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