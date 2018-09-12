<?php /* Smarty version Smarty-3.1.12, created on 2018-08-27 15:05:58
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/accept_reservation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11415309325b8019cc13ff59-20118711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e98981405f731f9879ea0cf717fe89f09db432e5' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/accept_reservation.tpl',
      1 => 1535359237,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11415309325b8019cc13ff59-20118711',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b8019cc20c7c7_69972243',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b8019cc20c7c7_69972243')) {function content_5b8019cc20c7c7_69972243($_smarty_tpl) {?><div id="myModal" class="modal">
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

<script>document.getElementById('myModal').style.display = 'block';
    openMenu(event,'Reservations1')</script><?php }} ?>