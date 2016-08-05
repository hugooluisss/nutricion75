<?php /* Smarty version Smarty-3.1.11, created on 2016-08-04 23:43:37
         compiled from "templates/plantillas/modulos/menuPlantilla/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192938447957a41024968d03-92842737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6950402f922f145aa57ad268904efa47d76529d3' => 
    array (
      0 => 'templates/plantillas/modulos/menuPlantilla/panel.tpl',
      1 => 1470372210,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192938447957a41024968d03-92842737',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57a410249e48c9_67118616',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57a410249e48c9_67118616')) {function content_57a410249e48c9_67118616($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Plantilla de menú</h1>
	</div>
</div>
	
<div class="box">
	<div class="box-body">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="txtNombre" class="col-lg-2">Nombre</label>
				<div class="col-lg-5">
					<input class="form-control" id="txtNombre" name="txtNombre">
				</div>
				<label for="txtCantidad" class="col-lg-2">Cantidad</label>
				<div class="col-lg-2">
					<input class="form-control" id="txtCantidad" name="txtCantidad">
				</div>
				<div class="col-lg-1">
					<input type="submit" class="btn btn-success" value="+">
					<input type="hidden" id="id"
				</div>
			</div>
		</form>
	</div>
</div>

<div class="box">
	<div class="box-body" id="dvLista">
	</div>
</div><?php }} ?>