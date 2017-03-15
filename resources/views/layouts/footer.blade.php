
            </div>
            <div class="footer">

                <div class="footer__inner fb-grid row">
                    <div class="footer__logo">
                        @include('components.logo')
                    </div>

                    <div class="footer__links">
                        <a href="{{ route('docs') }}">documentation</a>
                        <a href="{{ route('contribute') }}">contribute</a>
                    </div>

                    <div class="footer__madeby">
                        <span>
                            <span class="color-rapid"><i class="fa fa-copyright"></i> {{ date('Y') }} Drew J Bartlett </span>
                            <a href="http://drewjbartlett.com/?ref=rapid" target="_blank">(drewjbartlett.com)</a>
                        </span>
                    </div>
                </div>


            </div>

        <script src="/js/app.js"></script>

        @if (Route::currentRouteName() == 'docs')
            <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
            <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

            <script>
                var client = algoliasearch("C3YLLGCGRG", "e1e71df52f2217b2b60288a81d7b6fd5");
                var index = client.initIndex('rapid.js-config');
                //initialize autocomplete on search input (ID selector must match)
                autocomplete('#docs-search',
                { hint: false, debug: true },
                {
                    source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
                    //value to be displayed in input control after user's suggestion selection
                    displayKey: 'name',
                    //hash of templates used when rendering dataset
                    templates: {
                        //'suggestion' templating function used to render a single suggestion
                        suggestion: function(suggestion) {
                          return `
                              <a href="#${suggestion.prefix}-${suggestion.name}">
                              <b>${suggestion._highlightResult.name.value}</b><br />
                              <span>${suggestion._highlightResult.description.value}</span>
                              </a>
                          `;

                        },
                        header: '<div class="autcomplete__header"><h1>Configuration</h1></div>',
                        footer: '<div class="branding">Powered by <img height="15" src="/images/algolia-logo.svg" /></div>'
                    }
                });
            </script>
        @endif
    </body>
</html>
