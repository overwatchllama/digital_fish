<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<description>DigitalFish Feed</description>
<title>DigitalFish Alerts</title>
<?php
include "connection.php";
$stmt = $db->query("SELECT * FROM alert where collection='rss';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

$id = $row['id'];
$message = $row['message'];
$title = '# '.$id .' '.$row['title'];
$pubdate = $row['dateset_timeset'];
$pubdate= date("D, d M Y H:i:s T", strtotime($pubdate));
$category= $row['category'];
print '<item>';
print '<title>'.$title.'</title>';
print '<description>'.$message.'</description>';
print '<category>'.$category.'</category>';
print '<pubDate>'.$pubdate.'</pubDate>';
print '</item>';
};
?>
</channel>
</rss>
