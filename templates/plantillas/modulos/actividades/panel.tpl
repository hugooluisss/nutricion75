<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Actividades</h1>
	</div>
</div>

<ul id="panelTabs" class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#listas">Lista</a></li>
  <li><a data-toggle="tab" href="#add">Agregar / Modificar</a></li>
</ul>

<div class="tab-content">
	<div id="listas" class="tab-pane fade in active">
		<div id="dvLista">
			
		</div>
	</div>
	
	<div id="add" class="tab-pane fade">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="box">
				<div class="box-body">
					<div class="form-group">
						<label for="txtNombre" class="col-lg-2">Nombre</label>
						<div class="col-lg-8">
							<input class="form-control" id="txtNombre" name="txtNombre">
						</div>
					</div>
					<div class="form-group">
						<label for="selGrasas" class="col-lg-2">Grasas</label>
						<div class="col-lg-3">
							<select id="selGrasas" name="selGrasas" class="form-control">
								<option value="">Selecciona un porcentaje</option>
								{for $i=10 to 100 step 5}
									<option value="{$i}">{$i} %</option>
								{/for}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="selProteinas" class="col-lg-2">Proteinas</label>
						<div class="col-lg-3">
							<select id="selProteinas" name="selProteinas" class="form-control">
								<option value="">Selecciona un porcentaje</option>
								{for $i=10 to 100 step 5}
									<option value="{$i}">{$i} %</option>
								{/for}
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="selCarbohidratos" class="col-lg-2">Carbohidratos</label>
						<div class="col-lg-3">
							<select id="selCarbohidratos" name="selCarbohidratos" class="form-control">
								<option value="">Selecciona un porcentaje</option>
								{for $i=10 to 100 step 5}
									<option value="{$i}">{$i} %</option>
								{/for}
							</select>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" id="btnReset" class="btn btn-default">Cancelar</button>
					<button type="submit" class="btn btn-info pull-right">Guardar</button>
					<input type="hidden" id="id"/>
				</div>
			</div>
		</form>
	</div>
</div>