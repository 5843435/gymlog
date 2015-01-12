<!--  start table-content  -->
<div id="table-content">

<!-- start product-table -->
<?php echo $form->create('List', array('type' => 'Post','action'=>'/add/')); ?>
<!-- start id-form -->

<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

<tr>
<th valign="top">URL:</th>
<td>
			<?php echo $form->input('url',array(
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
		<?php echo $form->end('登録'); ?>
		<!-- end id-form  -->


			<!-- /paging -->



</div>
<!-- /content-table  -->