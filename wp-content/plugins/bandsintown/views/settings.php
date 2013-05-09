<div class="wrap" id="bandsintown_wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2>Tour Dates</h2>
	
	<?php if ( !empty($this->errors) ) : ?>
	<div class="message error errors">
		<ul>
			<li><?php echo implode('</li><li>', $this->errors); ?></li>
		</ul>
	</div>
	<?php endif; ?>
	<?php if ( !empty($this->success) ) : ?>
	<div class="message updated">
		<p><?php echo $this->success; ?></p>
	</div>
	<?php endif; ?>
	
	<form method="post" action="">
		
		<p>
			<label for="bitp_options[artist]"><strong>Artist</strong></label>
			<br />
			<input type="text" id="bitp_options[artist]" name="bitp_options[artist]" value="<?php echo esc_attr($this->options['artist']); ?>" tabindex="1" />
			<input type="submit" class="button-primary" value="Save Settings" tabindex="1" />
		</p>
		<p>
			<strong>Default CSS</strong>
			<br />
			You can use this section to review our default CSS rules and create your own custom rules
			to override the look and feel of the widget output.
		</p>
		
		<div style="padding:1em .5em;border:1px solid #ccc;background:#f5f5f5;color:#444;height:137px;overflow:auto;"><pre id='default-css'></pre></div>

		<p>
			<strong>Custom CSS:</strong>
			<br />
			<textarea name="bitp_options[custom_css]" style="width: 100%;height:275px;" tabindex="1"><?php echo $this->options['custom_css']; ?></textarea>
		</p>
		
		<p><input type="submit" class="button-primary" value="Save Settings" tabindex="1" /></p> 

	</form>
	
</div>
<script type='text/javascript' src='http://www.bandsintown.com/javascripts/bit_widget.js'></script>
<script type='text/javascript'>
  var widget = new BIT.Widget({});
  var default_css = widget.css();
  default_css = default_css.replace(/<\/?style[^>]*>/gi,"");
  default_css = default_css.replace(/}/g,"}\n");
  document.getElementById('default-css').innerHTML = default_css;
</script>
