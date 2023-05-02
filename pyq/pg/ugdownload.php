<?php 
if (isset($_GET['ugyear_id'])) {
  include_once 'config.php';
  $query = "SELECT ugdrive_link FROM ugyear WHERE id=".$_GET['ugyear_id'];
  $result = $db->query($query);

  if ($result->num_rows > 0 ) {
    $row = $result->fetch_assoc();
    $ugdrive_link = $row['ugdrive_link'];

    if (strpos($ugdrive_link, 'drive.google.com') !== false) {
      // Redirect to the Google Drive link
      header("Location: $ugdrive_link");
      exit;
    }
  }

  // If no Google Drive link is found, display an error message
  echo "No data found.";
  exit;
}
?>
