<?php
require_once __DIR__ . '/../header.php';
// 送られてきたidを受け取る
$question_id = $_GET['question_id'];
$_SESSION['question_comment_id'] = $question_id; #セッションに入れる

// Postオブジェクトを生成する
require_once __DIR__ . '/../classes/post.php';
$post = new Post();
// Question_commentオブジェクトを生成する
require_once __DIR__ . '/../classes/user.php';
$question_comment_q = new Question_comment();

// 選択された質問を取り出す
$question = $post->getQuestion($question_id);


$_SESSION['question_id'] = $question_id;
$_SESSION['details_user_id'] = $question['user_id'];
$_SESSION['like_count'] = $question['like_count'];
// $_SESSION['comment_id']=$question['comment_id'];

require_once __DIR__ . '/q_markdown.php';
?>

<main>
  <div class="article-show">
    <div class="question-show-cover">
      <p class="article-show-user"><a href=<?= $user_php ?>?user_id=<?= $question['user_id'] ?>><?= $question['name'] ?></a></p>
      <p class="article-show-date">投稿日 <?= date('Y年m月d日', strtotime($question['question_date'])) ?></p>
      <p class="like_button">
      <form method="POST" action="./q_likeupdate_db.php">
        <span><input type="submit" value="♡" class="iine_button left"></span>
        <span class="text"><?= $question['like_count'] ?></span>
      </form>
      </p>

    </div>
    <h1 class="article-show-title"><?= $question['title'] ?></h1>
    <div class="text-pos">
      <p class="article-text"><?= nl2br($html) ?></p>
    </div>
  </div>

  <?php
  require_once __DIR__ . '/../question_comment/question_comment.php'
  ?>


  <div class="anser">
    <h1 class="anser-border">回答一覧</h1>
  </div>
  <?php
  $question_comments = $post->getQuestioncomments($question_id);

  foreach ($question_comments  as  $question_comment) {
    if ($question_comment['user_id'] == $question['user_id']) {
      $author = "質問者:";
    } else {
      $author = "";
    }

  ?>
    <div class="anser-show">
      <p class="comment-user"><a href=<?= $user_php ?>?user_id=<?= $question_comment['user_id'] ?>><?= $author, " ", $question_comment['name'] ?></a></p>
      <p class="article-show-date">投稿日 <?= date('Y年m月d日', strtotime($question_comment['posted_date'])) ?></p>
      <p class="comment-border"><?= nl2br($question_comment['comment']) ?></p>
    </div>
      <?php
        $comment_id=$question_comment['comment_id'];
        
        $comment_ansers_asc = $question_comment_q->getcomment_anser($comment_id);
        if($comment_ansers_asc!=""){
        foreach($comment_ansers_asc as $comment_anser_asc){
          if ($question_comment['user_id'] == $comment_anser_asc['user_id']) {
            $comment_author = "質問者:";
          } else {
            $comment_author = "";
          }
        ?>
        <div class="anser-show">
        <p class="comment-user"><a href=<?= $user_php ?>?user_id=<?= $comment_anser_asc['user_id'] ?>><?= $comment_author, " ", $comment_anser_asc['name'] ?></a></p>
        <p class="article-show-date">投稿日 <?= date('Y年m月d日', strtotime($comment_anser_asc['posted_date'])) ?></p>
        <p class="comment-border"><?= nl2br($comment_anser_asc['comment']) ?></p> 
        </div>
        
        <?php
        }
      }

        ?> <link rel="stylesheet" href="../css/article_post.css">
        <div class="comment_anser">
        <form method="POST" action="../question_comment/comment_anser_db.php">
        <input type="hidden" name="commentanser_id" value=<?= $comment_id?>>
          <input type="hidden" name="question_comment_id" value=<?= $_SESSION['question_comment_id']?>>
    
          <h1 class="comment_left">返信入力</h1>
          <textarea class="comment-text" name="comment" placeholder="質問の回答を入力" maxlength="400" required></textarea>
          <input type="submit" value="返信" class="comment_button">
        </form>
          </div> <?php
      
    }
  ?>
    



</main>
<?php
require_once __DIR__ . '/../footer.php'
?>