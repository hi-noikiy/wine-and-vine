<template>
    <div
        id="cart-modal"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="Cart Modal"
        aria-hidden="true"
    >
        <div
            class="modal-dialog"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">

                    <h5
                        id="Cart Modal"
                        class="modal-title"
                    >{{ title }}</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    ><span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">
                    <ul>
                        <li
                            v-for="product in products"
                            :key="product.id"
                        >{{ product.quantity }} {{ product.name }}</li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >Close</button>

                    <button
                        type="button"
                        class="btn btn-primary"
                    >Checkout</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CartModal",

        props: {
            title: {
                type: String,
                required: true
            },
            items: {
                type: Array,
                required: true
            }
        },

        data () {
            return {
                products: this.items
            }
        }
    }
</script>

<style scoped>

</style>