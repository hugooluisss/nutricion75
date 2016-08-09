<?php /* Smarty version Smarty-3.1.11, created on 2016-08-08 23:25:43
         compiled from "templates/plantillas/modulos/menuPlantilla/lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192812867357a419a92109b1-41922748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0eeafb3e58b34f091ab3f28de472eeb653b4c1d7' => 
    array (
      0 => 'templates/plantillas/modulos/menuPlantilla/lista.tpl',
      1 => 1470716737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192812867357a419a92109b1-41922748',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57a419a93a7e31_78521759',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
    'gramos' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a419a93a7e31_78521759')) {function content_57a419a93a7e31_78521759($_smarty_tpl) {?><table id="tblLista" class="table table-bordered table-hover">
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
		<?php $_smarty_tpl->tpl_vars["gramos"] = new Smarty_variable(0, null, 0);?>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td identificador="<?php echo $_smarty_tpl->tpl_vars['row']->value['idAlimento'];?>
" class="posicion text-right" title="Click o Tap para modificar"><?php echo $_smarty_tpl->tpl_vars['row']->value['posicion'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['grasas'];?>
 %</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['proteinas'];?>
 %</td>
				<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['carbohidratos'];?>
 %</td>
				<td class="text-right"><small><?php echo $_smarty_tpl->tpl_vars['row']->value['cantidad']*100;?>
g</small></td>
				<td style="text-align: right">
					<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-pencil"></i></button>
					<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='<?php echo $_smarty_tpl->tpl_vars['row']->value['idAlimento'];?>
'><i class="fa fa-times"></i></button>
				</td>
				
				<?php $_smarty_tpl->tpl_vars["gramos"] = new Smarty_variable($_smarty_tpl->tpl_vars['gramos']->value+$_smarty_tpl->tpl_vars['row']->value['cantidad']*100, null, 0);?>
			</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4" style="text-align:right">Total:</th>
			<th class="text-right"><?php echo $_smarty_tpl->tpl_vars['gramos']->value;?>
 g</th>
			<th></th>
		</tr>
	</tfoot>
</table><?php }} ?>