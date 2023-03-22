<?
include 'function.php';
session_start();
if(!$_SESSION['user_email']){
  $_SESSION['user_email']=Null;
}
$params = explode('/', $_GET['q']);
$session_id = session_id();
if ($params[0] === 'comment'){
  header('Content-type: application/json');
  switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    getComment();
    exit;
  case 'POST':
    $session_id = session_id();
    addComment($session_id , $_POST);
    exit;
  case 'DELETE':
    delComment($params[1]);
    exit;
  }
}
?>
<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guest books demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="/main.js"></script>
  </head>
  <body>
<div class="container">
  <div class="alert">
</div>
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Адрес почты</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Отзыв</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
  </div>
  <div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary" type="button" onclick="addComment()">Отправить</button>
  </div>
  <hr>
  <div class="comment">
</div>
</div>

  </body>
</html>