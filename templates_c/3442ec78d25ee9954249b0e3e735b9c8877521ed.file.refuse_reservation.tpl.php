<?php /* Smarty version Smarty-3.1.12, created on 2018-08-27 10:41:15
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/refuse_reservation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4339901815b801776d5db50-92171413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3442ec78d25ee9954249b0e3e735b9c8877521ed' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/refuse_reservation.tpl',
      1 => 1535121810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4339901815b801776d5db50-92171413',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b801776df1d37_88279712',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b801776df1d37_88279712')) {function content_5b801776df1d37_88279712($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>La réservation a bien été refusé</h2>
        </div>
        <div class="modal-body">
            <p>Vous pouvez retrouver la réservation refusé dans l'onglet réservation refusé.</p>
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