<table id="tblLista" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Orden</th>
			<th>Nombre</th>
			<th>Grasa</th>
			<th>Proteinas</th>
			<th>Carbohidratos</th>
			<th>Cantidad <small>x100g</small></th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{assign var="gramos" value=0}
		{foreach from=$lista item="row"}
			<tr>
				<td identificador="{$row.idAlimento}" class="posicion text-right" title="Click o Tap para modificar">{$row.posicion}</td>
				<td>{$row.nombre}</td>
				<td class="text-right">{$row.grasas} %</td>
				<td class="text-right">{$row.proteinas} %</td>
				<td class="text-right">{$row.carbohidratos} %</td>
				<td class="text-right"><small>{$row.cantidad*100}g</small></td>
				<td style="text-align: right">
					<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='{$row.json}'><i class="fa fa-pencil"></i></button>
					<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='{$row.idAlimento}'><i class="fa fa-times"></i></button>
				</td>
				
				{assign var="gramos" value=$gramos+$row.cantidad*100}
			</tr>
		{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" style="text-align:right">Total:</th>
			<th class="text-right">{$gramos} g</th>
			<th></th>
		</tr>
	</tfoot>
</table>