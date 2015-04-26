<?php
/**
 * Template Name: Compare Template Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

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
			<header class="entry-header">
				<form  action="<?php $_SERVER["PHP_SELF"];?>" method="post">
				<div class="col-lg-4">
				<?php 
				$fields1 = $_POST['compare_user_1'];
				$args1 = array('role' => 'candidate');
				 $user_list1 = get_users( $args1 );
				 echo '<select name="compare_user_1" class="form-control">';
				 foreach($user_list1 as $key => $value){

					if (is_array($fields1)) {
						if(in_array($value->data->ID, $fields1)){
							$selected = " selected='selected' ";
						}else{
							$selected = "";
						}
					} else {
						if($value->data->ID == $fields1){
							$selected = " selected='selected' ";
						}else{
							$selected = "";
						}
					}
					echo '<option value="'.$value->data->ID.'" '.$selected.'>'.$value->data->display_name.'</option>';
				 }
				 echo "</select>";
				 ?>
				 </div>
				 <div class="col-lg-2">
				 <p><span class="badge" style="margin-top: 8px;">Compare With</span></p>
				 </div>
				 <div class="col-lg-4">
				<?php 
				$fields2 = $_POST['compare_user_2'];
				$args2 = array('role' => 'candidate');
				$user_list2 = get_users( $args2 );
				 echo '<select name="compare_user_2" class="form-control">';
				 foreach($user_list2 as $key => $value){
					//var_dump($value->data);
					if (is_array($fields2)) {
						if(in_array($value->data->ID, $fields2)){
							$selected = " selected='selected' ";
						}else{
							$selected = "";
						}
					} else {
						if($value->data->ID == $fields2){
							$selected = " selected='selected' ";
						}else{
							$selected = "";
						}
					}
					echo '<option value="'.$value->data->ID.'" '.$selected.'>'.$value->data->display_name.'</option>';
				 }
				 echo "</select>";
				 ?>
				 </div>
				 <br /><br/>
				 <div class="col-lg-2">
				 <button type="submit" value="Compare" class="btn btn-primary">Compare</button>
				 </div>
				 </form>
				</header>
				<br/><br />
				<div class="entry-content">
				<?php 
				if(!empty($fields1) && !empty($fields2)) {
				if(!empty($fields1) && !empty($fields2) && ( $fields1 != $fields2 ) ){ 
				$args1 = array('role' => 'candidate','include'=>$fields1.", ".$fields2);
				$user_list1 = get_users( $args1 );
				?>
				<div class="row">
					<div class="col-lg-12">
						<?php
						$user_data_into_array = array();
						foreach($user_list1 as $key => $value)
						{	
							array_push($user_data_into_array,$value->data);
						}
						
						$user_compare1_id = $user_data_into_array[0]->ID;
						$user_compare2_id = $user_data_into_array[1]->ID;
						?>
						<table class="table table-hover table-bordered">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>
								<?php echo get_avatar( $user_compare1_id, 64 ); ?>
								<h3><?php echo bp_profile_field_data( 'field=First Name&user_id='.$user_compare1_id )."  ".bp_profile_field_data( 'field=Last Name&user_id='.$user_compare1_id ); ?></h3>
							  </th>
							  <th>
								<?php echo get_avatar( $user_compare2_id, 64 ); ?>
								<h3><?php echo bp_profile_field_data( 'field=First Name&user_id='.$user_compare2_id )."  ".bp_profile_field_data( 'field=Last Name&user_id='.$user_compare2_id ); ?></h3>
							  </th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row">Party</th>
							  <td><?php echo bp_profile_field_data( 'field=Party&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Party&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">District</th>
							  <td><?php echo bp_profile_field_data( 'field=Select Destrict&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Select Destrict&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Region</th>
							  <td><?php echo bp_profile_field_data( 'field=Select Region&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Select Region&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Education</th>
							  <td><?php echo bp_profile_field_data( 'field=Education&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Education&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Age</th>
							  <td><?php echo bp_profile_field_data( 'field=Age&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Age&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Date of Birth</th>
							  <td><?php echo bp_profile_field_data( 'field=Date of Birth&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Date of Birth&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Address</th>
							  <td><?php echo bp_profile_field_data( 'field=Address&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Address&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Home Town</th>
							  <td><?php echo bp_profile_field_data( 'field=Home Town&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Home Town&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Self Profession</th>
							  <td><?php echo bp_profile_field_data( 'field=Self Profession&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Self Profession&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Family Details</th>
							  <td><?php echo bp_profile_field_data( 'field=Family Details&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Family Details&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Criminal Info</th>
							  <td><?php echo bp_profile_field_data( 'field=Criminal Info&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Criminal Info&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Assets</th>
							  <td><?php echo bp_profile_field_data( 'field=Assets&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Assets&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Constituency</th>
							  <td><?php echo bp_profile_field_data( 'field=Constituency&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Constituency&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Previous Designation</th>
							  <td><?php echo bp_profile_field_data( 'field=Previous Designation&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Previous Designation&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Work Done</th>
							  <td><?php echo bp_profile_field_data( 'field=Work Done&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Work Done&user_id='.$user_compare2_id ); ?></td>
							</tr>
							<tr>
							  <th scope="row">Future plans</th>
							  <td><?php echo bp_profile_field_data( 'field=Future plans&user_id='.$user_compare1_id ); ?></td>
							  <td><?php echo bp_profile_field_data( 'field=Future plans&user_id='.$user_compare2_id ); ?></td>
							</tr>
						  </tbody>
						</table>
	
					</div>
				</div>
				<?php } else {
						echo '<div class="alert alert-danger" role="alert">
						  Sorry invalid inputs : please provide proper inputs :( </div>';
					  }
				}// check if compare form submitted
			    ?>
			    </div><!-- End of entry content -->
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
