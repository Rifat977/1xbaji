<!DOCTYPE html>

<head>
    <title>Pusher Test</title>

    <link rel="stylesheet" href="<?= module_dir_url(BETTING_MODULE_NAME, 'views/website/valkey/assets/css/style.css')  ?>">
</head>

<body>
    <h1>Home Page</h1>
    <?php
    foreach ($category as $cat) {
        echo '<a href="#" onclick="cat(' . $cat['id'] . ')">' . $cat['name'] . '</a><br>';
    }
    ?>


    <div id="lbloutput"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'assets/js/betting.js')  ?>"></script>
    <script>
        function cat(id) {
            $.get('<?= site_url('betting/category/') ?>' + id, function(data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    var html = "";
                    a.forEach(function(e) {
                        html += "<h2>" + e.sports.title + "</h2><ul>";
                        e.bet.forEach(function(d) {
                            html += '<li>' + d.home_team + " VS " + d.away_team + " <a href=\"<?= site_url('betting/bet/') ?>" + d.sport_key + "/" + d.id + "\">click here to bet</a></li>";
                        });
                        html += "</ul>";
                    });
                    $('#lbloutput').html(html);
                } else {
                    $('#lbloutput').html("");
                }
                console.log(a);
            });
        }
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('17e6be9474d0313dcaac', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            $('#lbloutput').html(data);
            //alert(JSON.stringify(data));
        });
    </script>
</body>