<template>
    <div class="w-1/3 sm:hidden">
        <Slideout
            menu="#menu"
            panel="#panel"
            :toggleSelectors="['#toggle-button']"
            @on-open="open"

        >
            <nav id="menu">
                <div>Menu</div>
            </nav>
            <main id="panel">
                <header>
                    <div>
                        <!--Hamburger-->
                        <div
                            id="toggle-button"
                            class="cursor-pointer"
                        >
                            <font-awesome-icon
                                :icon="['fal', 'bars']"
                                class="text-white"
                                size="lg"
                            ></font-awesome-icon>
                        </div>
                        Panel
                    </div>
                </header>
            </main>
        </Slideout>
    </div>
</template>

<script>
    import Slideout from 'vue-slideout'

    export default {
        name: "Sidebar",
        components: {
          Slideout
        },

        methods: {
            open: function () {
                console.log('slideoutOpen')
            }
        }
    }
</script>

<style scoped>

</style>