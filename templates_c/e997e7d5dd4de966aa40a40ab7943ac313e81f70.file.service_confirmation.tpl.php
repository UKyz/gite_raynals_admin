<?php /* Smarty version Smarty-3.1.12, created on 2018-08-27 10:41:11
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/service_confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8094562465b83b927bcf3d8-56113779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e997e7d5dd4de966aa40a40ab7943ac313e81f70' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/service_confirmation.tpl',
      1 => 1535359260,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8094562465b83b927bcf3d8-56113779',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b83b927d39b65_58976910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b83b927d39b65_58976910')) {function content_5b83b927d39b65_58976910($_smarty_tpl) {?><div id="myModal" class="modal">
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

<script>document.getElementById('myModal').style.display = 'block';
    openMenu(event,'Services')</script><?php }} ?>