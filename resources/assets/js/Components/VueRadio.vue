<template>
    <div>
        <label>
            <span class="vue-radio__label">
                <span v-if="label" v-text="label"></span>
            </span>

            <input type="radio" v-model="enabled">

            <div></div>
        </label>
    </div>
</template>

<script>
export default {
    name: 'v-radio',

    data () {
        return {
            enabled: !!this.selected
        }
    },

    props: {
        selected : false,
        label    : ''
    },

}
</script>

<style lang="scss">

</style>
