<?php include('includes/header.php'); ?>

<ul id="topics">
    <!-- main topic starts -->
    <li id="main-topic" class="topic topic">
	   <div class="row">
           <div class="col-md-2">      								
               <div class="user-info" >										
                   <img class="avatar pull-right" src="templates/images/avatars/<?php echo $topic->avatar?>"/>                   							
                   <ul>					
                       <li><strong><?php echo $topic->username; ?></strong></li>						
                        <li><?php echo userPostCount($topic->user_id); ?> posts</li>						
                       <li><a href="<?php echo BASE_URI; ?>/topic.php?user=<?php echo $topic->user_id; ?>">View Posts</a></li>						
                   </ul>					
               </div>				
           </div>			
           <div class="col-md-10">			
               <div class="topic-content pull-right">				
                   <p>                   
                       <?php echo $topic->body; ?>						
                   </p>					
               </div>
           </div>			
        </div>	
    </li>
    <!--main topic ends-->
    <!--replies start -->
<?php foreach($replies as $reply): ?>
    <li  class="topic topic">	
        <div class="row">							
            <div class="col-md-2">						
                <div class="user-info" >								
                    <img class="avatar pull-right" src="templates/images/avatars/<?php echo $reply->avatar; ?>"/>					
                    <ul>					
                        <li><strong><?php echo $reply->username; ?></strong></li>						
                        <li><?php echo userPostCount($topic->user_id); ?> posts</li>						
                        <li><a href="<?php echo BASE_URI; ?>/topic.php?user=<?php echo $reply->user_id; ?>">View Posts</a></li>						
                    </ul>					
                </div>				
            </div>			
            <div class="col-md-10">			
                <div class="topic-content pull-right">				
                    <p>
                        <?php echo $reply->body; ?>
                    </p>					
                </div>				
            </div>			
        </div>		
    </li>
    <?php endforeach; ?>
    <!--replies start -->													
</ul>

<h3>Reply To Topic</h3>
<?php if(isLoggedIn()): ?>
<form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
    <div class="form-group">	
        <textarea id="reply" rows="10" cols="80" class="form-control" name="body"></textarea>		
        <script>CKEDITOR.replace('reply');</script>		
    </div>	
    <button name="do_reply" type="submit" class="btn btn-primary">Submit</button>	
</form>
<?php else: ?>
    <p>Please Login to reply.</p>
<?php endif; ?>
<?php include('includes/footer.php'); ?>	