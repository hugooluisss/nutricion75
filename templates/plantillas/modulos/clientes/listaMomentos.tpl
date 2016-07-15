
<table id="tblLista" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Altura</th>
			<th>Peso</th>
			<th>IMC</th>
			<th>% GCE</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$lista item="row"}
			<tr>
				<td>{$row.fecha}</td>
				<td>{$row.altura}</td>
				<td>{$row.peso}</td>
				<td>{$row.imc}</td>
				<td>{$row.pgce}</td>
			</tr>
		{/foreach}
	</tbody>
</table>