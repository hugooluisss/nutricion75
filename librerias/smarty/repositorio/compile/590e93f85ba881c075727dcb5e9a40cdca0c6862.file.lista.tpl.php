<?php /* Smarty version Smarty-3.1.11, created on 2016-08-04 22:05:13
         compiled from "templates/plantillas/modulos/actividades/lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21139374595789783e43c577-77780674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '590e93f85ba881c075727dcb5e9a40cdca0c6862' => 
    array (
      0 => 'templates/plantillas/modulos/actividades/lista.tpl',
      1 => 1470290412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21139374595789783e43c577-77780674',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5789783e4a9365_71694257',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5789783e4a9365_71694257')) {function content_5789783e4a9365_71694257($_smarty_tpl) {?><div class="box">
	<div class="box-body">
		<table id="tblLista" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Grasa</th>
					<th>Proteinas</th>
					<th>Carbohidratos</th>
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
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['idActividad'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
						<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['grasas'];?>
 %</td>
						<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['proteinas'];?>
 %</td>
						<td class="text-right"><?php echo $_smarty_tpl->tpl_vars['row']->value['carbohidratos'];?>
 %</td>
						<td style="text-align: right">
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='<?php echo $_smarty_tpl->tpl_vars['row']->value['idActividad'];?>
'><i class="fa fa-times"></i></button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div><?php }} ?>