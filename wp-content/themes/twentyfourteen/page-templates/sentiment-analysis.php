<?php
/**
 * Template Name: Sentiment Analysis Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
//include nlp liabrary
require_once __DIR__ . '\nlp\autoload.php';
$sentiment = new \PHPInsight\Sentiment();
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="post-0" class="bp_activity type-bp_activity post-0 status-publish hentry">	
			<header class="entry-content">
			<div id="buddypress">
			<div class="activity" role="main">
			<ul id="activity-stream" class="activity-list item-list">
			<?php
				$blogusers = get_users( 'role=candidate' );
				$user_list_array = array();
				// Array of WP_User objects.
				foreach ( $blogusers as $user ) {
					array_push($user_list_array, $user->ID);
					//echo '<span>' . esc_html( $user->ID ) . '</span>';
				}
				global $wpdb;
				$activity_list = $wpdb->get_results("SELECT * FROM wp_bp_activity WHERE (type = 'activity_update') AND user_id IN ('". implode("','",$user_list_array) ."')");
				
				foreach ( $activity_list as $activity ) {
					?>
					
					<li class="activity activity_update activity-item has-comments date-recorded-1430611988" id="activity-<?php echo $activity->id;?>">
						<div class="activity-avatar">
							<a href="http://localhost/buddypress/members/test1/">

								<img src="http://gravatar.com/avatar/245cf079454dc9a3374a7c076de247cc?d=mm&amp;s=50&amp;r=G" class="avatar user-3-avatar avatar-50 photo" alt="Profile picture of test1 test1" height="50" width="50">
							</a>
						</div>

						<div class="activity-content">

							<div class="activity-header">

								<p><?php echo $activity->action;?> posted an update <a href="http://localhost/buddypress/activity/p/22/" class="view activity-time-since" title="View Discussion"><span class="time-since">1 hour, 34 minutes ago</span></a></p>

							</div>

							
								<div class="activity-inner">

									<p><?php echo $activity->content;?></p>

								</div>

							
							
							<?php /* ?><div class="activity-meta">

								
								
									
										<a href="?ac=22/#ac-form-22" class="button acomment-reply bp-primary-action" id="acomment-comment-22">Comment <span>3</span></a>

									
									
										
											<a href="http://localhost/buddypress/activity/favorite/22/?_wpnonce=4520b3c005" class="button fav bp-secondary-action" title="Mark as Favorite">Favorite</a>

										
									
									<a href="http://localhost/buddypress/activity/delete/22/?_wpnonce=7bcc888f23" class="button item-button bp-secondary-action delete-activity confirm" rel="nofollow">Delete</a>
									            <a href="#" class="button like" id="like-activity-22" title="Like this item">Like</a>
					        
								
							</div><?php */ ?>
						<?php
							//get comment list
							$comment_list = $wpdb->get_results("SELECT * FROM wp_bp_activity WHERE type = 'activity_comment' AND item_id = ". $activity->id."");
							$comment_nlp_input = array();
							foreach ($comment_list as $comment) {
								array_push($comment_nlp_input, $comment->content);
							}
							$comment_nlp_report = array();
							foreach ($comment_nlp_input as $string) {

								// calculations:
								$scores = $sentiment->score($string);
								$class = $sentiment->categorise($string);

								array_push($comment_nlp_report,$class);
								// output:
								/*echo "String: $string\n";
								echo "Dominant: $class, scores: ";
								print_r($scores);
								echo "\n";*/
							}
							$comment_nlp_report_final = array_count_values($comment_nlp_report);
							//var_dump($comment_nlp_report_final);
							if($comment_nlp_report_final){
							$max_nlp_value = max($comment_nlp_report_final);
							$max_nlp_value_key = array_search($max_nlp_value, $comment_nlp_report_final);
							//echo '<img src="'.get_bloginfo( 'template_url' ).'/images/'.$max_nlp_value_key.'-png.png" width="30" height="30" title="'.$max_nlp_value_key.'" />';
							//echo $max_nlp_value_key;
								if($max_nlp_value_key == "pos") {
									echo "<b>Positive</b>";
								} elseif($max_nlp_value_key == "neg") {
									echo "<b>Negative</b>";
								} elseif($max_nlp_value_key == "neu") {
									echo "<b>Neutral</b>";
								}
							}

						?>
							<div class="activity-meta">

							</div>

						</div>

						<div class="activity-comments">

								<ul>
								<?php foreach ($comment_list as $comment) { ?>
									<li id="acomment-<?php echo $comment->id; ?>">
										<div class="acomment-avatar">
											<a href="http://localhost/buddypress/members/test1/">
												<img src="http://gravatar.com/avatar/245cf079454dc9a3374a7c076de247cc?d=mm&amp;s=50&amp;r=G" class="avatar user-3-avatar avatar-50 photo" alt="Profile picture of test1 test1" height="50" width="50">		</a>
										</div>

										<div class="acomment-meta">
											<?php echo $comment->action; ?> replied <a href="http://localhost/buddypress/activity/p/22/#acomment-23" class="activity-time-since"><span class="time-since">1 hour, 34 minutes ago</span></a>	</div>

										<div class="acomment-content"><p><?php echo $comment->content; ?></p>
									</div>

									<div class="acomment-options">

										<?php
											$class = $sentiment->categorise($comment->content);
											//echo '<img src="'.get_bloginfo( 'template_url' ).'/images/'.$class.'-png.png" width="30" height="30" title="'.$class.'" />';
											if($class == "pos") {
												echo "<b>Positive</b>";
											} elseif($class == "neg") {
												echo "<b>Negative</b>";
											} elseif($class == "neu") {
												echo "<b>Neutral</b>";
											}
										?>
											<?php /* ?><a href="#acomment-23" class="acomment-reply bp-primary-action" id="acomment-reply-22-from-23">Reply</a>

										
										
											<a href="http://localhost/buddypress/activity/delete/23?cid=23&amp;_wpnonce=7bcc888f23" class="delete acomment-delete confirm bp-secondary-action" rel="nofollow">Delete</a>

										
										            <a href="#" class="acomment-reply bp-primary-action like" id="like-activity-23" title="Like this item">Like</a>
								        <?php */ ?>
									</div>

									</li>
								<?php } // end of comment for each loop ?>
								</ul>
							</div>
					</li>

					<?php
				}
				echo "</ul>";

			?>
			</ul>
			</div>
			</div>
			</header>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
