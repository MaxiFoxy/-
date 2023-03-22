<?
include 'mysql.php';
//$product = get_query("SELECT * FROM `product`");
//$collection = get_query("SELECT * FROM `collection`");
function getComment(){
    $param = [];
    if ($_SESSION['user_email'] ){
        
    }
    $comment = get_query("SELECT comment.id, user.email, comment.comment, comment.date_time FROM comment JOIN user ON comment.user = user.id ORDER BY `date_time` DESC");
    foreach($comment as &$item){
        if ($_SESSION['user_email'] != $item['email']){
            unset($item['id']);
        }
    }
    echo json_encode($comment);
}
function addComment($session_id, $data){
    $email = FormChars($data['email']);
    $comment = FormChars($data['comment']);
    if (!$email or !$comment){
        $res = ['status'=>false,
        'err'=>'Какое то из полей не заполнено'];
        echo json_encode($res);
        exit;
    }
    $spam = get_query("SELECT `say` FROM `spam`");
    if ($spam){
        $spam = call_user_func_array('array_merge_recursive', $spam);
        if (in_array(strtolower($comment), $spam['say'])) {
            $res = ['status'=>false,
            'err'=>'Вы ввели запрещённое слово на сайте'];
            echo json_encode($res);
            exit;
        }
    }
    $user = get_query("SELECT `id` FROM `user` WHERE `email` = '".$email."'");
    if ($user == null){
        $user = query("INSERT INTO `user`(`session_id`, `email`) VALUES ('".$session_id."', '".$email."')");
    }else{
        $user = $user[0]['id'];
    }
    $comment = query("INSERT INTO `comment`(`user`, `comment`) VALUES (".$user.", '".$comment."')");
    $_SESSION['user_email'] = $email;
    $res = ['status'=>true];
    echo json_encode($res);
}
function delComment($id){
    $comment = query("DELETE FROM `comment` WHERE `comment`.`id` = $id");
    $res = ['status'=>true, 'id'=>$comment];
    echo json_encode($res);
}

function FormChars($p1) {
    return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
    }

?>