<br>
<div id="comments" class="comments">
  <img id="commentImg" src="res/msg.png" width="30" height="30">
  <h3>Comments</h3>
  <div class="commentList">
    <?php foreach ($comments as $comment) { ?>
        <div class="comment">
          <p class="text"><?=$comment['commentContent']?></p>
          <div class="authorNtime">Written by <a id="userRef" href="./?user=<?=$comment['username']?>"><?=$comment['username']?></a>  on <?=$comment['time']?></div>
        </div><br>
        <?php } if(count($comments)==0){ ?>
          <p class="noComments">No comments so far...</p>
          <?php } ?>
  </div>
      <div id="new_comment">
          <textarea name="commentContent"  placeholder="Leave a comment..." /></textarea>
          <br>
          <button id="addComment" type="button" onclick="addCommentToEvent('<?=$_SESSION['username']?>', <?=$event['id']?>)">Add comment</button>
      </div>
</div>
