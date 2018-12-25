<?
	include("connect.php");
	hb_set_payment_mode("TRUE");
	?>
		<script language="javascript">
			alert("Authorize.net payment mode is in TEST mode now.");
			window.location.href='deskboard.php';
		</script>
	<?
?>