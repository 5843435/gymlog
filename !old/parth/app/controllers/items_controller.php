<?php
class ItemsController extends AppController {//extendsとは拡張しますよ～の意味

var $uses = array('Item','Post','Term','Taxonomy','Tag');//自分が使うmodelを配列で書きます。今回はひとつだけ

var $components = array('Config');

var $layout = 'layout';//レイアウト名は自由に決められる。また、レイアウトはコントローラー一つにつき、１個だけである。

//function index　これがpostsフォルダのインデックスにあたります。


function delete($id= NULL) {
	

	
	$this->Item->delete($id);
	$this->redirect('/items/');//データ削除してからの画面遷移
	}




function edit($id = null) {
	
$this->Config->files();	
	$con = array(
	'conditions'=>array("Tag.item_id" => $id),
	);
$tags_lists = $this->Tag->find('all',$con);
	
	
	$this->set('tags_lists',$tags_lists);
	
	$this->set('id',$id);
		
		$this->set('term',$this->Term->find('all'));
		
	$this->Item->id = $id;
	if (empty($this->data)) {
		$this->data = $this->Item->read();
		
		
//		debug($this->data);
	} else {
		if ($this->Item->save($this->data['Item'])) {
			$this->redirect('/items/');//情報をPOSTしてからの画面遷移
		}
	}
}



function index() {//$id = nullはデフォルトNullの設定です。
$this->Config->files();
if(isset($this->params['url']['data'])){
$conditions['and'] = array(
						'Item.name LIKE'=>'%' . $this->params['url']['data']. '%');
}else{
$conditions = array();	
	}


$this->Term->bindModel(
		array(
				'hasOne'=>array(
					'Taxonomy'=>array(
					'className'=>'Taxonomy',
					'conditions'=>'',
					'foreignKey'=>'term_id'
		)
		)	
		
		),false
		);



$this->Item->bindModel(
		array(
				'belongsTo'=>array(
					'Term'=>array(
					'className'=>'Term',
					'conditions'=>'',
					'foreignKey'=>'term_id',
		)
		),
		),false
		);


$this->paginate = array('recursive'=>2,
						'conditions'=>$conditions,
						'order' => array('Item.id DESC'),
						'limit'=>1000,//１ページあたりの表示件数
);

$this->set('items',$this->paginate('Item'));


//debug($this->paginate('Item'));


}

function tag_add($id=NULL) {
	$this->Config->files();
	$this->set('id',$id);
	
 if (!empty($this->data)) {
	 
	 
if ($this->Tag->save($this->data)) {
$this->redirect('/items/');//情報をPOSTしてからの画面遷移
}
}
	
}




function url() {

$simple_html_dom = $this->Config->files();//コンポーネントから、SimpleHtmlDomの呼び出し
	
include_once($simple_html_dom);

if(isset($_POST['data'])){
$html = file_get_html($_POST['data']['Item']['url']);

$category_array = array();

foreach($html->find($_POST['data']['Item']['tag']) as $key => $element){

//DMMは文字コードがEUC-JPなため、文字コードをUTF-8に変換
$str = mb_convert_encoding($element, "UTF-8", $_POST['data']['Item']['coad']);

//タグが含まれているので、タグを排除。カテゴリーのタイトルになる
$name = strip_tags($str);

//$host = parse_url($_POST['data']['Item']['url']);

$URL = $_POST['data']['Item']['path'].$element->href;


//$url = explode("=", $URL);

//$id = str_replace ('/view', '', $url[3]);

$category_array[$key]['name'] = $name;
$category_array[$key]['name_url'] = $URL;
//$category_array[$key]['id'] = $id;

}


$_SESSION['category'] = $category_array;

$this->set('category_array',$category_array);

}

}


function add(){
$this->Config->files();
if(!isset($_SESSION['category']) || empty($_SESSION['category'])){
$this->redirect('/parth/items/url/');
}

$date = date('Y-m-d H:i:j');

$categories = $_SESSION['category'];

foreach($categories as $category){
$sql=<<< EOF
INSERT INTO `items` (
`id` ,
`name` ,
`url` ,
`created` ,
`modified` ,
`count`
)
VALUES (
NULL , "{$category['name']}","{$category['name_url']}", "{$date}", "{$date}", "0"
);
EOF;


/*
$con = array(
	'order' => array('Item.id desc'),
	);
$item = $this->Item->find('first',$con);


$sql2=<<< EOF
INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
("{$item['Item']['id']}", "{$category['name']}", "{$category['name_encode']}", 0)
EOF;


$sql3=<<< EOF
INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`,`term_id`, `taxonomy`, `description`) VALUES
("{$item['Item']['id']}","{$item['Item']['id']}", "category","{$category['name']}")
EOF;
*/

$this->Item->query($sql);

}

$this->redirect('/items/');//データ削除してからの画面遷移

}



function items_add(){
$this->Config->files();	
	//	$this->set('tags_lists',$tags_lists);
	
	//$this->set('id',$id);
		
		$this->set('term',$this->Term->find('all'));
	
if (!empty($this->data)) {          
	if ($this->Item->save($this->data)) {                
$this->redirect('/items/');
		}
	}	
}


function submit($id = NULL){

$simple_html_dom = $this->Config->files();//コンポーネントから、SimpleHtmlDomの呼び出し
	
include_once($simple_html_dom);



$this->Term->bindModel(
		array(
				'hasOne'=>array(
					'Taxonomy'=>array(
					'className'=>'Taxonomy',
					'conditions'=>'',
					'foreignKey'=>'term_id'
		)
		)	
		
		),false
		);



$this->Item->bindModel(
		array(
				'belongsTo'=>array(
					'Term'=>array(
					'className'=>'Term',
					'conditions'=>'',
					'foreignKey'=>'term_id',
		)
		),
		),false
		);

$con = array(
'recursive'=>2,
	'conditions'=>array("Item.id" => $id),
	);
$item = $this->Item->find('first',$con);



$tag_con = array(
	'conditions'=>array("Tag.item_id" => $id),
	);
$tags = $this->Tag->find('all',$tag_con);


debug($item);


$html = file_get_html($item['Item']['url']);

/**
以下URLが全部で何ページあるかを取得する処理
**/
//$MainTable = $html->find('#main-ds table',1);

//$num = $MainTable->find('b', 3)->plaintext;

//debug($num);


debug($item);


//商品のURLを取得

$html = file_get_html($item['Item']['url']);
	
$href = $html->find($item['Item']['tag']);

//取得URLをソート逆順に指定
$href = array_reverse($href, true);

$post_array = array();

foreach($href as $key => $element){

//取得したURLを、フルパス形式のURLにしないとスクレイピングできない

//詳細ページのURL
$url = $item['Item']['full_path'].$element->href;

//タグを取り除いて、Wordpressの記事タイトルにする
$title = strip_tags($element);

//文字コード変換
$title = mb_convert_encoding($title, "UTF-8", $item['Item']['encode']);

/**
****
以下商品ページのスクレイピング
****
**/
$detail = file_get_html($url);

//debug($url);

//パッケージ画像取得
//$image = $detail->find('table.mg-b12 #sample-video img',0);

//取得したファイルのパッケージ画像を取得
//$data = file_get_contents($image->src);

//取得したファイルのパッケージ画像を自分のサーバーへ保存
//file_put_contents('/home/anime.kaasan.biz/public_html/wordpress/dmm/'.$item['Item']['val'].'/'.$goods_id.'.jpg',$data);

//記事にパッケージ画像を表示するためのHTMLタグ
//$img = '<img src="/dmm/'.$item['Item']['val'].'/'.$goods_id.'.jpg'.'">';


//商品の説明テキスト
$text = $detail->find($item['Item']['tag2'], 0)->innertext;


//テキスとの文字コードdiv[id=center_contents]
$text = mb_convert_encoding($text, "UTF-8", $item['Item']['encode']);

//WordPressの記事本文。改行とaタグのみを許可
$text = strip_tags($text, '<br><br/><a>');

//取得した日時。Wordpressにも日時を保存するため
$date = date('Y-m-d H:i:s');


//debug($text);

//debug($url);

$con3 = array(
	'conditions'=>array("Post.val" => $url),
	);
$goods = $this->Post->find('first',$con3);

//debug($goods);

if(empty($goods)){

$sql=<<< EOF
INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`, `val`, `item_id`) VALUES
(1, '{$date}', '{$date}', '<p>{$text}<p>', '{$title}', '', 'publish', 'open', 'open', '', 'test', '', '', '{$date}', '{$date}', '', 0, 0, 'post', '', 0, '{$url}', "{$item['Item']['id']}")
EOF;
$this->Post->query($sql);

//
$con2 = array(
	'order' => array('Post.ID desc'),
	);
$LastInset = $this->Post->find('first',$con2);

$sql2=<<< EOF
INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`) VALUES
("{$LastInset['Post']['ID']}", "{$item['Term']['Taxonomy']['term_taxonomy_id']}")
EOF;

debug($item['Term']['Taxonomy']['term_id']);
 
$this->Post->query($sql2);


debug($url);

foreach($tags as $tag){
$tag_text = $detail->find($tag['Tag']['tag'], 0);	

$tag_text = mb_convert_encoding($tag_text, "UTF-8", $item['Item']['encode']);

$tag_text = strip_tags($tag_text);

$search = array(' ','　','&nbsp;');
$tag_text = str_replace($search,'',$tag_text);


	
	$tag_sql=<<< EOF
INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES
("{$LastInset['Post']['ID']}", "{$tag['Tag']['name']}", "{$tag_text}")
EOF;
$this->Post->query($tag_sql);	
	
	}


}else{

$sql=<<< EOF
UPDATE `wp_posts` SET `post_content` = '<p>{$text}<p>',`post_title` = '{$title}',`post_modified` = '{$date}',`post_modified_gmt` = '{$date}' WHERE `wp_posts`.`val` = '{$url}';
EOF;

	
$this->Post->query($sql);

$con3 = array(
	'conditions'=>array("Post.val" => $url),
	);
	
$PostData = $this->Post->find('first',$con3);


}





}



$sql7=<<< EOF
SELECT COUNT(*) FROM wp_term_relationships WHERE `term_taxonomy_id` = "{$item['Item']['term_id']}";
EOF;

$cont = $this->Post->query($sql7);



$sql8=<<< EOF
UPDATE `wp_term_taxonomy` SET `count` = "{$cont[0][0]['COUNT(*)']}" WHERE `wp_term_taxonomy`.`term_taxonomy_id` = "{$item['Item']['term_id']}";
EOF;


$this->Post->query($sql8);


$count_sql=<<< EOF
SELECT COUNT(*) FROM wp_posts WHERE `item_id` = "{$item['Item']['id']}";
EOF;

$counts = $this->Post->query($count_sql);



$count_set_sql=<<< EOF
UPDATE `items` SET `count` = "{$counts[0][0]['COUNT(*)']}" WHERE `id` = "{$item['Item']['id']}";
EOF;

$this->Post->query($count_set_sql);



$this->redirect('/items/');//情報をPOSTしてからの画面遷移

}



function submit_all($id = NULL){

$simple_html_dom = $this->Config->files();//コンポーネントから、SimpleHtmlDomの呼び出し
	
include_once($simple_html_dom);



$this->Term->bindModel(
		array(
				'hasOne'=>array(
					'Taxonomy'=>array(
					'className'=>'Taxonomy',
					'conditions'=>'',
					'foreignKey'=>'term_id'
		)
		)	
		
		),false
		);



$this->Item->bindModel(
		array(
				'belongsTo'=>array(
					'Term'=>array(
					'className'=>'Term',
					'conditions'=>'',
					'foreignKey'=>'term_id',
		)
		),
		),false
		);
/*
$con = array(
'recursive'=>2,
	'conditions'=>array("Item.id" => $id),
	);
$item = $this->Item->find('first',$con);
*/

$item_all = $this->Item->find('all');

foreach($item_all as $item){
	
	$id = $item['Item']['id'];
	
	


$tag_con = array(
	'conditions'=>array("Tag.item_id" => $id),
	);
$tags = $this->Tag->find('all',$tag_con);


debug($item);


$html = file_get_html($item['Item']['url']);

/**
以下URLが全部で何ページあるかを取得する処理
**/
//$MainTable = $html->find('#main-ds table',1);

//$num = $MainTable->find('b', 3)->plaintext;

//debug($num);





//商品のURLを取得

$html = file_get_html($item['Item']['url']);
	
$href = $html->find($item['Item']['tag']);

//取得URLをソート逆順に指定
$href = array_reverse($href, true);

$post_array = array();

foreach($href as $key => $element){

//取得したURLを、フルパス形式のURLにしないとスクレイピングできない

//詳細ページのURL
$url = $item['Item']['full_path'].$element->href;

//タグを取り除いて、Wordpressの記事タイトルにする
$title = strip_tags($element);

//文字コード変換
$title = mb_convert_encoding($title, "UTF-8", $item['Item']['encode']);

/**
****
以下商品ページのスクレイピング
****
**/
$detail = file_get_html($url);

//debug($url);

//パッケージ画像取得
//$image = $detail->find('table.mg-b12 #sample-video img',0);

//取得したファイルのパッケージ画像を取得
//$data = file_get_contents($image->src);

//取得したファイルのパッケージ画像を自分のサーバーへ保存
//file_put_contents('/home/anime.kaasan.biz/public_html/wordpress/dmm/'.$item['Item']['val'].'/'.$goods_id.'.jpg',$data);

//記事にパッケージ画像を表示するためのHTMLタグ
//$img = '<img src="/dmm/'.$item['Item']['val'].'/'.$goods_id.'.jpg'.'">';


//商品の説明テキスト
$text = $detail->find($item['Item']['tag2'], 0)->innertext;


//テキスとの文字コードdiv[id=center_contents]
$text = mb_convert_encoding($text, "UTF-8", $item['Item']['encode']);

//WordPressの記事本文。改行とaタグのみを許可
$text = strip_tags($text, '<br><br/><a>');

//取得した日時。Wordpressにも日時を保存するため
$date = date('Y-m-d H:i:s');


//debug($text);

//debug($url);

$con3 = array(
	'conditions'=>array("Post.val" => $url),
	);
$goods = $this->Post->find('first',$con3);

//debug($goods);

if(empty($goods)){

$sql=<<< EOF
INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`, `val`, `item_id`) VALUES
(1, '{$date}', '{$date}', '<p>{$text}<p>', '{$title}', '', 'publish', 'open', 'open', '', 'test', '', '', '{$date}', '{$date}', '', 0, 0, 'post', '', 0, '{$url}', "{$item['Item']['id']}")
EOF;
$this->Post->query($sql);

//
$con2 = array(
	'order' => array('Post.ID desc'),
	);
$LastInset = $this->Post->find('first',$con2);

$sql2=<<< EOF
INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`) VALUES
("{$LastInset['Post']['ID']}", "{$item['Term']['Taxonomy']['term_taxonomy_id']}")
EOF;

debug($item['Term']['Taxonomy']['term_id']);
 
$this->Post->query($sql2);


debug($url);

foreach($tags as $tag){
$tag_text = $detail->find($tag['Tag']['tag'], 0);	

$tag_text = mb_convert_encoding($tag_text, "UTF-8", $item['Item']['encode']);

$tag_text = strip_tags($tag_text);

$search = array(' ','　','&nbsp;');
$tag_text = str_replace($search,'',$tag_text);


	
	$tag_sql=<<< EOF
INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES
("{$LastInset['Post']['ID']}", "{$tag['Tag']['name']}", "{$tag_text}")
EOF;
$this->Post->query($tag_sql);	
	
	}


}else{

$sql=<<< EOF
UPDATE `wp_posts` SET `post_content` = '<p>{$text}<p>',`post_title` = '{$title}',`post_modified` = '{$date}',`post_modified_gmt` = '{$date}' WHERE `wp_posts`.`val` = '{$url}';
EOF;

	
$this->Post->query($sql);

$con3 = array(
	'conditions'=>array("Post.val" => $url),
	);
	
$PostData = $this->Post->find('first',$con3);


}





}



$sql7=<<< EOF
SELECT COUNT(*) FROM wp_term_relationships WHERE `term_taxonomy_id` = "{$item['Item']['term_id']}";
EOF;

$cont = $this->Post->query($sql7);



$sql8=<<< EOF
UPDATE `wp_term_taxonomy` SET `count` = "{$cont[0][0]['COUNT(*)']}" WHERE `wp_term_taxonomy`.`term_taxonomy_id` = "{$item['Item']['term_id']}";
EOF;


$this->Post->query($sql8);


$count_sql=<<< EOF
SELECT COUNT(*) FROM wp_posts WHERE `item_id` = "{$item['Item']['id']}";
EOF;

$counts = $this->Post->query($count_sql);



$count_set_sql=<<< EOF
UPDATE `items` SET `count` = "{$counts[0][0]['COUNT(*)']}" WHERE `id` = "{$item['Item']['id']}";
EOF;

$this->Post->query($count_set_sql);



$this->redirect('/items/');//情報をPOSTしてからの画面遷移

}

}


function search(){
	
	$conditions['and'] = array(
						'Item.name LIKE'=>'%' . $this->params['url']['data']. '%');
	
	}



}

?>