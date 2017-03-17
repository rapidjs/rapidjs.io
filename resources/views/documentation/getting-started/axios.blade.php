<h2 id="axios">Axios</h2>

<p>Under the hood rapid takes advantage of the promised-based framework <a href="https://github.com/mzabriskie/axios" target="_blank">axios</a>. To better understand any api configuration have a look at their <a href="https://github.com/mzabriskie/axios" target="_blank">documentation</a>. Though it would defeat the purpose of rapid can still access and use axios directly via <code class="language-js">this.api</code>.</p>

<pre><code class="language-js">var Photo = new Rapid({ modelName: 'photo' });
// axios is set as the .api variable
Photo.api.get('/api/posts/1');
</code></pre>

<p>For more on configuring axios, see <a href="#configuration-apiConfig">apiConfig</a>.</p>
