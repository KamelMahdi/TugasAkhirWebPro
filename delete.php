<?php
include("config.php");

$hapus = mysqli_query($conn, "DELETE from user WHERE id='$_GET[id]'");

echo "<script>
alert('data berhasil dihapus!');
document.location.href = 'admin.php';
</script>";
