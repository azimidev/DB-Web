<footer class="footer">
	<div class="container">
		<div class="row">
			<p class="text-muted text-center">Copyright &copy; <?php echo date("Y"); ?> Hassan Azimi & Tak Wan</p>
		</div>
	</div>
</footer><!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="js/vendor/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/vendor/video.js"></script>
<script src="js/flat-ui.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
<?php
if(isset($connection)) {
	mysqli_close($connection);
}
?>