<?
	include("connect.php");
	hb_set_payment_mode("FALSE");
	?>
		<script language="javascript">
			alert("Authorize.net payment mode is in LIVE mode now.");
			window.location.href='deskboard.php';
		</script>
	<?
?>