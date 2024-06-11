<!DOCTYPE html>

<head>
    <title>Pusher Test</title>

</head>

<body>
    <h1>Bet Page</h1>



    <div id="lbloutput"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="<?= module_dir_url(BETTING_MODULE_NAME, 'assets/js/betting.js')  ?>"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('de14478e50f9b87c7d32', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('<?= $key ?>');
        channel.bind('<?= $id ?>', function(data) {
            //$('#lbloutput').html(data);
            var id = "<?= $id ?>",
                key = "<?= $key ?>",
                html = '';
            var d = data.odds;
            html += '<h2>' + d.sport_title + "<h2>";
            html += '<h5>' + d.away_team + " VS " + d.home_team + "<h5>";
            d.bookmakers.forEach(function(c) {
                html += '<h6>' + c.title + '</h6><ul>';
                c.markets.forEach(function(m) {
                    m.outcomes.forEach(function(o) {
                        html += '<li>' + o.name + ' | ' + o.price + '</li>'
                    })
                })
                html += '</ul>';
            })
            $('#lbloutput').html(html);
            console.log((data));
            //alert(JSON.stringify(data));
        });
    </script>
</body>