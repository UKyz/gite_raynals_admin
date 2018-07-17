<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 12:26:20
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/price_confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4792736965b4dc44c077129-57852075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '217b8f26fe63484606bc8492ea679080d5dbbc34' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/price_confirmation.tpl',
      1 => 1531823175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4792736965b4dc44c077129-57852075',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4dc44c0a6e91_86393265',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4dc44c0a6e91_86393265')) {function content_5b4dc44c0a6e91_86393265($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Vos prix ont bien été modifié</h2>
        </div>
        <div class="modal-body">
            <p>Uniquement vos prix ont été modifié.</p>
            <p>S'il y avez une réservation entre ces dates, le prix de la réservation n'a pas été modifié.</p>
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