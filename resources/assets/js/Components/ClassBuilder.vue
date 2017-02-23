<template>
    <div class="rapidjs-class-builder">
        <h2 class="title is-3" id="config-builder">Config Builder</h2>

        <div class="rapidjs-class-builder__form">
            <h4 id="config-builder-core" class="subtitle is-5 is-info">Core</h4>

            <div class="fb-grid row">
                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">baseURL:</span>
                        <input tabindex="1" class="input is-small is-info" type="text" v-model="model.config.baseURL">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">modelName:</span>
                        <input tabindex="2" class="input is-small is-info" type="text" v-model="model.config.modelName">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">primaryKey:</span>
                        <input tabindex="3" class="input is-small is-info" type="text" v-model="model.config.primaryKey">
                    </p>
                </div>

                <div class="fb-grid col-md-3">
                    <p class="control has-addons">
                        <span class="button is-info is-small">routeDelimeter:</span>
                        <input tabindex="4" class="input is-small is-info" type="text" v-model="model.config.routeDelimeter">
                    </p>
                </div>
            </div>

            <h4 id="config-builder-overrides" class="subtitle is-5 is-info">Routes</h4>

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

            <h4 id="config-builder-suffixes" class="subtitle is-5 is-info">Suffixes</h4>

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
                        <switches v-model="overrides.suffixes.destroy" :selected="overrides.suffixes.destroy" color="blue"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.suffixes.destroy }">suffixes.destroy:</span>

                        <input tabindex="8" :disabled="!overrides.suffixes.destroy"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.suffixes.destroy }"
                               type="text"
                               v-model="model.config.suffixes.destroy">
                    </p>
                </div>
            </div>

            <h4 id="config-builder-methods" class="subtitle is-5 is-info">Methods</h4>

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

                    <span class="help is-info">Available methods: get, destroy, head, post, put, patch</span>

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
                        <switches v-model="overrides.methods.destroy" :selected="overrides.methods.destroy" color="blue" @input="resetRouteOverride('collection')"></switches>
                    </span>

                    <p class="control has-addons">
                        <span :class="{ 'button is-info is-small' : true, 'is-disabled' : !overrides.methods.destroy }">methods.destroy:</span>

                        <input tabindex="11" :disabled="!overrides.methods.destroy"
                               :class="{ 'input is-small is-info' : true, 'is-disabled' : !overrides.methods.destroy }"
                               type="text"
                               v-model="model.config.methods.destroy">
                    </p>
                </div>
            </div>

            <h4 id="config-builder-options" class="subtitle is-5 is-info">Options</h4>

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
                        <switches v-model="model.config.caseSensitive" :selected="model.config.caseSensitive" color="blue"></switches>
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

        <h4 id="config-builder-overrides" class="subtitle is-5 is-info">Class Config</h4>
        <div class="rapidjs-class-builder__config"><pre><code class="language-json" ref="config" v-text="config"></code></pre></div>

        <div class="rapidjs-class-builder__routes">
            <h4 id="config-builder-routes" class="subtitle is-5 is-info">Generated Routes</h4>

            <div class="rapidjs-class-builder__routes__inner">
                <span class="code-block" v-for="(code, key) in generated">
                    <span class="code-block__code">
                        <code class="language-js">{{ key }} ({{ code.args.join(', ') }})</code>
                        <i class="fa fa-long-arrow-right"></i>
                    </span>

                    <span class="code-block__route">/{{ code.path }}</span>
                </span>
            </div>
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
                        destroy: false,
                    },

                    methods: {
                        create: false,
                        update: false,
                        destroy: false,
                    }
                },

                defaultOverrides: {
                    routes: {
                        model: 'false',
                        collection: 'false'
                    },

                    suffixes: {
                        create: 'create',
                        update: 'update',
                        destroy: 'destroy',
                    },

                    methods: {
                        create: 'post',
                        update: 'post',
                        destroy: 'post',
                    }
                },

                generated: {

                }

            }
        },

        components: {
            Switches
        },

        created () {
            // this.model.debugger.logEnabled = false;

            this.regenerateRoutes();
        },

        methods: {
            resetRouteOverride (route) {
                this.model.setRoute(route);
                // this.model.config.routes[route]
            },

            regenerateRoutes () {
                this.model.setRoutes();

                this.generated = {
                    find           : { args: [1], path: this.model.find(1) },
                    findBy         : { args: ['key', 'value'], path: this.model.findBy('key', 'value') },
                    all            : { args: [], path: this.model.all() },
                    create         : { args: [], path: this.model.create() },
                    update         : { args: [2], path: this.model.update(2) },
                    destroy        : { args: [3], path: this.model.destroy(3) },
                    hasRelationship: { args: ['tag', 123, 'latest'], path: this.model.hasRelationship('tag', 123, 'latest') },
                    belongsTo      : { args: ['gallery', 1234], path: this.model.collection.belongsTo('gallery', 1234) }
                };
            }
        },

        watch: {
            config () {
                this.regenerateRoutes();

                setTimeout(() => {
                    // , 'routes'
                    ['config'].forEach((k) => { prism.highlightElement(this.$refs[k], true) });
                }, 1);
            }
        },

        computed: {
            config () {
                let config = {
                    baseURL       : this.model.config.baseURL,
                    modelName     : this.model.config.modelName,
                    primaryKey    : this.model.config.primaryKey,
                    trailingSlash : this.model.config.trailingSlash,
                    caseSensitive : this.model.config.caseSensitive,
                    routeDelimeter: this.model.config.routeDelimeter
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

    .rapidjs-class-builder {
        &__routes {
            &__inner {
                width: 700px;
            }

            .code-block {
                display: block;
                font-size: 14px;

                &__code {
                    display: inline-block;
                    margin-right: 50px;
                    width: 295px;
                    position: relative;

                    i.fa {
                        font-weight: bold;
                        position: absolute;
                        right: -20px;
                        top: 2px;
                        font-size: 18px;
                    }
                }

                &__route {
                    display: inline-block;
                    text-align: right;
                    color: $blue;
                    font-size: 16px;
                }
            }
        }
    }
</style>
