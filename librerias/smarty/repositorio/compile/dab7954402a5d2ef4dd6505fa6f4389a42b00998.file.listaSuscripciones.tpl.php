<?php /* Smarty version Smarty-3.1.11, created on 2016-07-10 15:00:22
         compiled from "templates/plantillas/modulos/clientes/listaSuscripciones.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7389104175779d73ce29241-42337940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dab7954402a5d2ef4dd6505fa6f4389a42b00998' => 
    array (
      0 => 'templates/plantillas/modulos/clientes/listaSuscripciones.tpl',
      1 => 1467658204,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7389104175779d73ce29241-42337940',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5779d73ce97197_94547921',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5779d73ce97197_94547921')) {function content_5779d73ce97197_94547921($_smarty_tpl) {?>
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
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['inicio'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['fin'];?>
</td>
				<td style="text-align: right">
					<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='<?php echo $_smarty_tpl->tpl_vars['row']->value['idSuscripcion'];?>
'><i class="fa fa-times"></i></button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>