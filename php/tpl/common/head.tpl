<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{foreach from=$meta key=meta_name item=meta_value}
	<meta name="{$meta_name}" content="{$meta_value}" />
{/foreach}
	<title>{$title}</title>
{foreach from=$css item=css_file}
	<link rel="stylesheet" type="text/css" href="css/{$css_file}" />
{/foreach}
{foreach from=$js item=js_file}
	<script type="text/javascript" src="js/{$js_file}"/></script>
{/foreach}
</head>