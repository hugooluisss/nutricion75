$(document).ready(function(){
	$('.selectpicker').selectpicker({});
	
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
			txtCorreo: {
				required : true,
				email: true,
				remote: {
					url: "cclientes",
					type: "post",
					data: {
						action: "validaEmail",
						id: function(){
							return $("#id").val();
						}
					}
				}
			},
			txtPass: {
				required : true,
				minlength: 5
			},
		},
		wrapper: 'span', 
		messages: {
			txtCorreo: {
				remote: "Este correo ya se encuentra registrado"
			}
		},
		submitHandler: function(form){
			var obj = new TCliente;
			form = $(form)
			obj.add($("#id").val(), $("#txtNombre").val(), $("#selSexo").val(), $("#txtCorreo").val(), $("#txtPass").val(), {
				before: function(){
					form.find("[type=submit]").prop("disabled", true);
				},
				after: function(data){
					form.find("[type=submit]").prop("disabled", false);
					
					if (data.band == false){
						alert("No se pudo eliminar el registro");
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
		$.get("listaClientes", function(html){
			$("#dvLista").html(html);
			
			$("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idCliente);
				$("#txtNombre").val(el.nombre);
				$("#txtCorreo").val(el.email);
				$("#selSexo").val(el.sexo);
				$("#txtPass").val(el.pass);
				
				$('.nav a[href="#add"]').tab('show');
			});
			
			$("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TCliente;
					obj.del($(this).attr("identificador"), {
						after: function(data){
							if (data.band == false)
								alert("Ocurrió un error al eliminar al cliente");
							getLista();
						}
					});
				}
			});
			
			$("[action=suscripcion]").click(function(){
				getSuscripciones(jQuery.parseJSON($(this).attr("datos")));
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
	
	function getSuscripciones(cliente){
		$("#winSuscripcion").modal();
	}
});