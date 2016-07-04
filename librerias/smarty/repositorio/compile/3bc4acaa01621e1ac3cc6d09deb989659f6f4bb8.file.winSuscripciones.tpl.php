<?php /* Smarty version Smarty-3.1.11, created on 2016-07-04 09:00:35
         compiled from "templates/plantillas/modulos/clientes/winSuscripciones.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11035888545779d47dab6296-89725021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bc4acaa01621e1ac3cc6d09deb989659f6f4bb8' => 
    array (
      0 => 'templates/plantillas/modulos/clientes/winSuscripciones.tpl',
      1 => 1467638530,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11035888545779d47dab6296-89725021',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5779d47daffc88_41403048',
  'variables' => 
  array (
    'paquetes' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5779d47daffc88_41403048')) {function content_5779d47daffc88_41403048($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/nutricion75/librerias/smarty/plugins/modifier.date_format.php';
?><div class="modal fade" id="winSuscripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Suscripciones</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
					<div class="form-group">
						<label for="txtFecha" class="col-sm-2 control-label">Fecha *</label>
						<div class="col-sm-2">
							<input type="text" id="txtFecha" name="txtFecha" autofocus="true" class="form-control" autocomplete="false" value="<?php echo smarty_modifier_date_format(time(),"Y-m-d");?>
" placeholder="Y-m-d"/>
							<div id="datepicker"></div>
						</div>
						<label for="txtNombre" class="col-sm-2 control-label">Paquete *</label>
						<div class="col-sm-5">
							<select id="selPaquete" name="selPaquete" class="form-control">
								<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['paquetes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idPaquete'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-info pull-right">+</button>
						</div>
					</div>
					<input type="hidden" id="id"/>
				</form>
				<div class="row" id="dvListaSuscripciones"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div><?php }} ?>