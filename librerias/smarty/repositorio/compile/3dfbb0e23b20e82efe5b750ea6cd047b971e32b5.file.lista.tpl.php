<?php /* Smarty version Smarty-3.1.11, created on 2016-07-13 17:08:38
         compiled from "templates/plantillas/modulos/alimentos/lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5083448145786b89e9ec098-62324867%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dfbb0e23b20e82efe5b750ea6cd047b971e32b5' => 
    array (
      0 => 'templates/plantillas/modulos/alimentos/lista.tpl',
      1 => 1468447715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5083448145786b89e9ec098-62324867',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5786b89eae5492_22745855',
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5786b89eae5492_22745855')) {function content_5786b89eae5492_22745855($_smarty_tpl) {?><div class="box">
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
				<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['idAlimento'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['carbohidratos'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['grasas'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['proteinas'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['fibra'];?>
</td>
						<td style="text-align: right">
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='<?php echo $_smarty_tpl->tpl_vars['row']->value['idAlimento'];?>
'><i class="fa fa-times"></i></button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div><?php }} ?>