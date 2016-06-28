<?php /* Smarty version Smarty-3.1.11, created on 2016-06-24 21:35:47
         compiled from "templates/plantillas/modulos/reportes/panelGeneral.tpl" */ ?>
<?php /*%%SmartyHeaderCode:976996148576ca096861401-66163288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c592d2de50adae40d9e728d4d67bd7d07618390c' => 
    array (
      0 => 'templates/plantillas/modulos/reportes/panelGeneral.tpl',
      1 => 1466822146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '976996148576ca096861401-66163288',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576ca0968e8948_92172440',
  'variables' => 
  array (
    'estados' => 0,
    'row' => 0,
    'departamentos' => 0,
    'areas' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576ca0968e8948_92172440')) {function content_576ca0968e8948_92172440($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/Library/WebServer/Documents/condominios/librerias/smarty/plugins/modifier.date_format.php';
?><div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Reporte general de infracciones</h1>
	</div>
</div>

<div class="box">
	<div class="box-body">
		<form role="form" id="frmAdd" class="form-horizontal" onsubmit="javascript: return false;">
			<div class="form-group">
				<label for="txtFecha" class="col-lg-2">Fecha</label>
				<div class="col-lg-2">
					<div class="input-group date">
						<input class="form-control" id="txtFecha" name="txtFecha" value="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
" />
					</div>
				</div>
				<div class="col-lg-2">
					<div class="input-group date">
						<input class="form-control" id="txtFechaFin" name="txtFechaFin" value="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
" />
					</div>
				</div>
				<label for="selEstado" class="col-lg-2">Estado</label>
				<div class="col-lg-3">
					<select class="form-control" id="selEstado" name="selEstado">
						<option value="%">Cualquier estado
						<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['estados']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idEstado'];?>
" style="color: <?php echo $_smarty_tpl->tpl_vars['row']->value['color'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>

						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="selDepartamento" class="col-lg-2">Departamento</label>
				<div class="col-lg-4">
					<select class="form-control" id="selDepartamento" name="selDepartamento">
						<option value="%">Cualquiera
						<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departamentos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idDepartamento'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['clave'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['condominio'];?>
 - <?php echo $_smarty_tpl->tpl_vars['row']->value['inquilino'];?>

						<?php } ?>
					</select>
				</div>
				<label for="selArea" class="col-lg-2">Área/Reglamento</label>
				<div class="col-lg-3">
					<select class="form-control" id="selArea" name="selArea">
						<option value="%">Cualquier área/reglamento
						<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['areas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['idArea'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>

						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-right">
					<input type="submit" class="btn btn-info" value="Filtrar" />
					<input type="button" class="btn btn-success" value="Excel" id="btnExcel"/>
					<input type="button" class="btn btn-success" value="PDF" id="btnPDF"/>
				</div>
			</div>
		</form>
		<br />
		<div class="alert alert-info visible-xs">Recorre de forma horizontal para ver el contenido completo de la tabla</div>
		<div id="dvLista" class="table-responsive"></div>
	</div>
</div>


<div class="modal fade" id="winAutorizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h1>Infracción</h1>
			</div>
			<div class="modal-body">
				<div class="row text-right">
					<div class="col-lg-12">
						<div class="btn-group btn-group-xs" role="group" aria-label="...">
							<button class="btn btn-primary" id="btnCartaFicha"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar carta y ficha</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">No.</div>
					<div class="col-lg-4" campo="idInfraccion"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">Fecha</div>
					<div class="col-lg-4" campo="fecha"></div>
					<div class="col-lg-2 text-right text-success">Hora</div>
					<div class="col-lg-4" campo="hora"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">Departamento</div>
					<div class="col-lg-4" campo="claveDepto"></div>
					<div class="col-lg-2 text-right text-success">Condominio</div>
					<div class="col-lg-4" campo="condominio"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">Inquilino</div>
					<div class="col-lg-10" campo="inquilino"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">Email</div>
					<div class="col-lg-5" campo="correo"></div>
				</div>
				<br />
				<div class="row">
					<div class="col-lg-2 text-right text-success">Area/Reglamento</div>
					<div class="col-lg-4" campo="area"></div>
					<div class="col-lg-2 text-right text-success">Inciso</div>
					<div class="col-lg-4" campo="inciso"></div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-right text-success">Servidor</div>
					<div class="col-lg-4" campo="servidor"></div>
					<div class="col-lg-2 text-right text-success">Cámara</div>
					<div class="col-lg-4" campo="camara"></div>
				</div>
				<br />
				<div class="row">
					<div class="col-lg-2 text-right text-success">Descripción</div>
					<div class="col-lg-10" campo="descripcion"></div>
				</div>
				<br />
				<div class="row">
					<div class="col-lg-2 text-right text-danger">Monto</div>
					<div class="col-lg-4" campo="monto"></div>
					<div class="col-lg-2 text-right text-danger">Ocasión</div>
					<div class="col-lg-4" campo="ocasion"></div>
				</div>
				<br />
				<div id="dvListaMedios">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<input id="id" name="id" value="" type="hidden"/>
			</div>
		</div>
	</div>
</div><?php }} ?>