<?php require __DIR__ . '/vendor/autoload.php';

    $channel = 'mya';
    $event   = 'mya';
    $message = 'Hellaaso World!';
    $options = [
        'cluster' => 'eu',
        // options below are needed for pusher local dev server
        'encrypted' => false,
        'host'      => 'pusher',
        'port'      => '57003',
    ];
    $pusher = new Pusher\Pusher(
        getenv('PUSHER_APP_KEY'),
        getenv('PUSHER_APP_SECRET'),
        getenv('PUSHER_APP_ID'),
        $options
    );

  

$int =0;
while($int<10){

        echo 'Sending event: ' . $event . ' with message: ' . $message . ' to channel: ' . $channel . PHP_EOL;
        $pusher->trigger($channel, $event, $data = ['message' => $int]);
        sleep(1);
        $int++;
}
    