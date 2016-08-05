<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Plantilla de menú</h1>
	</div>
</div>
	
<div class="box">
	<div class="box-body">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="txtNombre" class="col-lg-2">Nombre</label>
				<div class="col-lg-5">
					<input class="form-control" id="txtNombre" name="txtNombre">
				</div>
				<label for="txtCantidad" class="col-lg-2">Cantidad</label>
				<div class="col-lg-2">
					<input class="form-control" id="txtCantidad" name="txtCantidad">
				</div>
				<div class="col-lg-1">
					<input type="submit" class="btn btn-success" value="+">
					<input type="hidden" id="id"
				</div>
			</div>
		</form>
	</div>
</div>

<div class="box">
	<div class="box-body" id="dvLista">
	</div>
</div>