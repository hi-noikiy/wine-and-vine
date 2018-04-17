<template>
    <div
        class="relative cursor-pointer z-10"
        @mouseover="activate"
        @mouseout="deactivate"
        @click="activate"
    >
        <slot name="heading"></slot>

        <div
            v-show="active"
            class="bg-grey-light p-4 text-black absolute rounded pin-r pin-t w-48"
            style="border-top-right-radius: 28px 22px; top: 7px; right: 4px;"
        >
            <p class="mb-4 font-semibold">{{ fullname }}</p>

            <ul class="list-reset">
                <slot name="links"></slot>
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import activation from '../mixins/activation'

    export default {
        name: "Dropdown",

        computed: {
            ...mapGetters('auth', {
                user: 'user',
                fullname: 'fullname'
            }),
        },

        mixins: [ activation ]
    }
</script>

<style scoped>

</style>