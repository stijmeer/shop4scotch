<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<title>NMDAD | Presentatie</title>

	<meta name="description" content="A presentation to support our project for NMDAD II.">
	<meta name="author" content="Stijn Meersschaert">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	{{--<link rel="stylesheet" href="presentation_01/css/reveal.css">--}}
	{{ Html::style('reveal_js/css/reveal.css') }}
	{{--<link rel="stylesheet" href="presentation_01/css/theme/black.css" id="theme">--}}
	{{ Html::style('reveal_js/css/theme/night.css') }}


<!-- Theme used for syntax highlighting of code -->
	{{--<link rel="stylesheet" href="presentation_01/lib/css/zenburn.css">--}}
	{{ Html::style('reveal_js/lib/css/zenburn.css') }}


<!-- Printing and PDF exports -->
	<script>
		var link = document.createElement( 'link' );
		link.rel = 'stylesheet';
		link.type = 'text/css';
		link.href = window.location.search.match( /print-pdf/gi ) ? '../../reveal_js/css/print/pdf.css' : 'presentation_01/css/print/paper.css';
		document.getElementsByTagName( 'head' )[0].appendChild( link );
	</script>

	<!--[if lt IE 9]>
	{{ Html::script('reveal_js/lib/js/html5shiv.js') }}
	<![endif]-->
</head>

<body>

<div class="reveal">

	<!-- Any section element inside of this container is displayed as a slide -->
	<div class="slides">
		<section>
            {{ Html::image('logo.png', 'Shop4scotch logo', array('style' => 'width:10rem; background:0; border:0;')) }}
			<h2>Shop4Scotch.local</h2>
            <a>A webshop that sells the finest whiskey to the finest customers.</a>
		</section>

        <section>
            <section>
                <h2>App</h2>
                <p>Aantonen correcte werking van de app.</p>
            </section>
            <section>
                <h3>Front office</h3>
                <a href="http://localhost:3000/#/" target="_blank">shop4scotch.local</a>
            </section>
        </section>

        <section>
            <section>
                <h2>API</h2>
                <p>Aantonen correcte werking van de API.</p>
            </section>
            <section>
                <h3>Products overview API</h3>
                <a href="http://www.shop4scotch.local/api/v1/product" target="_blank">products API</a>
            </section>
            <section>
                <h3>Product {id} API</h3>
                <a href="http://www.shop4scotch.local/api/v1/products/1" target="_blank">product API</a>
            </section>
        </section>

        <section>
            <section>
                <h2>Backoffice</h2>
                <p>Aantonen correcte uitwerking van de backoffice.</p>
            </section>
            <section>
                <h3>Backoffice</h3>
                <ul>
                    <li><a href="http://www.shop4scotch.local/backoffice" target="_blank">Homepage</a></li>
                    <li>Statistics</li>
                    <li>
                        Products
                        <ul>
                            <li>Create</li>
                            <li>Read</li>
                            <li>Update</li>
                            <li>Delete</li>
                        </ul>
                    </li>
                </ul>
            </section>
        </section>

        <section>
            <section>
                <h2>Checklist</h2>
                <p>Aantonen dat alle items op de checklist aanwezig zijn.</p>
            </section>
            <section>
                <ul>
                    <li>Academische poster</li>
                    <li>Presentatie</li>
                    <li>Productiedossier</li>
                    <li>
                        Timesheets
                        <ul>
                            <li>Sam De Smedt</li>
                            <li>Stijn Meersschaert</li>
                        </ul>
                    </li>
                    <li>Werkstuk</li>
                </ul>
            </section>
        </section>

        <section>
            <section>
                <h2>Extra's</h2>
                <p>Overlopen van de extra's die aanwezig zijn in dit project.</p>
            </section>
            <section>
                <h3>Most wanted products</h3>
                <small>by looking at customers' unordered baskets</small>
                <br>
                <a href="http://www.shop4scotch.local/backoffice/" target="_blank">Most wanted</a>
            </section>
            <section>
                <h3>Inventaris en prijs geschiedenis via ajax</h3>
                <a href="http://www.shop4scotch.local/backoffice/statistics" target="_blank">Statistics</a>
            </section>
            <section>
                <h3>Presentaties in de backoffice</h3>
                <a href="http://www.shop4scotch.local/backoffice/presentations" target="_blank">Presentations</a>
            </section>
        </section>

        <section>
            {{ Html::image('logo.png', 'Shop4scotch logo', array('style' => 'width:10rem; background:0; border:0;')) }}
            <h1>THE END</h1>
        </section>

	</div>

</div>

{{--<script src="presentation_01/lib/js/head.min.js"></script>--}}
{{ Html::script('reveal_js/lib/js/head.min.js') }}
{{--<script src="presentation_01/js/reveal.js"></script>--}}
{{ Html::script('reveal_js/js/reveal.js') }}


<script>

	// More info https://github.com/hakimel/reveal.js#configuration
	Reveal.initialize({
		controls: true,
		progress: true,
		history: true,
		center: true,

		transition: 'slide', // none/fade/slide/convex/concave/zoom

		// More info https://github.com/hakimel/reveal.js#dependencies
		dependencies: [
			{ src: 'presentation_01/lib/js/classList.js', condition: function() { return !document.body.classList; } },
			{ src: 'presentation_01/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
			{ src: 'presentation_01/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
			{ src: 'presentation_01/plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } },
			{ src: 'presentation_01/plugin/zoom-js/zoom.js', async: true },
			{ src: 'presentation_01/plugin/notes/notes.js', async: true }
		]
	});

</script>

</body>
</html>
