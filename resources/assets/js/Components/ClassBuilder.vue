<template>
    <div class="rapidjs-class-builder">
        <h2 id="class-builder">Class Builder</h2>
        <div class="rapidjs-class-builder__form">
            <h4>Core</h4>

            <div class="fb-grid row">
                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">baseURL:</span>
                        <input class="input is-small is-info" type="text" v-model="model.baseURL">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">modelName:</span>
                        <input class="input is-small is-info" type="text" v-model="model.modelName">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">primaryKey:</span>
                        <input class="input is-small is-info" type="text" v-model="model.primaryKey">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">routeDelimeter:</span>
                        <input class="input is-small is-info" type="text" v-model="model.routeDelimeter">
                    </p>
                </div>
            </div>

            <h4>Overrides</h4>

            <div class="fb-grid row">

                <div class="fb-grid col-md-3">
                    <span class="label">
                        Override <br>
                        <switches v-model="options.overrideModelRoute" :selected="options.overrideModelRoute" color="blue" @input="resetRouteOverride('model')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !options.overrideModelRoute }">routes.model:</span>

                        <input :disabled="!options.overrideModelRoute"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !options.overrideModelRoute }"
                               type="text"
                               v-model="model.config.routes.model">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <span class="label">
                        Override <br>
                        <switches v-model="options.overrideCollectionRoute" :selected="options.overrideCollectionRoute" color="blue" @input="resetRouteOverride('collection')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !options.overrideCollectionRoute }">routes.collection:</span>

                        <input :disabled="!options.overrideCollectionRoute"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !options.overrideCollectionRoute }"
                               type="text"
                               v-model="model.config.routes.collection">
                    </p>
                </div>
            </div>

            <h4>Options</h4>

            <div class="fb-grid row">
                <div class="fb-grid col-md-2">
                    <span class="label">trailingSlash</span>

                    <p class="control">
                        <switches v-model="model.config.trailingSlash" :selected="model.config.trailingSlash" color="blue"></switches>
                    </p>
                </div>

                <div class="fb-grid col-md-1">
                    <span class="label">keepCase</span>

                    <p class="control">
                        <switches v-model="model.keepCase" :selected="model.keepCase" color="blue"></switches>
                    </p>
                </div>
            </div>
        </div>

        <div class="rapidjs-class-builder__config"><pre><code class="language-json">{{ config }}</code></pre></div>

        <div class="test">
            find (1)          => {{ model.find(1) }} <br>
            update (1)        => {{ model.update(1) }} <br>
            delete (1)        => {{ model.delete(1) }} <br>
            media ('waffles') => {{ model.media('waffles') }} <br>
            votes (1)         => {{ model.votes(1) }} <br>
            <!-- posts (1)         => {{ model.posts(1) }} <br> -->
            <!-- all ({ foo: bar }) => {{ model.all ({ foo: 'bar' }) }} <br> -->
            <!-- {{ model.sanitizeUrl(model.baseURL + '/' + model.collection.makeUrl( 'bum', 'boo', '?' + qs.stringify({ 'boob': 'bum' }))) }} -->
        </div>
    </div>
</template>

<script>
    import TestModel from './../Interface/TestModel';
    import Switches from 'vue-switches';
    import _ from 'lodash';

    export default {
        name: 'class-builder',

        data () {
            return {
                model: TestModel,
                defaults: {
                    primaryKey: '-',
                    trailingSlash: false,
                    keepCase: false,
                    routeDelimeter: '-',
                },
                options: {
                    overrideModelRoute: false,
                    overrideCollectionRoute: false
                }
            }
        },

        components: {
            Switches
        },

        methods: {
            resetRouteOverride (route) {
                let func = `set${_.capitalize(route)}Route`;

                this.model[func]();
            }
        },

        computed: {
            config () {
                let config = {
                    baseURL       : this.model.baseURL,
                    modelName     : this.model.modelName,
                    primaryKey    : this.model.primaryKey,
                    trailingSlash : this.model.config.trailingSlash,
                    keepCase      : this.model.keepCase,
                    routeDelimeter: this.model.routeDelimeter
                };

                _.forEach(this.defaults, (val, k) => {
                    if(config[k] == val) {
                        delete config[k];
                    }
                });

                if(this.options.overrideModelRoute || this.options.overrideCollectionRoute) {
                    config.routes = {};

                    if(this.options.overrideModelRoute) {
                        config.routes.model = this.model.config.routes.model;
                    }

                    if(this.options.overrideCollectionRoute) {
                        config.routes.collection = this.model.config.routes.collection;
                    }

                }

                return config;
            }
        }
    }
</script>

<style lang="scss">
    $blue: #539bb9;

    @import '~bulma/sass/utilities/all';
    @import '~bulma/sass/elements/form';
    @import '~bulma/sass/elements/button';

    .label {
        font-size: 12px;
    }
</style>
