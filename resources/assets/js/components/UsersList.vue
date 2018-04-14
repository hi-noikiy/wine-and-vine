<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4
                    v-if="loading"
                    class="text-center text-muted"
                >Loading users...</h4>
                <div
                    v-else
                    class="card card-default">
                    <div class="card-header">Users Component</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                v-for="user in users"
                                :key="user.id"
                                class="list-group">
                                {{ user.first_name }}
                            </li>
                        </ul>
                        <small>There are {{ usersCount }} users registered at this time.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UsersList",

        data () {
            return {
                loading: false
            }
        },

        computed: {
            users () {
                return this.$store.getters.users
            },

            usersCount() {
                return this.$store.getters.usersCount
            }
        },

        created () {
            this.loading = true;
            this.$store.dispatch('fetchUsers')
                .then(() => this.loading = false)
        }
    }
</script>
