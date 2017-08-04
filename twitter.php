<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#DearBetsy</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Galdeano" rel="stylesheet" type="text/css">
    <script src="js/respond.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/tweetLinkIt.js"></script>
    <script>

    $('.twittertext').tweetLinkify();

    function pageComplete(){
            $('.twittertext').tweetLinkify();
            console.log('pagecomplete');
        }
    </script>
</head>

<body>
          <?php
          ini_set('display_errors', 1);
          require_once('TwitterAPIExchange.php');

          /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
          $settings = array(
            'oauth_access_token' => "1566240092-Z9bAQ1GdXm0KL2iw01gDPZMkrxORJaFJBoLTV79",
            'oauth_access_token_secret' => "pjZQ1KVL5OkWB8g3b5qw5e6nfvhPx56s8kT8oH3u58K18",
            'consumer_key' => "5x8k7XBZ57526ygJNjLqWbY0l",
            'consumer_secret' => "pEVJpt5G1rASRzgWyXNuDToXWfmct97r4g0yDCRS4oCPSzDnIK"
          );


          /** Perform a GET request and echo the response **/
          /** Note: Set the GET field BEFORE calling buildOauth(); **/
          $url = 'https://api.twitter.com/1.1/search/tweets.json';
          $getfield = '?q=#dearbetsy&count=50';
          $requestMethod = 'GET';
          $twitter = new TwitterAPIExchange($settings);
          $api_response = $twitter->setGetfield($getfield)
                       ->buildOauth($url, $requestMethod)
                       ->performRequest();

          $tweetData = json_decode($api_response);


          foreach($tweetData->statuses as $tweet)
          {
            $date = new Datetime($tweet->created_at);
            $date->setTimezone(new DateTimeZone('America/New_York'));

            echo "<div class='twitteruserphoto'><a href='http://twitter.com/{$tweet->user->screen_name}' target='_blank'><img src='{$tweet->user->profile_image_url}'></a></div>";
            echo "<div class='twittername'><a href='http://twitter.com/{$tweet->user->screen_name}' target='_blank'>{$tweet->user->name}</a></div>";
            echo "<div class='twitteruser'><a href='http://twitter.com/{$tweet->user->screen_name}' target='_blank'>@{$tweet->user->screen_name}</a></div>";
            echo "<div class='twittertext'>{$tweet->text}</div>";
            echo "<div class='twittertime'><a href='http://twitter.com/{$tweet->user->screen_name}/status/{$tweet->id_str}' target='_blank'>{$date->format( 'M jS g:i:s a ' )}</a></div>";
            echo "<div class='twitterphoto'><a href='{$tweet->entities->media[0]->media_url}' target='_blank'><img src='{$tweet->entities->media[0]->media_url}' style='max-width:100%'></a></div>";
            echo "<div class='twitterline' style='width:100% height:1px'></div>";

            echo "<script>pageComplete();</script>";
          }

          ?>

<!-- javacript -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- <script src="js/smoothstate.js"></script>
<script src="js/custom.js"></script> -->

</body>
</html>
