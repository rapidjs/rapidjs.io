
            </div>
            <div class="footer">
                Made my me.
            </div>

        <script src="/js/app.js"></script>

        @if (Route::currentRouteName() == 'docs')
            <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
            <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

            <script>
                var client = algoliasearch("C3YLLGCGRG", "e1e71df52f2217b2b60288a81d7b6fd5");
                var index = client.initIndex('rapid.js');
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
                              <b>${suggestion._highlightResult.name.value}</b><br />
                              <span>${suggestion._highlightResult.description.value}</span>
                          `;

                        }
                    }
                });
            </script>
        @endif
    </body>
</html>
