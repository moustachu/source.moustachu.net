{include file='common/error.tpl' errors=$UserRemove_errors }
<form name="UserRemove" action="" method="post">
    <input type="hidden" name="action" value="UserRemove"/>
    <span class="label">choose : </span>
    <select name="UserRemove_name" value="{$UserAdd_username}" >
    	{foreach from=$userlist item="u"}
    		<option value="{$u}">{$u}</option>
    	{/foreach}
    </select>
    <input type="submit" name="UserRemove_submit" value="Remove"/>
</form>