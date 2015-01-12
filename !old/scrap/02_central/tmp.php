<?php


$tag = '<a href="/club/kotoni/index.html" target="_blank">セントラルウェルネスクラブ琴似</a><BR>';
$tag = mb_substr($tag, 15);
echo mb_substr($tag, 0, strpos($tag,'/'));

