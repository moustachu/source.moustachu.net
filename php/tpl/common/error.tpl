{if $errors }
	{foreach from=$errors item="e" }
		<p class="error">{$e}</p>
	{/foreach}
{/if}