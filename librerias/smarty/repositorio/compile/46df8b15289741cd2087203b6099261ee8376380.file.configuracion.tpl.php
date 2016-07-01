<?php /* Smarty version Smarty-3.1.11, created on 2016-07-01 11:47:02
         compiled from "templates/plantillas/modulos/configuracion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1745894857576df8caf0a993-45834583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46df8b15289741cd2087203b6099261ee8376380' => 
    array (
      0 => 'templates/plantillas/modulos/configuracion.tpl',
      1 => 1467391620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1745894857576df8caf0a993-45834583',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576df8cb0520a1_56465165',
  'variables' => 
  array (
    'suscripcion' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576df8cb0520a1_56465165')) {function content_576df8cb0520a1_56465165($_smarty_tpl) {?><div class="box">
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
		</form>
	</div>
</div><?php }} ?>