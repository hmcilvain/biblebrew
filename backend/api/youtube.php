
<?php
require_once 'config.php';

$url = "https://www.youtube.com/feeds/videos.xml?channel_id=YOUR_CHANNEL_ID";

$xml = simplexml_load_file($url);

$data = [];

foreach ($xml->entry as $entry) {
    $data[] = [
        'title' => (string)$entry->title,
        'link' => (string)$entry->link['href'],
        'published' => (string)$entry->published
    ];
}

file_put_contents(DATA_PATH . 'youtube.json', json_encode($data));
