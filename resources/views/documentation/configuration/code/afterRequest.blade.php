Imagine that every request you make returns a field called <code class="language-markdown">`message`</code> like so:

<pre><code class="language-json">{
    "message": "Settings saved!",
    "success": true,
    "someData": {}
}</code></pre>

Given this config:
<pre><code class="language-js">var Settings = new Rapid({
    modelName: 'settings',
    afterRequest (response) {
        alert(response.data.message);
    }
});

Settings.save({}).then((response) =>
    // afterRequest would fire an alert("Settings Saved!") 
    // and you can still do whatever you want with the rest of the data
});

</code></pre>