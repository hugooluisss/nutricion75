<div class="box">
	<div class="box-header">
		<h3>Configuración del sistema </h3>
	</div>
	<div class="box-body">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<!--<div class="form-group">
				<label for="txtCostoMantenimiento" class="col-lg-2">Costo suscripción</label>
				<div class="col-lg-3">
					<input class="form-control text-right" id="txtSuscripcion" name="txtSuscripcion" value="{$suscripcion}" clave="suscripcion" />
				</div>
			</div>-->
			<div class="form-group">
				<label for="txtTerminos" class="col-lg-3">Términos y condiciones</label>
				<div class="col-lg-9">
					<textarea id="txtTerminos" name="txtTerminos" class="form-control" rows="6" clave="terminos">{$terminos}</textarea>
				</div>
			</div>
		</form>
	</div>
</div>