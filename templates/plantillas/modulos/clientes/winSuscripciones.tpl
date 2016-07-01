<div class="modal fade" id="winSuscripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Suscripciones</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
					<div class="form-group">
						<label for="txtFecha" class="col-sm-2 control-label">Fecha *</label>
						<div class="col-sm-2">
							<input type="text" id="txtFecha" name="txtFecha" autofocus="true" class="form-control" autocomplete="false" value="{$smarty.now|date_format:"Y-m-d"}" placeholder="Y-m-d"/>
							<div id="datepicker"></div>
						</div>
						<label for="txtNombre" class="col-sm-2 control-label">Paquete *</label>
						<div class="col-sm-5">
							<select id="selPaquete" name="selPaquete" class="form-control">
								{foreach from=$paquetes item="row"}
								<option value="{$row.idPaquete}">{$row.nombre}</option>
								{/foreach}
							</select>
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-info pull-right">+</button>
						</div>
					</div>
					<input type="hidden" id="id"/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>