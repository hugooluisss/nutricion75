<div class="box">
	<div class="box-body">
		<table id="tblLista" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Carbohidratos</th>
					<th>Grasas</th>
					<th>Proteinas</th>
					<th>Fibra</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$lista item="row"}
					<tr>
						<td>{$row.idAlimento}</td>
						<td>{$row.nombre}</td>
						<td>{$row.carbohidratos}</td>
						<td>{$row.grasas}</td>
						<td>{$row.proteinas}</td>
						<td>{$row.fibra}</td>
						<td style="text-align: right">
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='{$row.json}'><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='{$row.idAlimento}'><i class="fa fa-times"></i></button>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>