<div class="comments">
  <h3>Comments:</h3>
  <div class="commentList">
    <?php foreach ($comments as $comment) { ?>
        <div class="comment">
          <p class="text"><?=$comment['commentContent']?></p>
          <div class="author">Written by: <?=$comment['username']?></div><br />
          <div class="time">Time: <?=$comment['time']?></div><br />
        </div>
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
