<?php /* Smarty version Smarty-3.1.11, created on 2016-07-12 01:27:40
         compiled from "templates/plantillas/modulos/clientes/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21275161685779d47da5cdf7-86066234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b0420e588c8f140981aaefc6982f8fda3e4f189' => 
    array (
      0 => 'templates/plantillas/modulos/clientes/panel.tpl',
      1 => 1468304857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21275161685779d47da5cdf7-86066234',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5779d47daacf55_49389892',
  'variables' => 
  array (
    'PAGE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5779d47daacf55_49389892')) {function content_5779d47daacf55_49389892($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Clientes</h1>
	</div>
</div>

<ul id="panelTabs" class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#listas">Lista</a></li>
  <li><a data-toggle="tab" href="#add">Agregar / Modificar</a></li>
</ul>

<div class="tab-content">
	<div id="listas" class="tab-pane fade in active">
		<div id="dvLista">
			
		</div>
	</div>
	
	<div id="add" class="tab-pane fade">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="box">
				<div class="box-body">
					<div class="form-group">
						<label for="txtNombre" class="col-lg-2">Nombre</label>
						<div class="col-lg-8">
							<input class="form-control" id="txtNombre" name="txtNombre">
						</div>
					</div>
					<div class="form-group">
						<label for="txtEmail" class="col-lg-2">Correo electrónico</label>
						<div class="col-lg-5">
							<input class="form-control" id="txtCorreo" name="txtCorreo" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="txtPass" class="col-lg-2">Contraseña</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtPass" name="txtPass" value="" type="password">
						</div>
					</div>
					<div class="form-group">
						<label for="selSexo" class="col-lg-2">Sexo</label>
						<div class="col-lg-3">
							<select class="selectpicker form-control" id="selSexo" name="selSexo">
								<option data-icon="fa fa-male" value="M" style="color: blue">Hombre</option>
								<option data-icon="fa fa-female" value="F" style="color: red">Mujer</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="txtPass" class="col-lg-2">Fecha de nacimiento</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtNacimiento" name="txtNacimiento" value="" class="selectpicker" type="date">
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="reset" id="btnReset" class="btn btn-default">Cancelar</button>
					<button type="submit" class="btn btn-info pull-right">Guardar</button>
					<input type="hidden" id="id"/>
				</div>
			</div>
		</form>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['PAGE']->value['rutaModulos']).("modulos/clientes/winSuscripciones.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['PAGE']->value['rutaModulos']).("modulos/clientes/winMomentos.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>