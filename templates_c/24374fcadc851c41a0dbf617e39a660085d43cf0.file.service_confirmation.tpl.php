<?php /* Smarty version Smarty-3.1.12, created on 2018-07-23 10:30:22
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/service_confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3572057545b558c6d8500d5-30622053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24374fcadc851c41a0dbf617e39a660085d43cf0' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/service_confirmation.tpl',
      1 => 1532334531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3572057545b558c6d8500d5-30622053',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b558c6d89e1d9_54665228',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b558c6d89e1d9_54665228')) {function content_5b558c6d89e1d9_54665228($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Vos services ont bien été mis à jour.</h2>
        </div>
        <div class="modal-body">
            <p>Vous venez de mettre à jour vos services facturables.</p>
            <p>Vos services sur le front ont aussi était mis à jour.</p>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('myModal');
    const span = document.getElementsByClassName("close")[0];

    span.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>document.getElementById('myModal').style.display = 'block';</script><?php }} ?>