<?php /* Smarty version Smarty-3.1.12, created on 2018-08-23 09:49:46
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/pages/page_connexion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11358416135b7e671add9d00-10940147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e46d21e42a68e7cf026d8b7d5b1bb153f6cbd851' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/pages/page_connexion.tpl',
      1 => 1534836271,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11358416135b7e671add9d00-10940147',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b7e671ae4b616_59325174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b7e671ae4b616_59325174')) {function content_5b7e671ae4b616_59325174($_smarty_tpl) {?><br>
<hr>
<div class="w3-row-padding connexion">
    <div>
        <form class="w3-container w3-card-4" action="./index.php?action=connexion" method="post">
            <h2>Connexion</h2>
            <div class="w3-section">
                <input class="w3-input" type="text" name="user" required placeholder="Pseudo">
            </div>
            <div class="w3-section">
                <input class="w3-input" type="password" name="password" required placeholder="Mot de passe">
            </div>
            <div class="w3-section">
                <input type="submit" value="Se Connecter" class="w3-button w3-theme2">
            </div>
        </form>
    </div>
</div><?php }} ?>