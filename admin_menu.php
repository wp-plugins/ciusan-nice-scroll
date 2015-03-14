<?php function Ciusan_NiceScroll_Settings() { global $options; $options = get_option('Ciusan_NiceScroll'); ?>
<form method="post" id="mainform" action="">
<table class="ciusan-plugin widefat" style="margin-top:50px;">
	<thead>
		<tr>
			<th scope="col">Settings</th>
			<th scope="col">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="titledesc">Enable Nice Scroll</td>
			<td class="forminp">
				<label class="ciusan-switch CNS-info">
					<input name="CSN_Enable" <?php if($options[CSN_Enable]=='on'){ ?>checked<?php }?> type="checkbox" class="ciusan-switch-input">
					<span class="ciusan-switch-label" data-yes="Yes" data-no="No"></span>
					<span class="ciusan-switch-handle"></span>
				</label>
				<small class="help">Select &quot;Yes&quot; for enable Ciusan Nice Scroll</small>
			</td>
		</tr>
	</tbody>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="<?php get_option($options) ?>" />
<p class="submit"><input type="submit" name="save" id="submit" class="button button-primary" value="Save Changes"/></p>
</form>
</div>
<?php } ?>