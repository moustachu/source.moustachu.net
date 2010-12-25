{include file='common/debug.tpl'}
<div class="section">
	<h2>Your user agent</h2>
	<p>{$php_user_agent}</p>
</div>

<div class="section">
	<h2>Browser</h2>
	<ul>
		{foreach from=$b_info key=k item=i}
		<li>{$k} = {$i}</li>
		{/foreach}
	</ul>
</div>
<div class="section">
	<h2>Audio</h2>
	<ul>
		{foreach from=$b_feature->audio key=k item=i}
		<li>{$k} = {$i}</li>
		{/foreach}
	</ul>
	<h2>Video</h2>
	<ul>
		{foreach from=$b_feature->video key=k item=i}
		<li>{$k} = {$i}</li>
		{/foreach}
	</ul>
</div>
<div class="section">
	<h2>Input</h2>
	<ul>
		{foreach from=$b_feature->input key=k item=i}
		<li>{$k} = {$i}</li>
		{/foreach}
	</ul>
	<h2>Input types</h2>
	<ul>
		{foreach from=$b_feature->inputtypes key=k item=i}
		<li>{$k} = {$i}</li>
		{/foreach}
	</ul>
</div>
<div class="section">
	<h2>Other features</h2>
	<ul>
		{foreach from=$b_feature key=k item=i}
			{if ($k!='video')&&($k!='audio')&&($k!='input')&&($k!='inputtypes')}
				<li>{$k} = {$i}</li>
			{/if}
		{/foreach}
	</ul>
</div>
