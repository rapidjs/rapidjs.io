<p align="center">
<img src="http://rapidjs.io/images/rapid-logo-gh-readme.png" />
</p>

# rapidjs.io - The docs for [rapid.js](http://rapidjs.io)

### Getting a working local environment
    npm install

### Valet  (mac users only)
 - Install [valet](https://laravel.com/docs/5.4/valet)
 - `valet link rapid`

### Understanding The File Structure

This is a [Laravel](https://laravel.com) build. If you're not familiar with it, give it a look! There's quite a few folders in this install but below are the only ones to be concerned with.

`data/` - This contains the data for all the methods and configuration that are displayed on the docs page. This also contains the data that tells the docs what pages to render per section.

`resources/` - The views and assets.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`views/` - The view template files.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`documentation/` -This is where the main documentation files live. For each section of the docs, a folder with sub pages lives.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`methods & configuration` - Each one if these has a `code` folder where, if a file is created, it will be displayed below its definition on the docs page.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`assets/` - The js.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`sass/` -The sass

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---`js/` -The JS for minor things such as code formatting and the config builder. Not really necessary to edit.

### Linting Your Sass
If you make any changes to the sass you must follow the guidelines in the scsslint.yml. If you're not familiar with this, have a look [here](https://github.com/brigade/scss-lint/blob/master/lib/scss_lint/linter/README.md). Please follow the BEM syntax as I am loosley following it. Running the `gulp lint-sass` command should have no errors before commiting.

    gulp lint-sass
