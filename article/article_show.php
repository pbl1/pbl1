<?php
// 送られてきたidを受け取る
$article_id = $_GET['article_id'];
$_SESSION['article_comment_id'] = $article_id; #セッションに入れる

// Postオブジェクトを生成する
require_once __DIR__ . '/../classes/post.php';
$post = new Post();

// 選択された記事を取り出す
$article = $post->getArticle($article_id);

// 選択された記事のコメントを抽出
$article_comments = $post->getArticlecomments($article_id);

$_SESSION['article_id'] = $article_id;
$_SESSION['details_user_id'] = $article['user_id'];
$_SESSION['likecount']=$article['like_count'];

require_once __DIR__ . '/../header.php';

require_once __DIR__ . '/a_markdown.php';
?>
<style>
  .iine_button{
    border-radius: 50%;
    border-color: rgba(240, 18, 25, 0.575);
    display: flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    background:  rgba(240, 18, 25, 0.575);
    color:  #FFF;
    text-decoration: none;
    text-align: center;
  }
  .text{
    font-size: 30;
  }
  .left{
    float:left;    
  }
</style>

<main>
  <div class="article-show">
    <div class="article-show-cover">
      <p class="article-show-user"><a href=<?= $user_php ?>?user_id=<?= $article['user_id'] ?>><?= $article['name'] ?></a></p>
      <p class="article-show-date">投稿日 <?= date('Y年m月d日', strtotime($article['creation_date'])) ?></p>
      <p class="like_button">
        <form method="POST" action="./likeupdate_db.php">
          <span><input type="submit" value="♡" class="iine_button left"></span>
          <span class="text"><?= $article['like_count'] ?></span>
        </form>
      </p>
      
    </div>
    <h1 class="article-show-title"><?= $article['title'] ?></h1>
    <div class="text-pos">
      <p class="article-text"><?= nl2br($html) ?></p>
    </div>
  </div>


""
  <div class="anser-show">
    <h1 class="comment">コメント</h1>
    <?php
    foreach ($article_comments  as  $article_comment) {
      if ($article_comment['user_id'] == $article['user_id']) {
        $author = "投稿者:";
      } else {
        $author = "";
      }
    ?>
      <div class="text-pos">
        <p class="comment-user"><a href=<?= $user_php ?>?user_id=<?= $article_comment['user_id'] ?>><?= $author, " ", $article_comment['name'] ?></a></p>
        <p class="article-show-date">投稿日 <?= date('Y年m月d日 H時i分s秒', strtotime($article_comment['posted_date'])) ?></p>
        <p class="comment-border"><?= nl2br($article_comment['comment']) ?></p>
      </div>
    <?php
    }
    ?>
  </div>

  <?php
  require_once __DIR__ . '/../article_comment/article_comment.php'
  ?>

</main>
<?php
require_once __DIR__ . '/../footer.php'
?>