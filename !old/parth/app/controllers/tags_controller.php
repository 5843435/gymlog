<?php
class TagsController extends AppController {//extendsとは拡張しますよ～の意味

var $uses = array('Item','Post','Term','Taxonomy','Tag');//自分が使うmodelを配列で書きます。今回はひとつだけ
var $layout = 'layout';//レイアウト名は自由に決められる。また、レイアウトはコントローラー一つにつき、１個だけである。

//function index　これがpostsフォルダのインデックスにあたります。


function delete($id= NULL) {
	
	$this->Tags->delete($id);
	$this->redirect('/items/');//データ削除してからの画面遷移
	}

function tag_add($id=NULL) {
	
	$this->set('id',$id);
	
 if (!empty($this->data)) {
	 
	 
if ($this->Tag->save($this->data)) {
$this->redirect('/items/edit/'.$id);//情報をPOSTしてからの画面遷移
}
}
	
}




function tag_edit($id=NULL) {
	
 $this->Tag->id = $id;
if (empty($this->data)) {
$this->data = $this->Tag->read();

$this->set('id',$this->data['Tag']['item_id']);

} else {
if ($this->Tag->save($this->data['Tag'])) {
	
$this->redirect('/items/edit/'.$this->data['Tag']['item_id']);
}
}

	
}





}

?>