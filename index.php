<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php';?>


<!-- pagination -->
<?php
	$per_page = 3;
	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
	else
	{
		$page = 1;
	}

	$start_form = ($page - 1) * $per_page;
	echo "<script type='text/javascript'>alert('$start_form');</script>";
	
?>

<!-- pagination -->


<?php
	$query = "select * from tbl_post limit $start_form, $per_page";
	$db = new Database();
	$post = $db->select($query);
	$format = new Format();
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
		<?php
			if($post)
			{
				while($result = $post->fetch_assoc())
				{

		?>
					<div class="samepost clear">
						<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
						<h4><?php echo $format->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
						 <a href="#"><img src="admin/upload/<?php echo $result['image'];?>" alt="post image"/></a>
						<p>
							<?php echo $format->textShorter($result['body']);?>
						</p>
						<div class="readmore clear">
							<a href="post.html">Read More</a>
						</div>
					</div>
				<?php
				}
				?> <!-- end while loop -->
				
				<!-- pagination -->
				<?php
					$query = "select * from tbl_post";
					$result = $db->select($query);
					$total_rows = mysqli_num_rows($result);
					$total_page = ceil($total_rows/$per_page);

					echo "<span><a href = 'index.php?page=1'>".'First Page'."</a>";
					for ($i=1; $i <= $total_page; $i++) { 
						echo "<a href = 'index.php?page=".$i."'>".$i."</a>";
					}
					echo "<a href='index.php?page=$total_page'>".'Last Page'."</a></span>";

				?>

				<!-- pagination -->


		<?php 
			} 
			else 
			{ 
				header("Location:404.php"); 
			} 
		?>

		</div>
		<?php include 'inc/sidebar.php';?>
	</div>

	<?php include 'inc/footer.php'?>