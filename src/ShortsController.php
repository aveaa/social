<?php
require "includes/DatabaseModel.inc";
use Unionity\OpenVK4\core\Database\DatabaseModel;
header("HTTP/1.1 307 Temporary Redirect");

$url = preg_replace("/\//", "", $_SERVER["REQUEST_URI"], 1);
$url = preg_replace("/\/(.+)/", "", $url);

$conn = new DatabaseModel("***", "***", "***", "***");
$redirect = $conn->query("SELECT redirect FROM shorts WHERE url=?", $url);

exit(header("Location: ".(is_null($redirect) ? "/blank.php?id=8&from=invalid_shortcut" : "/".mysqli_fetch_array($redirect)[0])));