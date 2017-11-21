Imagine that every request you make returns a field called <code class="language-markdown">`message`</code> along with some other data like so:

<pre><code class="language-json">{
    "message": "Settings saved!",
    "success": true,
    "someData": {}
}</code></pre>

The following config would alert a message with that response on each request.
<pre><code class="language-js">const settings = new Rapid({
    modelName: 'settings',
    afterRequest (response) {
        alert(response.data.message);
    }
});

settings.save({}).then((response) =>
    // afterRequest would fire an alert("Settings Saved!")
    // and you can still do whatever you want with the rest of the data
});

</code></pre>
