<?php /* Smarty version Smarty-3.1.11, created on 2016-07-13 17:08:49
         compiled from "templates/plantillas/modulos/alimentos/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16329883415786b89ccb5bd8-70116998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3540cb73017e6a3aa286b4b2c0bbade007442cd0' => 
    array (
      0 => 'templates/plantillas/modulos/alimentos/panel.tpl',
      1 => 1468447728,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16329883415786b89ccb5bd8-70116998',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5786b89ccfa8c6_48524487',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5786b89ccfa8c6_48524487')) {function content_5786b89ccfa8c6_48524487($_smarty_tpl) {?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Alimentos</h1>
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
		<div class="alert alert-success">Las cantidades son en proporciones de 100g</div>
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
						<label for="txtCarbohidratos" class="col-lg-2">Carbohidratos</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtCarbohidratos" name="txtCarbohidratos" value="0">
						</div>
					</div>
					<div class="form-group">
						<label for="txtProteinas" class="col-lg-2">Proteinas</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtProteinas" name="txtProteinas" value="0">
						</div>
					</div>
					<div class="form-group">
						<label for="txtGrasas" class="col-lg-2">Grasas</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtGrasas" name="txtGrasas" value="0">
						</div>
					</div>
					<div class="form-group">
						<label for="txtFibra" class="col-lg-2">Fibra</label>
						<div class="col-lg-3">
							<input class="form-control" id="txtFibra" name="txtFibra" value="0">
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
</div><?php }} ?>