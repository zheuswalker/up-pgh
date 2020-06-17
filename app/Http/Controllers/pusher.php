<!DOCTYPE html>
<head>
    <body>

            <div id="notification">asd</div>

    </body>
  <title>Pusher Local Dev Server Article</title>
  <!-- <script src="https://js.pusher.com/4.1/pusher.min.js"></script> -->
  <script src="./assets/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var channel       = 'my';
    var event         = 'my';
    var pusherAppKey  = '22222222222222222222';
    var pusherOptions = {
        cluster: 'eu',
        // options below are needed for pusher local dev server
        encrypted: false,
        httpHost: '0.0.0.0',
        httpPort: '57003',
        wsHost: '0.0.0.0',
        wsPort: '57004'
    }
    var pusher = new Pusher(pusherAppKey, pusherOptions);

    // start listening for events
    pusher
        .subscribe('my')
        .bind(event, function (data) {


for(key in data) {
    if(data.hasOwnProperty(key)) {
        var value = data[key];
        document.write(value);
        <?php require __DIR__ . '/vendor/autoload.php';

    $channel = 'my-channel';
    $event   = 'my-event';
    $message = 'Hello World!';
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

    $checkint =0;
    while (true) {
        if($checkint%2==0){
        echo 'Sending event: ' . $event . ' with message: ' . $message . ' to channel: ' . $channel . PHP_EOL;
        $pusher->trigger($channel, $event, $data = ['message' => $checkint]);
        sleep(1);
    }
    $checkint++;
    
    }
    ?>
    }
}
            document.body.style.backgroundColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
        });
  </script>
</head>



