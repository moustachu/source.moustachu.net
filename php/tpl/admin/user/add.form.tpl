{include file='common/error.tpl' errors=$UserAdd_errors }
<form name="UserAdd" action="" method="post">
    <input type="hidden" name="action" value="UserAdd"/>
    <span class="label">login : </span>
    <input type="text" name="UserAdd_username" size="20" value="{$UserAdd_username}" />
    <span class="label">password : </span>
    <input type="password" name="UserAdd_password" size="20" value="{$UserAdd_password}" />
    <input type="submit" name="UserAdd_submit" value="Add"/>
</form>