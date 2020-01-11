(function() {
    var client = algoliasearch('UVX4M36L4Q', 'b557d0617925f672e2ef28ca91266188');
    var index = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <div class="algolia-result">
                            <span>
                                <img src="#" alt="img" class="algolia-thumb">
                                nyau
                            </span>
                            <span>$${suggestion._highlightResult.name}</span>
                        </div>
                        <div class="algolia-details">
                            <span>${suggestion.name}</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            //window.location.href = window.location.origin + '/shop/' + suggestion.slug;
            enterPressed = true;
        }).on('keyup', function(event) {
            if (event.keyCode == 13 && !enterPressed) {
              //  window.location.href = window.location.origin + '/search-algolia?q=' + document.getElementById('aa-search-input').value;
            }
        });
})();
