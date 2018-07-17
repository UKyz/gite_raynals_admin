<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 15:29:25
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/refuse_reservation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7569480085b4def3526ae54-66630303%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf482c689ecd69a792b052fcebf146acd6716d53' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/refuse_reservation.tpl',
      1 => 1531834121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7569480085b4def3526ae54-66630303',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4def35292819_91480336',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4def35292819_91480336')) {function content_5b4def35292819_91480336($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>La réservation a bien été refusé</h2>
        </div>
        <div class="modal-body">
            <p>La réservation est maintenant supprimé.</p>
            <p>Un email de refus a été envoyé au client.</p>
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