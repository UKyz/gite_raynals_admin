<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 09:48:51
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/pages/page_connexion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10994574525b4c8a52de6030-85525468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6278ed9aba2477eeb78c49bb9c6b40a1aece95c' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/pages/page_connexion.tpl',
      1 => 1531813730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10994574525b4c8a52de6030-85525468',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4c8a52e6a293_15745326',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4c8a52e6a293_15745326')) {function content_5b4c8a52e6a293_15745326($_smarty_tpl) {?><hr />
<br >
<hr />
<div class="w3-row-padding">
    <div>
        <form class="w3-container w3-card-4" action="./index.php?action=connexion" method="post">
            <h2>Connexion</h2>
            <div class="w3-section">
                <input class="w3-input" type="text" name="user" required>
                <label>Pseudo</label>
            </div>
            <div class="w3-section">
                <input class="w3-input" type="password" name="password" required>
                <label>Mot De Passe</label>
            </div>
            <div class="w3-section">
                <input type="submit" value="Se Connecter" class="w3-button w3-theme">
            </div>
        </form>
    </div>
</div>
<hr />
<br >
<hr /><?php }} ?>