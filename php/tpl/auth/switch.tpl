{if $auth_logged}
	{include file=$LogoutForm_template}
{else}
	{include file=$LoginForm_template}
{/if}