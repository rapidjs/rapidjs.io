<template>
    <div class="rapidjs-class-builder">
        <h2 class="title is-3" id="class-builder">Class Builder</h2>

        <div class="rapidjs-class-builder__form">
            <h4 class="subtitle is-5 is-info">Core</h4>

            <div class="fb-grid row">
                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">baseURL:</span>
                        <input tabindex="1" class="input is-small is-info" type="text" v-model="model.baseURL">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">modelName:</span>
                        <input tabindex="2" class="input is-small is-info" type="text" v-model="model.modelName">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">primaryKey:</span>
                        <input tabindex="3" class="input is-small is-info" type="text" v-model="model.primaryKey">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">routeDelimeter:</span>
                        <input tabindex="4" class="input is-small is-info" type="text" v-model="model.routeDelimeter">
                    </p>
                </div>
            </div>

            <h4 class="subtitle is-5 is-info">Routes</h4>

            <div class="fb-grid row">

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.routes.model" :selected="overrides.routes.model" color="blue" @input="resetRouteOverride('model')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.routes.model }">routes.model:</span>

                        <input tabindex="5" :disabled="!overrides.routes.model"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.routes.model }"
                               type="text"
                               v-model="model.config.routes.model">
                    </p>
                </div>

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.routes.collection" :selected="overrides.routes.collection" color="blue" @input="resetRouteOverride('collection')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.routes.collection }">routes.collection:</span>

                        <input tabindex="6" :disabled="!overrides.routes.collection"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.routes.collection }"
                               type="text"
                               v-model="model.config.routes.collection">
                    </p>
                </div>
            </div>

            <h4 class="subtitle is-5 is-info">Suffixes</h4>

            <div class="fb-grid row">

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.suffixes.create" :selected="overrides.suffixes.create" color="blue"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.suffixes.create }">suffixes.create:</span>

                        <input tabindex="6" :disabled="!overrides.suffixes.create"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.suffixes.create }"
                               type="text"
                               v-model="model.config.suffixes.create">
                    </p>
                </div>

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.suffixes.update" :selected="overrides.suffixes.update" color="blue"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.suffixes.update }">suffixes.update:</span>

                        <input tabindex="7" :disabled="!overrides.suffixes.update"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.suffixes.update }"
                               type="text"
                               v-model="model.config.suffixes.update">
                    </p>
                </div>

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.suffixes.delete" :selected="overrides.suffixes.delete" color="blue"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.suffixes.delete }">suffixes.delete:</span>

                        <input tabindex="8" :disabled="!overrides.suffixes.delete"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.suffixes.delete }"
                               type="text"
                               v-model="model.config.suffixes.delete">
                    </p>
                </div>
            </div>

            <h4 class="subtitle is-5 is-info">Methods</h4>

            <div class="fb-grid row">

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.methods.create" :selected="overrides.methods.create" color="blue" @input="resetRouteOverride('model')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.methods.create }">methods.create:</span>

                        <input tabindex="9" :disabled="!overrides.methods.create"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.methods.create }"
                               type="text"
                               v-model="model.config.methods.create">
                    </p>

                    <span class="help is-info">Available methods: get, delete, head, post, put, patch</span>

                </div>

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.methods.update" :selected="overrides.methods.update" color="blue" @input="resetRouteOverride('collection')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.methods.update }">methods.update:</span>

                        <input tabindex="10" :disabled="!overrides.methods.update"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.methods.update }"
                               type="text"
                               v-model="model.config.methods.update">
                    </p>
                </div>

                <div class="fb-grid col-md-4">
                    <span class="label">
                        Override <br>
                        <switches v-model="overrides.methods.delete" :selected="overrides.methods.delete" color="blue" @input="resetRouteOverride('collection')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.methods.delete }">methods.delete:</span>

                        <input tabindex="11" :disabled="!overrides.methods.delete"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.methods.delete }"
                               type="text"
                               v-model="model.config.methods.delete">
                    </p>
                </div>
            </div>

            <h4 class="subtitle is-5 is-info">Options</h4>

            <div class="fb-grid row">
                <div class="fb-grid col-md-2">
                    <span class="label">trailingSlash</span>

                    <p class="control">
                        <switches v-model="model.config.trailingSlash" :selected="model.config.trailingSlash" color="blue"></switches>
                    </p>
                </div>

                <div class="fb-grid col-md-1">
                    <span class="label">caseSensitive</span>

                    <p class="control">
                        <switches v-model="model.caseSensitive" :selected="model.caseSensitive" color="blue"></switches>
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <span class="label">globalParameters</span>

                    <p class="control has-addons">
                        <span class="button is-info is-small">globalParameters:</span>

                        <input tabindex="12"
                               class="input is-small is-info"
                               type="text"
                               v-model="globalParameters">
                    </p>

                    <span class="help is-info">Comma separate: foo=bar, this=that</span>
                </div>
            </div>
        </div>

        <h4 class="subtitle is-5 is-info">Class Config</h4>
        <div class="rapidjs-class-builder__config"><pre><code class="language-json" ref="config" v-text="config"></code></pre></div>

        <div class="test">
            create ({})         => {{ model.create({}) }} <br>
            find (1)          => {{ model.find(1) }} <br>
            update (1)        => {{ model.update(1) }} <br>
            delete (1)        => {{ model.delete(1) }} <br>
            media ('waffles') => {{ model.media('waffles') }} <br>
            votes (1)         => {{ model.votes(1) }} <br>

            {{ model._debug }}

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
    import prism from './../Vendor/prism';
    import qs from 'qs';

    export default {
        name: 'class-builder',

        data () {
            return {
                model: TestModel,

                globalParameters: '',

                defaults: {
                    primaryKey: '-',
                    trailingSlash: false,
                    caseSensitive: false,
                    routeDelimeter: '-',
                },

                overrides: {
                    routes: {
                        model: false,
                        collection: false
                    },

                    suffixes: {
                        create: false,
                        update: false,
                        delete: false,
                    },

                    methods: {
                        create: false,
                        update: false,
                        delete: false,
                    }
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

        watch: {
            config () {
                setTimeout(() => { prism.highlightElement(this.$refs.config); }, 1);
            }
        },

        computed: {
            config () {
                let config = {
                    baseURL       : this.model.baseURL,
                    modelName     : this.model.modelName,
                    primaryKey    : this.model.primaryKey,
                    trailingSlash : this.model.config.trailingSlash,
                    caseSensitive : this.model.caseSensitive,
                    routeDelimeter: this.model.routeDelimeter
                };

                _.forEach(this.defaults, (val, k) => {
                    if(config[k] == val) {
                        delete config[k];
                    }
                });

                if(this.parsedGlobalParams) {
                    this.model.config.globalParameters = this.parsedGlobalParams;
                    config.globalParameters            = this.model.config.globalParameters;
                }

                _.forEach(this.overrides, (overrides, key) => {

                    let configOverride = {};

                    _.forEach(overrides, (val, k) => {
                        if(val) {
                            configOverride[k] = this.model.config[key][k];
                        }
                    });

                    if(!_.isEmpty(configOverride)) {
                        config[key] = configOverride;
                    }

                });

                return config;
            },

            parsedGlobalParams () {
                let rawParams = this.globalParameters.trim().split(',').filter(v => v != ''),
                    parsedParams = {};

                if(rawParams.length) {
                    _.forEach(rawParams, (val, key) => {
                        let parsed = qs.parse(val.trim());
                        parsedParams[Object.keys(parsed).shift()] = Object.values(parsed).shift();
                    });

                    return parsedParams;
                }

                return null;
            }
        }


    }
</script>

<style lang="scss">
    $blue: #539bb9;

    @import '~bulma/sass/utilities/all';
    @import '~bulma/sass/elements/form';
    @import '~bulma/sass/elements/button';
    // @import '~bulma/sass/elements/title';

    .label {
        font-size: 12px;
    }

    h4 {
        margin: 10px 0 10px !important;
    }
</style>
