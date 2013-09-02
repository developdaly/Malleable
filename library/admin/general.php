<?php
	$malleable_categories = get_categories();
	$malleable_categories[] = false;
?>

<div class="postbox open">

<h3><?php _e('General settings','malleable'); ?></h3>

<div class="inside">

	<table class="form-table">
		
		<tr>
			<th>
				<label for="<?php echo $data['feature_category']; ?>"><?php _e('Address:','malleable'); ?></label>
				<p>This contact information is used to help visitors contact you more easily <em>and</em> it helps search engines better understand where you are.</p>
			</th>
			<td>
				Show address &amp; phone number<br />
				<input name="<?php echo $data['general_address']; ?>" id="<?php echo $data['general_address']; ?>" type="radio" value="yes"<?php if ( $val['general_address'] == "yes") { echo " checked='checked'"; } ?> onclick="showMe()" />&nbsp;Yes
				<input name="<?php echo $data['general_address']; ?>" id="<?php echo $data['general_address']; ?>" type="radio" value="no"<?php if ( $val['general_address'] == "no") { echo " checked='checked'"; } ?> onclick="showMe()" />&nbsp;No
				<br />
	
				<div id="showAddress">
					
					<span class="address-form">Street</span><br /><input name="<?php echo $data['general_address_street']; ?>" id="<?php echo $data['general_address_street']; ?>" type="text" value="<?php echo $val['general_address_street']; ?>" /><br />
					<span class="address-form">City</span><br />  <input name="<?php echo $data['general_address_city']; ?>"   id="<?php echo $data['general_address_city']; ?>"   type="text" value="<?php echo $val['general_address_city']; ?>" /><br />
					<span class="address-form">State</span><br /> <input name="<?php echo $data['general_address_state']; ?>"  id="<?php $data['general_address_state']; ?>"       type="text" value="<?php echo $val['general_address_state']; ?>" /><br />
					<span class="address-form">Zip</span><br />   <input name="<?php echo $data['general_address_zip']; ?>"    id="<?php $data['general_address_zip']; ?>"         type="text" value="<?php echo $val['general_address_zip']; ?>" /><br />
					<span class="address-form">Phone</span><br /> <input name="<?php echo $data['general_address_phone']; ?>"  id="<?php $data['general_address_phone']; ?>"       type="text" value="<?php echo $val['general_address_phone']; ?>" />
	
				</div>
											
			</td>
		</tr>
		
	</table>

</div>
</div>

<div class="postbox open">

<h3><?php _e('Front Page template settings','malleable'); ?></h3>

<div class="inside">

	<table class="form-table">

	<tr>
		<th>
			<label for="<?php echo $data['feature_category']; ?>"><?php _e('Feature Category:','malleable'); ?></label>
		</th>
		<td>
			<select id="<?php echo $data['feature_category']; ?>" name="<?php echo $data['feature_category']; ?>">
			<?php foreach($malleable_categories as $cat) : ?>

				<option value="<?php echo $cat->term_id; ?>" <?php if($val['feature_category'] == $cat->term_id) echo ' selected="selected"'; ?>>
					<?php echo $cat->name; ?>
				</option>

			<?php endforeach; ?>
			</select> 
			<?php _e('Leave blank to use sticky posts.','malleable'); ?>
		</td>
	</tr>
	<tr>
		<th>
			<label for="<?php echo $data['feature_num_posts']; ?>"><?php _e('Featured Posts:','malleable'); ?></label>
		</th>
		<td>
			<input id="<?php echo $data['feature_num_posts']; ?>" name="<?php echo $data['feature_num_posts']; ?>" value="<?php echo $val['feature_num_posts']; ?>" size="2" maxlength="2" />
			<label for="<?php echo $data['feature_num_posts']; ?>"><?php _e('How many feature posts should be shown?','hybrid'); ?></label>
		</td>
	</tr>

	<tr>
		<th>
			<label for="<?php echo $data['excerpt_category']; ?>"><?php _e('Excerpts Category:','malleable'); ?></label>
		</th>
		<td>
			<select id="<?php echo $data['excerpt_category']; ?>" name="<?php echo $data['excerpt_category']; ?>">
			<?php foreach($malleable_categories as $cat) : ?>

				<option value="<?php echo $cat->term_id; ?>" <?php if($val['excerpt_category'] == $cat->term_id) echo ' selected="selected"'; ?>>
					<?php echo $cat->name; ?>
				</option>

			<?php endforeach; ?>
			</select>
		</td>
	</tr>

	<tr>
		<th>
			<label for="<?php echo $data['excerpt_num_posts']; ?>"><?php _e('Excerpts Posts:','malleable'); ?></label>
		</th>
		<td>
			<input id="<?php echo $data['excerpt_num_posts']; ?>" name="<?php echo $data['excerpt_num_posts']; ?>" value="<?php echo $val['excerpt_num_posts']; ?>" size="2" maxlength="2" />
			<label for="<?php echo $data['excerpt_num_posts']; ?>"><?php _e('How many excerpts should be shown?','hybrid'); ?></label>
		</td>
	</tr>

	<tr>
		<th>
			<label for="<?php echo $data['headlines_category']; ?>"><?php _e('Headline Categories:','malleable'); ?></label>
		</th>
		<td>
			<label for="<?php echo $data['headlines_category']; ?>">
				<?php _e('Multiple categories may be chosen by holding the <code>Ctrl</code> key and selecting.', 'malleable'); ?>
			</label>
			<br />
			<select id="<?php echo $data['headlines_category']; ?>" name="<?php echo $data['headlines_category']; ?>[]" multiple="multiple" style="height:150px;">
			<?php foreach($malleable_categories as $cat) : ?>

				<option value="<?php echo $cat->term_id; ?>" <?php if(is_array($val['headlines_category']) && in_array($cat->term_id, $val['headlines_category'])) echo ' selected="selected"'; ?>>
					<?php echo $cat->name; ?>
				</option>

			<?php endforeach; ?>
			</select>
		</td>
	</tr>

	<tr>
		<th>
			<label for="<?php echo $data['headlines_num_posts']; ?>"><?php _e('Headlines Posts:','malleable'); ?></label>
		</th>
		<td>
			<input id="<?php echo $data['headlines_num_posts']; ?>" name="<?php echo $data['headlines_num_posts']; ?>" value="<?php echo $val['headlines_num_posts']; ?>" size="2" maxlength="2" />
			<label for="<?php echo $data['headlines_num_posts']; ?>"><?php _e('How many posts should be shown per headline category?','hybrid'); ?></label>
		</td>
	</tr>

	</table>

</div>
</div>