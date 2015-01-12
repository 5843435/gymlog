<!--  start table-content  -->
<div id="table-content">

<!-- start product-table -->
<form id="ItemTagForm" accept-charset="utf-8" method="post" action="">
<!-- start id-form -->

<h2><?php echo $item['Item']['name'];?></h2>

<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

<th valign="top">タグ:</th>
<td>複数存在する場合はカンマで結合してください。
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
		
		
		
		<?php echo $form->end('実行'); ?>
		<!-- end id-form  -->

</div>
<!-- /content-table  -->