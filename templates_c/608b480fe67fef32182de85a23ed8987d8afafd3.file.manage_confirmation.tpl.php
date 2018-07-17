<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 14:41:12
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/manage_confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10161593275b4de3e8541e50-49422698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '608b480fe67fef32182de85a23ed8987d8afafd3' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/manage_confirmation.tpl',
      1 => 1531830946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10161593275b4de3e8541e50-49422698',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4de3e87450d0_47822267',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4de3e87450d0_47822267')) {function content_5b4de3e87450d0_47822267($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Votre calendrier de réservation a bien été modofié</h2>
        </div>
        <div class="modal-body">
            <p>Uniquement la réservabilité des jours sélectionnés ont été modifié.</p>
            <p>S'il y avez des prix entre ces dates, les prix n'ont pas été modifié.</p>
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