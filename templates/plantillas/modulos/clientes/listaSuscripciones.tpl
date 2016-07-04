
<table id="tblLista" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Inicio</th>
			<th>Fin</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td>{$row.nombre}</td>
				<td>{$row.inicio}</td>
				<td>{$row.fin}</td>
				<td style="text-align: right">
					<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='{$row.idCliente}'><i class="fa fa-times"></i></button>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>