
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Thypeahead.js</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="http://iamsaravieira.com/demos/autocomplete/css/normalize.min.css">
        <link rel="stylesheet" href="http://iamsaravieira.com/demos/autocomplete/css/main.css">

        <script src="http://iamsaravieira.com/demos/autocomplete/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>

    <section>
        <h2> States </h2>
        <input class="states" type="text" placeholder="States" spellcheck="false" dir="auto">
    </section>
    <section>
        <h2> States and Countries</h2>
        <input class="both" type="text" placeholder="States" spellcheck="false" dir="auto">
    </section>
    <section>
        <h2> Repos </h2>
        <input class="repos" type="text" placeholder="States" spellcheck="false" dir="auto">
    </section>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="http://iamsaravieira.com/demos/autocomplete/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>

        <script src="assets/js/typeahead.js"></script>
        <!-- <script src="http://iamsaravieira.com/demos/autocomplete/typeahead.js"></script> -->
        <!-- <script src="http://iamsaravieira.com/demos/autocomplete/js/hogan.js"></script> -->

        <script src="assets/js/hogan.js"></script>

        <script>
            $('.states').typeahead({                                
                 name: 'states',                                        
                 prefetch: 'states.json',  
                 limit: 10                                                
            });
            $('.both').typeahead([
              {
                name: 'states1',
                prefetch: 'states1.json',
                header: '<span class="header">States</span>'
              },
              {
                name: 'countries',
                prefetch: 'countries.json',
                header: '<span class="header">Countries</span>'
              }
            ]);
            $('.repos').typeahead({
              name: 'repos',
              prefetch: 'repos.json',
              template: [
                '<p class="name">{{name}}</p>',
                '<p class="lang">{{language}}</p>',
                '<p class="desc">{{description}}</p>'
              ].join(''),
              engine: Hogan
            });

        </script>
    </body>
</html>
