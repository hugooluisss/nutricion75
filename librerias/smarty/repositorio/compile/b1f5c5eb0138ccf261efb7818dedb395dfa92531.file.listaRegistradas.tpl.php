<?php /* Smarty version Smarty-3.1.11, created on 2016-06-23 21:53:19
         compiled from "templates/plantillas/modulos/infracciones/listaRegistradas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:821266832576ca09f64ff47-36169113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1f5c5eb0138ccf261efb7818dedb395dfa92531' => 
    array (
      0 => 'templates/plantillas/modulos/infracciones/listaRegistradas.tpl',
      1 => 1466228211,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '821266832576ca09f64ff47-36169113',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lista' => 0,
    'row' => 0,
    'PAGE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576ca09f6dac89_35713525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576ca09f6dac89_35713525')) {function content_576ca09f6dac89_35713525($_smarty_tpl) {?><div class="box">
	<div class="box-body">
		<table id="tblLista" class="table table-bordered table-hover">
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
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['row']->value['fecha'];?>
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
							<button type="button" class="btn btn-success" action="modificar" title="Modificar" datos='<?php echo $_smarty_tpl->tpl_vars['row']->value['json'];?>
'><i class="fa fa-pencil"></i></button>
							<?php if ($_smarty_tpl->tpl_vars['PAGE']->value['usuario']->getIdTipo()==1){?>
								<button type="button" class="btn btn-danger" action="eliminar" title="Eliminar" identificador='<?php echo $_smarty_tpl->tpl_vars['row']->value['idInfraccion'];?>
'><i class="fa fa-times"></i></button>
							<?php }?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div><?php }} ?>