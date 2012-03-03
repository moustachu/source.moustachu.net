<div class="mod head">
	<h1>CSS Preview</h1>
</div>

<p>Based on the object-oriented CSS approach (<a href="http://oocss.org/">oocss.org</a>)</p>

<p>Use developer tool in order to reveal CSS</p>

<h2>Layout</h2>

<p>structure used to organize the page horizontally</p>
<p><a href="http://oocss.org/grids_docs.html">more example</a></p>

<div class="mod bar alt">
	<p><code>mod</code></p>
</div>

<div class="line">
	<div class="unit">
		<div class="mod bar alt">
			<p><code>line > unit</code></p>
		</div>
	</div>
</div>


<div class="line">
	<div class="unit lastUnit">
		<div class="mod bar alt">
			<p><code>line > unit lastUnit</code></p>
		</div>
	</div>
</div>

<div class="line">
	<div class="unit">
		<div class="mod bar alt">
			<p><code>line > unit</code></p>
		</div>
	</div>
	<div class="unit">
		<div class="mod bar alt">
			<p><code>line > unit</code></p>
		</div>
	</div>
	<div class="unit">
		<div class="mod bar alt">
			<p><code>line > unit</code></p>
		</div>
	</div>
	<div class="unit">
		<div class="mod bar alt">
			<p><code>line > unit</code></p>
		</div>
	</div>
	<div class="unit lastUnit">
		<div class="mod bar alt">
			<p><code>line > unit lastUnit</code></p>
		</div>
	</div>
</div>

<div class="line">
	<div class="unit size1of4">
		<div class="mod bar alt">
			<p><code>line > unit size1of4</code></p>
		</div>
	</div>
	<div class="unit size1of2">
		<div class="mod bar alt">
			<p><code>line > unit size1of2</code></p>
		</div>
	</div>
	<div class="unit lastUnit">
		<div class="mod bar alt">
			<p><code>line > unit lastUnit</code></p>
		</div>
	</div>
</div>


<h2>Wrapper</h2>

<p>css class combination for wrapping elements</p>

<div class="mod bar alt">
	<p>
		<code>mod bar alt (p)</code>
		all padding are equals
	</p>
</div>

<div class="mod head">
	<p>
		<code>mod head (p)</code>
		header variation
	</p>
</div>

<div class="mod alt">
	<p><code>mod alt (p)</code></p>
	<p>
		<code>(p)</code>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
    	Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
    	Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
</div>

<div class="mod foot">
	<p>
		<code>mod foot (p)</code>
		footer variation
	</p>
</div>

<div class="line">
	<div class="unit size1of2">
		<div class="mod alt ui-corner-all">
			<p><code>mod alt ui-corner-all</code></p>
			<p>
			   Rounded corner : a little test with the <a href="http://jqueryui.com/docs/Theming/API">jquery UI CSS framework</a>
			</p>
		</div>
	</div>
</div>

<h2>Elements</h2>

<p>common page items</p>

<div class="line">
	<div class="unit size1of3">
		<div class="mod">
			<h1>page<code>(h1)</code></h1>
			<h2>section<code>(h2)</code></h2>
			<h3>sub-section<code>(h3)</code></h2>
		</div>
	</div>
	<div class="unit size1of3">
		<div class="mod">
			<p><a class="nav" href="#">internal navigation</a> <code>(a) nav</code></p>
			<p><a class="menu" href="#">menu item</a> <code>(a) menu</code></p>
		</div>
	</div>
	<div class="unit lastUnit">
		<div class="mod">
			<p><a href="#"><code>(a)</code> default link</a></p>
			<p><strong><code>(strong)</code> important information</strong></p>
			<p><em><code>(em)</code> alternative or quoted information</em></p>
			<p><code><code>(code)</code> spellable information</code></p>
		</div>
	</div>
</div>

<h2>Form UI</h2>

<p>common form & interface items</p>

<div class="line">
	<div class="unit size1of3">
		<div class="mod">
			<h3>default</h3>
			<form id="CssPreview" action="#" >
				<p>
					<code>(label)</code>
					<label for="CssPreview_text">input information</label>
				</p>
				<p>
					<code>(text)</code>
					<input type="text" name="CssPreview_text" size="25" value="some input" />
				</p>
				<p>
					<code>(select)</code>
					<select name="CssPreview_select">
						<option value="1"><code>(option)</code> 01</option>
		    			<option value="2"><code>(option)</code> 02</option>
		    			<option value="3"><code>(option)</code> 03</option>
		    			<option value="4"><code>(option)</code> 04</option>
		    			<option value="5"><code>(option)</code> 05</option>
					</select>
				</p>
				<p>
					<code>(password)</code>
					<input type="password" name="CssPreview_password" size="20" value="xxxxx" />
				</p>
				<p>
					<code>(button)</code>
					<button>button</button>
				<p>
					<code>(submit)</code>
					<input type="submit" name="CssPreview_submit" value="Submit"/>
				</p>
			</form>
		</div>
	</div>
	<div class="unit lastUnit">
		<div class="mod">
			<h3>jquery</h3>
			<p>
				<code>(button) ui bt-std</code>
				<button class="ui bt-std">button</button>
			</p>
			<p>
				<code>(button) ui bt-lock</code>
				<button class="ui bt-lock">lock</button>
			</p>
			<p>
				<code>(text) direct mockup</code>
    			<div class="line alt2 ui-corner-all">
    				<div class="unit">
    					<span class="ui-icon ui-icon-locked"></span>
    				</div>
    				<div class="unit">
    					<input type="text" class="ui tx-std tx-icon-locked" name="CssPreview_text" size="25" value="some input" />
    				</div>
    			</div>
    			
    		</p>
			<p>
				<code>(text)</code>
    			{tx_std id="myText" name="myText" size="25" value="some input" }
			</p>
    		<p>
				<code>&#123;tx-icon&#125; ui-icon-locked</code>
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="25" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="50" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="2" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="5" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="10" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="100" value="some input" }
    			{tx_icon id="myTextWithIcon" name="myTextWithIcon" icon="ui-icon-locked" size="200" value="some input" }
    		</p>
		</div>
	</div>
</div>

<div class="mod foot">
	<p>
		{$project_name} v{$project_version} 
	</p>
</div>