<?php /* Smarty version Smarty-3.1.11, created on 2016-06-23 21:53:11
         compiled from "templates/plantillas/modulos/reportes/listaGeneral.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1666269101576ca097c056c7-07649057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd174ca49fef941e4fc97a001905d14e57b32debd' => 
    array (
      0 => 'templates/plantillas/modulos/reportes/listaGeneral.tpl',
      1 => 1466563951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1666269101576ca097c056c7-07649057',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576ca097c84226_37172849',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576ca097c84226_37172849')) {function content_576ca097c84226_37172849($_smarty_tpl) {?><table id="tblLista" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Fecha/Hora</th>
			<th>Depto</th>
			<th>Condominio</th>
			<th>Inquilino</th>
			<th>Reglamento</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
			<tr title="<?php echo $_smarty_tpl->tpl_vars['row']->value['estado'];?>
">
				<td style="border-left: 5px solid <?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['fecha'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['hora'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['claveDepto'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['condominio'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['inquilino'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['row']->value['area'];?>
 / <?php echo $_smarty_tpl->tpl_vars['row']->value['inciso'];?>
</td>
				<td style="text-align: right">
					<button type="button" class="btn btn-default" action="detalle" title="Detalle" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-keyboard-o"></i></button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table><?php }} ?>