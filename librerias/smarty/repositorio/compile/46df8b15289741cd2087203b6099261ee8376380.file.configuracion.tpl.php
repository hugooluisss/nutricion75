<?php /* Smarty version Smarty-3.1.11, created on 2016-08-21 22:27:12
         compiled from "templates/plantillas/modulos/configuracion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11695178555782a93c347476-76780279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46df8b15289741cd2087203b6099261ee8376380' => 
    array (
      0 => 'templates/plantillas/modulos/configuracion.tpl',
      1 => 1471836403,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11695178555782a93c347476-76780279',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5782a93c3924c6_47447010',
  'variables' => 
  array (
    'suscripcion' => 0,
    'terminos' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5782a93c3924c6_47447010')) {function content_5782a93c3924c6_47447010($_smarty_tpl) {?><div class="box">
	<div class="box-header">
		<h3>Configuración del sistema </h3>
	</div>
	<div class="box-body">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<!--<div class="form-group">
				<label for="txtCostoMantenimiento" class="col-lg-2">Costo suscripción</label>
				<div class="col-lg-3">
					<input class="form-control text-right" id="txtSuscripcion" name="txtSuscripcion" value="<?php echo $_smarty_tpl->tpl_vars['suscripcion']->value;?>
" clave="suscripcion" />
				</div>
			</div>-->
			<div class="form-group">
				<label for="txtTerminos" class="col-lg-3">Términos y condiciones</label>
				<div class="col-lg-9">
					<textarea id="txtTerminos" name="txtTerminos" class="form-control" rows="6" clave="terminos"><?php echo $_smarty_tpl->tpl_vars['terminos']->value;?>
</textarea>
				</div>
			</div>
		</form>
	</div>
</div><?php }} ?>