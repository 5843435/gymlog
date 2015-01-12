<!--  start table-content  -->
<div id="table-content">

<!-- start product-table -->
<?php echo $form->create('Item', array('type' => 'Post')); ?>
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
        
<tr>
<th valign="top">文字コード:</th>
<td>
                 
                             <?php
			$encode = array('SJIS'=>'SJIS', 'EUC-JP'=>'EUC-JP','UTF-8'=>'UTF-8');
			$options = array('showParents' => true);
			echo $form->select('coad', $encode, null, $options, '選択してください');
			?>
			</td>
			<td></td>
		</tr>
        
        
<tr>
<th valign="top">パス:</th>
<td>
			<?php echo $form->input('path',array(
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
		
		
		
		<?php echo $form->end('OK'); ?>
		<!-- end id-form  -->

		
<div>
		<?php if(!empty($_POST['data'])):?>
		<?php foreach($category_array as $array):?>
		<table>
		<tr>
		<th>名前</th><td><?php echo $array['name'];?></td>
		</tr>
		<tr>
		</tr>
		<tr>
		<th>URL</th><td><?php echo $array['name_url'];?></td>
		</tr>
		
		</table>
		<?php endforeach;?>
</div>
		
	<a href="/parth/items/add/"><input type="button" value="登録"></a>

		<?php endif;?>


</div>
<!-- /content-table  -->