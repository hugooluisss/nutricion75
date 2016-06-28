<?php /* Smarty version Smarty-3.1.11, created on 2016-06-23 21:54:29
         compiled from "templates/plantillas/modulos/infracciones/listaImagenes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41415920576ca0e56657e8-20996070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd90b34dc31f6f650900a5d98a66f32d6918c8956' => 
    array (
      0 => 'templates/plantillas/modulos/infracciones/listaImagenes.tpl',
      1 => 1466554258,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41415920576ca0e56657e8-20996070',
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
  'unifunc' => 'content_576ca0e56ce5d6_21670670',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576ca0e56ce5d6_21670670')) {function content_576ca0e56ce5d6_21670670($_smarty_tpl) {?><ul class="media-list">
<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
$_smarty_tpl->tpl_vars["row"]->_loop = true;
?>
	<li class="media">
		<a class="pull-left" href="#">
			<img class="media-object" src="<?php echo $_smarty_tpl->tpl_vars['row']->value['miniatura'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
">
		</a>
		<div class="media-body">
			<h4 class="media-heading"><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</h4>
			<span class="text-muted"><?php echo $_smarty_tpl->tpl_vars['row']->value['real'];?>
</span>
			<div class="pull-right">
				<a class="btn btn-info btn-xs" title="Abrir" href='<?php echo $_smarty_tpl->tpl_vars['row']->value['real'];?>
' target="_blank"><i class="fa fa-folder-open-o"></i> Abrir</a>
				<button type="button" class="btn btn-danger btn-xs" action="eliminar" title="Eliminar" nombre='<?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
'><i class="fa fa-remove"></i> Eliminar</button>
			</div>
		</div>
	</li>
<?php }
if (!$_smarty_tpl->tpl_vars["row"]->_loop) {
?>
	<li>Sin objetos en el repositorio</li>
<?php } ?>
</ul><?php }} ?>