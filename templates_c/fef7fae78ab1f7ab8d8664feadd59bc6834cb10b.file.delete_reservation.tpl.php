<?php /* Smarty version Smarty-3.1.12, created on 2018-08-24 16:43:37
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/delete_reservation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15600780655b8019996303d3-98488116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fef7fae78ab1f7ab8d8664feadd59bc6834cb10b' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/delete_reservation.tpl',
      1 => 1535121810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15600780655b8019996303d3-98488116',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b801999681ea8_81652824',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b801999681ea8_81652824')) {function content_5b801999681ea8_81652824($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>La réservation a bien été supprimé</h2>
        </div>
        <div class="modal-body">
            <p>La réservation est maintenant supprimé.</p>
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