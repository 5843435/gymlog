<div id='pagination'>
<?php echo $paginator->prev('<< '.__('戻る', true),
    array(),
    null,
    array('class'=>'disabled', 'tag' => 'span')
); ?>
 |
<?php echo $paginator->numbers().
' | '.
$paginator->next(__('次', true).' >>', array(), null, array('tag' => 'span', 'class' => 'disabled'));
?>
</div>
