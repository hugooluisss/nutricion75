<div class="box">
	<div class="box-body">
		<table id="tblLista" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Sexo</th>
					<th>Correo</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						<td>{$row.idCliente}</td>
						<td>{$row.nombre}</td>
						<td class="text-center">{if $row.sexo eq 'M'}<i class="fa fa-male" title="Hombre" style="color: blue"></i>{else}<i class="fa fa-female" title="Mujer" style="color: red"></i>{/if}</td>
						<td>{$row.email}</td>
						<td style="text-align: right">
							<button type="button" class="btn btn-default" action="getRegistros" title="Registros" datos='{$row.json}'><i class="fa fa-bar-chart"></i></button>
							<button type="button" class="btn btn-default" action="suscripcion" title="Suscripción" datos='{$row.json}'><i class="fa fa-key"></i></button>
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='{$row.json}'><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='{$row.idCliente}'><i class="fa fa-times"></i></button>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>