<?php echo $form->create('Tag', array('type' => 'Post', 'url' => '/tags/tag_add/'.$id.'/')); ?>



<table border="0" cellpadding="0" cellspacing="0"  id="id-form">


		<tr>
			<th valign="top">カスタムフィールド名</th>
			<td>
<?php echo $form->input('name',array(
	  					  'label'=> false,
                          'size' => false,
						  'div'=>false,
						  'class'=>'required',
						  'id'=>false
		         )
                 ); ?>
			</td>
			<td></td>
		</tr>

        

		<tr>
			<th valign="top">タグ:</th>
			<td>
			<?php echo $form->input('tag',array(
	  					  'label'=> false,
                          'size' => false,
						  'div'=>false,
						  'class'=>'required',
						  'id'=>false
		         )
                 ); ?>
			</td>
			<td></td>
		</tr>
		

		</table>
        <?php echo $form->input('item_id',array(
	  					  'label'=> false,
						  'value'=> $id,
                          'size' => false,
						  'div'=>false,
						  'class'=>'required',
						  'id'=>false,
						  'type'=>'hidden',
		         )
                 ); ?>
		<?php echo $form->end('登録'); ?>