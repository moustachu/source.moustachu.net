{include file='common/error.tpl' errors=$UserChange_errors }
<form name="UserChange" action="" method="post">
    <input type="hidden" name="action" value="UserChange"/>
    <p>
    	<span class="label">choose : </span>
    	<select name="UserChange_name" value="{$UserChange_username}" >
    		{foreach from=$userlist item="u"}
    			<option value="{$u}" >{$u}</option>
    		{/foreach}
    	</select>
    </p>
    <p>
    	<span class="label">password : </span>
    	<input type="password" name="UserChange_password" size="20" value="{$UserChange_password}" />
    	<input type="submit" name="UserChange_submit" value="Change"/>
    </p>
</form>