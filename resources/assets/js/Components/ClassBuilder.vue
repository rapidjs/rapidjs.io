<template>
    <div class="rapidjs-class-builder">
        <div class="rapidjs-class-builder__config"><pre><code class="language-json">{{ model }}</code></pre></div>
    </div>
</template>

<script>
    import TestModel from './../Interface/TestModel';

    export default {
        name: 'class-builder',

        data () {
            return {
                model: TestModel
            }
        }
    }
</script>

<style lang="scss">

</style>
