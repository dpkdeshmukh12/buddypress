<?php
/**
 * Template Name: Manage Task Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
wp_enqueue_script('jquery-ui-datepicker');
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri().'/css/jquery-ui.min.css'; ?>" type="text/css" />
<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="post-0" class="bp_activity type-bp_activity post-0 status-publish hentry">	
			<header class="entry-content">
				<form  action="<?php $_SERVER["PHP_SELF"];?>" method="post">
					<table>
						<tr><td>Task Title</td><td><input type="text" name="task_title" /></td></tr>
						<tr><td>Task Description</td><td><textarea name="task_description"></textarea></td></tr>
						<tr>
						<?php
							global $wpdb;
							$user_id = get_current_user_id(); 
							$current_user_data = get_userdata( $user_id ); 
							if(isset($_POST["submit_task"])){
								if(!empty($_POST["task_title"]) && !empty($_POST["task_description"]) && !empty($_POST["task_assign_to"]) && !empty($_POST["task_end_date"])){
									$task_title = $_POST["task_title"];
									$task_description = $_POST["task_description"];
									$task_assign_to = $_POST["task_assign_to"];
									$task_end_date = $_POST["task_end_date"];

									// Create post object
									$post_args = array(
									  'post_title'    => $task_title,
									  'post_content'  => $task_description,
									  'post_status'   => 'publish',
									  'post_author'   => $user_id,
									  'post_type' => 'task'
									);

									// Insert the post into the database
									$created_post_id = wp_insert_post( $post_args );
									update_post_meta($created_post_id, "task_assign_to", $task_assign_to);
									update_post_meta($created_post_id, "task_end_date", $task_end_date);
									update_post_meta($created_post_id, "task_status", 0);
									echo "Task Added Successfully";
								} else {
									echo "Blank inputs provided cannot create Task";
								}
								
							}

							$friend_list = $wpdb->get_results("SELECT * FROM wp_bp_friends WHERE (friend_user_id = ".$user_id." || initiator_user_id = ".$user_id.") && is_confirmed = 0");
							$friend_list_array = array();
							foreach ( $friend_list as $friend ) {
								if($friend->initiator_user_id == $user_id ){
									array_push($friend_list_array, $friend->friend_user_id);
								} elseif($friend->friend_user_id == $user_id) {
									array_push($friend_list_array, $friend->initiator_user_id);
								}
								
							}					
						
							$args = array(
								'include' => $friend_list_array,
							 );
							$friend_users_data = get_users( $args );
						?>
							<td>Assign to</td>
							<td>
								<select name="task_assign_to">
									<?php
										foreach($friend_users_data as $user){
											echo '"<option value="'.$user->ID.'">'.$user->user_login.'</option>"';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Should Be Completed Till</td>
							<td><input type="text" name="task_end_date" id="end_date"/></td>
						</tr>
						<tr>
							<td colspan="2"><button type="submit" name="submit_task" value="Submit" class="btn btn-primary">Submit Task</button></td>
						</tr>
					</table>
				 </form>
				</header>
				<br/><br />
				<div class="entry-content">
				<div id="buddypress">
				<div class="activity" role="main">
				<ul id="activity-stream" class="activity-list item-list">
					<?php
						$args = array(
							'posts_per_page'   => 5,
							'author' => $user_id,
							'post_type'        => 'task',
							'post_mime_type'   => '',
							'post_parent'      => '',
							'post_status'      => 'publish',
							'suppress_filters' => true 
						);
						$myposts = get_posts( $args );
						
						foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
							<li class="activity activity_update activity-item has-comments date-recorded-1430611988" id="activity-<?php echo $post->ID; ?>">
								<div class="activity-content">
									<div class="activity-header">
										<p><a href="#" title="<?php echo $current_user_data->user_login;?>"><?php echo "<b>".$current_user_data->user_login."</b>";?></a> created a task on <span class="time-since"><?php echo get_the_date(); ?></span> assigned to <span><?php $post_user_data = get_userdata( get_post_meta($post->ID,"task_assign_to",1) ); echo "<b>".$post_user_data->user_login."</b>"; ?></span></p>
									</div>
									<div class="activity-inner">
										<b><?php the_title(); ?></b>
										<p><?php the_content(); ?></p>
									</div>
									<div class="activity-meta">
										<?php 
										$date = new DateTime(get_post_meta($post->ID,"task_end_date",1));
										//echo $date->format('Y-m-d H:i:s');
										echo "End Date : ".$date->format('d M, Y'); ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
				</ul></div>
				</div>
				</div>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#end_date').datepicker({
        dateFormat : 'dd-mm-yy',
        minDate: 0
    });
});
</script>

<?php
get_sidebar();
get_footer();
