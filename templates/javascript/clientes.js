$(document).ready(function(){
	//$('.selectpicker').selectpicker({});
	
	getLista();
	
	$('.nav a[href="#add"]').click(function(){
		$("#frmAdd")[0].reset();
		$("#frmAdd #id").val("");
	});
	
	$("#winSuscripcion").find("#txtFecha").datepicker();
	$("#frmAdd").find("#txtNacimiento").datepicker();
	
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
			txtNacimiento: {
				required : true
			}
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
			obj.add($("#id").val(), $("#txtNombre").val(), $("#selSexo").val(), $("#txtCorreo").val(), $("#txtPass").val(), $("#txtNacimiento").val(), {
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
			
			$("#dvLista").find("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idCliente);
				$("#txtNombre").val(el.nombre);
				$("#txtCorreo").val(el.email);
				$("#selSexo").val(el.sexo);
				$("#txtPass").val(el.pass);
				$("#txtNacimiento").val(el.nacimiento);
				
				$('.nav a[href="#add"]').tab('show');
			});
			
			$("#dvLista").find("[action=eliminar]").click(function(){
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
				var el = jQuery.parseJSON($(this).attr("datos"));
				getSuscripciones(el.idCliente);
				$("#winSuscripcion").modal();
			});
			
			$("[action=getRegistros]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				getMomentos(el.idCliente);
				$("#winMomentos").modal();
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
	
	$("#winSuscripcion").find("#frmAdd").validate({
		debug: true,
		errorClass: "validateError",
		rules: {
			selPaquete: "required",
			txtFecha: "required"
		},
		wrapper: 'span',
		submitHandler: function(form){
			var cliente = new TCliente;
			cliente.addSuscripcion($("#winSuscripcion #id").val(), $("#winSuscripcion #selPaquete").val(), $("#winSuscripcion #txtFecha").val(), {
				before: function(){
					$(form).prop("disabled", true);
				}, after: function(resp){
					$(form).prop("disabled", false);
					
					if (resp.band)
						getSuscripciones($("#winSuscripcion #id").val());
					else
						alert("Ocurrió un error al agregar la suscripción");
				}
			});
		}
	});
	
	function getSuscripciones(cliente){
		$("#winSuscripcion").find("#id").val(cliente);
		
		$.post("listaSuscripciones", {"cliente": cliente}, function(html){
			$("#dvListaSuscripciones").html(html);
			
			$("#winSuscripcion").find("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TCliente;
					obj.delSuscripcion($(this).attr("identificador"), {
						after: function(data){
							if (data.band == false)
								alert("Ocurrió un error al eliminar la suscripción");
								
							getSuscripciones(cliente);
						}
					});
				}
			});
			
			$("#winSuscripcion").find("#tblLista").DataTable({
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
	
	function getMomentos(cliente){
		$("#winMomentos").find("#id").val(cliente);
		
		$.post("listaClienteMomentos", {"cliente": cliente}, function(html){
			$("#dvListaMomentos").html(html);
			
			$("#winMomentos").find("#tblLista").DataTable({
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