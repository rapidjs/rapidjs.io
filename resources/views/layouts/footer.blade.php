
        @if (Route::currentRouteName() != 'docs')</div>@endif
        <div class="footer">

            <div class="footer__inner fb-grid row">
                <div class="footer__logo">
                    @include('components.logo')
                </div>

                <div class="footer__links">
                    <a href="{{ route('docs') }}">documentation</a>
                    <a href="{{ route('contribute') }}">contribute</a>
                    <a href="{{ route('support') }}">support</a>
                </div>

                <div class="footer__madeby">
                    <span>
                        <span class="color-rapid"><i class="fa fa-copyright"></i> {{ date('Y') }} Drew J Bartlett </span>
                        <a href="http://drewjbartlett.com/?ref=rapid" target="_blank">(drewjbartlett.com)</a>
                    </span>
                </div>
            </div>


        </div>

        @if (Route::currentRouteName() == 'docs')</div>@endif

        @if (Route::currentRouteName() == 'docs')
            <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
            <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

            <script>
                var client = algoliasearch("C3YLLGCGRG", "e1e71df52f2217b2b60288a81d7b6fd5");
                var configIndex = client.initIndex('rapid.js-config');
                var methodIndex = client.initIndex('rapid.js-methods');
                //initialize autocomplete on search input (ID selector must match)
                autocomplete('#docs-search', {
                    templates: { footer: '<div class="branding">Powered by <img height="15" src="/images/algolia-logo.svg" /></div>' }
                },
                [
                    {
                        source: autocomplete.sources.hits(configIndex, {hitsPerPage: 3}),
                        //value to be displayed in input control after user's suggestion selection
                        displayKey: 'name',
                        //hash of templates used when rendering dataset
                        templates: {
                            //'suggestion' templating function used to render a single suggestion
                            suggestion: function(suggestion) {
                              return `
                                  <a href="#${suggestion.prefix}-${suggestion.name}">
                                  <b>${suggestion._highlightResult.name.value}</b>
                                  <span>${suggestion._highlightResult.description.value}</span>
                                  </a>
                              `;

                            },
                            header: '<div class="autocomplete__header"><h1>Configuration</h1></div>'
                        }
                    },

                    {
                        source: autocomplete.sources.hits(methodIndex, {hitsPerPage: 3}),
                        //value to be displayed in input control after user's suggestion selection
                        displayKey: 'name',
                        //hash of templates used when rendering dataset
                        templates: {
                            //'suggestion' templating function used to render a single suggestion
                            suggestion: function(suggestion) {
                              return `
                                  <a href="#${suggestion.prefix}-${suggestion.name}">
                                  <b>${suggestion._highlightResult.name.value}</b>
                                  <span>${suggestion._highlightResult.description.value}</span>
                                  </a>
                              `;

                            },
                            header: '<div class="autocomplete__header"><h1>Methods</h1></div>'
                        }
                    }
                ]
            );
            </script>
        @endif

        <script src="{{ mix('/js/app.js') }}"></script>

    </body>
</html>
