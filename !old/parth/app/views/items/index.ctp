<div class="formBox">
<form action="" method="get">
<input name="data" type="text" />
<input type="submit" value="検索" />
</form>
</div>


<p><?php echo $paginator->counter(array(
   'format' => '%start% ～ %end%件(全%count%件)'));
  ?></p>
<?php echo $this->element('paginator');?>

<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

<tr>
<th valign="top">id:</th>
<th valign="top">URL:</th>
<th valign="top">名前:</th>
<th valign="top">カテゴリー:</th>
<th valign="top">件数:</th>
<th valign="top">スクレイピング実行:</th>
</tr>
<?php foreach($items as $item):?>
<tr>
<td><?php echo $item['Item']['id'];?></td>
<td><?php echo $item['Item']['url'];?></td>
<td><?php echo $item['Item']['name'];?></td>
<td><?php echo $item['Term']['name'];?></td>
<td>
<?php echo $item['Item']['count'];?>
</td>
<td><a onclick="return confirm('削除してもよろしいですか？')" href="/parth/items/delete/<?php echo $item['Item']['id'];?>/">削除</a>｜<a href="/parth/items/edit/<?php echo $item['Item']['id'];?>/">編集</a>｜<a href="/parth/items/submit/<?php echo $item['Item']['id'];?>/">実行</a></td>
</tr>
<?php endforeach;?>
</table>