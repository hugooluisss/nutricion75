<?php /* Smarty version Smarty-3.1.11, created on 2016-07-20 17:18:20
         compiled from "templates/plantillas/modulos/clientes/listaMomentos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162702704257848e380a1288-64279405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8416a7d7e3f03464dbea65228dc1e8dcff266b8' => 
    array (
      0 => 'templates/plantillas/modulos/clientes/listaMomentos.tpl',
      1 => 1468640403,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162702704257848e380a1288-64279405',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57848e38114b18_33412613',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57848e38114b18_33412613')) {function content_57848e38114b18_33412613($_smarty_tpl) {?><table id="tblLista" class="table table-bordered table-hover">
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
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['fecha'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['altura'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['peso'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['imc'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['pgce'];?>
</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>