<?php /* Smarty version Smarty-3.1.12, created on 2018-07-17 16:53:40
         compiled from "/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/login_fail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20029255315b4e02f4ef0630-88200571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03a539dc82d15ef06aac3a897206607848824439' => 
    array (
      0 => '/Users/victorfauquembergue/Sites/gite-backend-projet/tpl/modal/login_fail.tpl',
      1 => 1531837934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20029255315b4e02f4ef0630-88200571',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b4e02f502c794_02303554',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b4e02f502c794_02303554')) {function content_5b4e02f502c794_02303554($_smarty_tpl) {?><div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header2">
            <span class="close">&times;</span>
            <h2>Erreur</h2>
        </div>
        <div class="modal-body">
            <p>Le pseudo ou le mot de passe que vous avez entré n'est pas correct.</p>
            <p>Veuillez rééssayer avec une autre combinaison.</p>
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