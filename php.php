<?php get_header();?>
<div id="body_conten">
<?php if(have_post()):while(have_post()):the_post;?>
<div class="post_box">
<div class="post_title">
<h2>
	<a href="<?php the permalink();?>">
	<?php the_title();?>
	</a>
</h2>
</div><!--end of post-->
<div class="post_thumd">
<?php 
	
?>