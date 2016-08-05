<table id="tblLista" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Cantidad <small>x100g</small></th>
			<th>Grasa</th>
			<th>Proteinas</th>
			<th>Carbohidratos</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td>{$row.nombre}</td>
				<td class="text-right"><b>{$row.cantidad}</b> <small>{$row.cantidad*100}g</small></td>
				<td class="text-right">{$row.grasas} %</td>
				<td class="text-right">{$row.proteinas} %</td>
				<td class="text-right">{$row.carbohidratos} %</td>
				<td style="text-align: right">
					<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='{$row.json}'><i class="fa fa-pencil"></i></button>
					<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='{$row.idAlimento}'><i class="fa fa-times"></i></button>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>