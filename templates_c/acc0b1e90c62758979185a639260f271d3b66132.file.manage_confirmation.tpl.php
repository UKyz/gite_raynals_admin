<?php /* Smarty version Smarty-3.1.12, created on 2018-08-27 10:39:19
         compiled from "/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/manage_confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9739626505b83b1a8ab2770-65615214%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acc0b1e90c62758979185a639260f271d3b66132' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite_raynals_back/tpl/modal/manage_confirmation.tpl',
      1 => 1535359156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9739626505b83b1a8ab2770-65615214',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b83b1a8b71a89_59065211',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b83b1a8b71a89_59065211')) {function content_5b83b1a8b71a89_59065211($_smarty_tpl) {?><div id="myModal" class="modal">
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

<script>document.getElementById('myModal').style.display = 'block';
    openMenu(event,'Calendrier')</script><?php }} ?>