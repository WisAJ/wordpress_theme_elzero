<?php

if (comments_open()){   ?>

	<h3 class="comments-count" >
		 <?php comments_number('0 Comments', 'One Comment', '% Comments')?>
	
	</h3> 

	<?php

	echo '<ul class="list-unstyled comments-list">';

	$args = array(
		'type'    => 'comment',
		 'max_depth'         => '3',
		 'avatar_size'       => 32
	 );

	wp_list_comments($args);

	echo '</ul>';

//  this is bootstrap form control. looks good and can be used instead of the native function if you want.
	$argsform = array (
		'fields' => array (
			'author' => '<div calss="form-group"><label  for="FormCon1" >Name</label>  <input type="text" id="FormCon1" class="form-control" placeholder="you name"> </div>',
			'email' => '<div calss="form-group"><labe for="FormCon2" l>Emaile</label> <input type="email" id="FormCon2" class="form-control" placeholder="name@example.com"> </div>',
			'url' => '<div calss="form-group"><label for="FormCon3" >Url</label> <input type="email"  id="FormCon3" class="form-control" placeholder="www.example.com"> </div>'
		),
		'comment_field' => '<div calss="form-group">
			<label for="FormCon0" class="form-label">Textarea</label>
			<textarea class="form-control" id="FormCon0" rows="3"></textarea>
		</div>',

		'title_reply' => 'Add Your Comment',
		'title_reply_to'	=>'Add a Reply To [%s]',
		'class_submit'	=>'btn btn-primary btn-md',
		'comment_notes_before'		=> ''

		
	);

	comment_form($argsform);

} else {
	echo "<p> Comments are disabled</p>";
}