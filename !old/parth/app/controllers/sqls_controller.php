<?php
class SqlsController extends AppController {//extendsとは拡張しますよ～の意味

var $uses = array('Post');//自分が使うmodelを配列で書きます。今回はひとつだけ
var $layout = 'layout';//レイアウト名は自由に決められる。また、レイアウトはコントローラー一つにつき、１個だけである。

//function index　これがpostsフォルダのインデックスにあたります。



function index() {
	
$sql1 = <<< DOC_END
	CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag2` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `encode` varchar(255) DEFAULT 'UTF-8',
  `full_path` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `count` (`count`),
  KEY `term_id` (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
DOC_END;
	

$sql2 = <<< DOC_END
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
DOC_END;

$sql3 = <<< DOC_END
ALTER TABLE  `wp_posts` ADD  `val` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD INDEX (`val`);
DOC_END;

$sql4 = <<< DOC_END
ALTER TABLE  `wp_posts` ADD  `item_id` INT NULL ,
ADD INDEX (  `item_id` );
DOC_END;

$sql5 = <<< DOC_END
ALTER IGNORE TABLE wp_posts ADD UNIQUE (
val
);
DOC_END;

$this->Post->query($sql1);
$this->Post->query($sql2);
$this->Post->query($sql3);
$this->Post->query($sql4);
$this->Post->query($sql5);

$this->redirect('/items/');

	
}





}

?>