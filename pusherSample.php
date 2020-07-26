<?php
require __DIR__ . '/vendor/autoload.php';

echo 'run';

// $pusher = new Pusher\Pusher("APP_KEY", "APP_SECRET", "APP_ID", array('cluster' => 'APP_CLUSTER'));
// $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
$pusher = new Pusher\Pusher("7b5150d331d136146d67", "c9cb8943619845c2f930", "1045036", array('cluster' => 'ap3'));
$pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
