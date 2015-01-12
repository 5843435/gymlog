<p><a href="/parth/tags/tag_add/<?php echo $id;?>/">カスタムフィールドの登録</a></p>

<ul>
<?php foreach($tags_lists as $tags_list):?>
<li><a href="/parth/tags/tag_edit/<?php echo $tags_list['Tag']['id'];?>"><?php echo $tags_list['Tag']['name'];?></a></li>
<?php endforeach;?>
</ul>
<?php echo $form->create('Item', array('type' => 'Post')); ?>

<table border="0" cellpadding="0" cellspacing="0"  id="id-form">


		<tr>
			<th valign="top">テーマ(カテゴリー):</th>
			<td>
			<SELECT name="data[Item][term_id]">
<OPTION value="">選択してください</OPTION>
<?php foreach($term as $categories):?>
<?php 
//編集中データのid($this->data['Items']['category_id'])が、ループ中の$category['Term']['id']と一緒なら、selectedにする
if($categories['Term']['term_id']==$this->data['Item']['term_id']):?>
<OPTION value="<?php echo $categories['Term']['term_id'];?>" selected="selected"><?php echo $categories['Term']['name'];?></OPTION>
<?php else:?>
<OPTION value="<?php echo $categories['Term']['term_id'];?>"><?php echo $categories['Term']['name'];?></OPTION>
<?php endif;?>
<?php endforeach;?>

</SELECT>



			</td>
			<td></td>
		</tr>

        

		<tr>
			<th valign="top">名称:</th>
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
			<th valign="top">タグ2:</th>
			<td>
            <p>WordPressのテキスト部分</p>
			<?php echo $form->input('tag2',array(
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
			<th valign="top">フルパス:</th>
			<td>
			<?php echo $form->input('full_path',array(
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
			<th valign="top">エンコード指定:</th>
			<td>
<p>スクレイピング元のサイトの文字コードを指定します</p>
            <?php
			$encode = array('SJIS'=>'SJIS', 'EUC-JP'=>'EUC-JP','UTF-8'=>'UTF-8');
			$options = array('showParents' => true);
			echo $form->select('Item.encode', $encode, null, $options, '選択してください');
			?>
			</td>
			<td></td>
		</tr>
        
        
		

		</table>
		<?php echo $form->end('登録'); ?>