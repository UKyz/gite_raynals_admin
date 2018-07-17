<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 15:28:52
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/accept_reservation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12516551855b4def144e4765-68114450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3de1789138380d6d74b8a21d75218421ce944485' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/accept_reservation.tpl',
      1 => 1531834121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12516551855b4def144e4765-68114450',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4def14593262_17248709',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4def14593262_17248709')) {function content_5b4def14593262_17248709($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>La réservation a bien été accepté</h2>
        </div>
        <div class="modal-body">
            <p>La réservation est maintenant accepté. Le calendrier a lui aussi été modifié.</p>
            <p>Un email de confirmation a été envoyé au client.</p>
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