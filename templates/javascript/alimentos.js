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
			txtProteinas: {
				required : true,
				number: true
			},
			txtCarbohidratos: {
				required : true,
				number: true
			},
			txtGrasas: {
				required : true,
				number: true
			},
			txtFibra: {
				required : true,
				number: true
			}
		},
		wrapper: 'span', 
		submitHandler: function(form){
			var obj = new TAlimento;
			form = $(form)
			obj.add($("#id").val(), $("#txtNombre").val(), $("#txtCarbohidratos").val(), $("#txtProteinas").val(), $("#txtGrasas").val(), $("#txtFibra").val(), {
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
		$.get("listaAlimentos", function(html){
			$("#dvLista").html(html);
			
			$("#dvLista").find("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idCliente);
				$("#txtNombre").val(el.nombre);
				$("#txtCarbohidratos").val(el.carbohidratos);
				$("#txtProteinas").val(el.proteinas);
				$("#txtGrasas").val(el.grasas);
				$("#txtFibra").val(el.fibra);
				
				$('.nav a[href="#add"]').tab('show');
			});
			
			$("#dvLista").find("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TAlimento;
					obj.del($(this).attr("identificador"), {
						after: function(data){
							if (data.band == false)
								alert("Ocurrió un error al eliminar el alimento");
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