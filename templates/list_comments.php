<div class="comments">
  <h3>Comments</h3>
  <?php foreach ($comments as $comment) { ?>
      <div class="comment">
        <p class="text"><?=$comment['commentContent']?></p>
        <p class="author">Written by: <?=$comment['username']?></p>
        <p class="time">Time: <?=$comment['time']?></p>
      </div>
  <?php } ?>
</div>
