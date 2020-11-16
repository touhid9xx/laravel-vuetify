<template>
    <v-app-bar app flat dense color="cyan accent-3">
        <v-toolbar-title data-app flat>Nox Bit Loan</v-toolbar-title>
        <template>
            <v-btn text class="ml-2" to="/">
                <v-icon>home</v-icon>
                Home
            </v-btn>

            <v-btn text class="ml-2" to="about">
                <v-icon>info</v-icon>
                About
            </v-btn>

            <v-btn text class="ml-2" to="contact">
                <v-icon> how_to_reg</v-icon>
                Contact
            </v-btn>
            <v-btn text class="ml-2" to="blog">
                <v-icon> how_to_reg</v-icon>
                Blog
            </v-btn>
        </template>
        <v-spacer></v-spacer>
        <template v-if="!currentUser">
            <v-btn text class="ml-2" to="login">
                <v-icon>login</v-icon>
                Sign In
            </v-btn>
            <v-btn text class="ml-2" to="register">
                <v-icon>touch_app</v-icon>
                Register
            </v-btn>
        </template>

        <template v-if="currentUser">
            <v-btn text class="ml-2" to="dashboard">
                <v-icon>dashboard</v-icon>
                Dashboard
            </v-btn>
            <v-menu bottom offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn text class="ma-2" v-bind="attrs" v-on="on">
                        <v-icon>person_pin_circle</v-icon>
                        <strong>{{ currentUser.user.name }}</strong>
                    </v-btn>
                </template>
                <v-list flat text>
                    <v-list-item>
                        <v-list-item-title>
                            <v-btn text to="profile">
                                Edit Profile
                            </v-btn>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <v-btn text @click="logOut">
                                Logout
                            </v-btn>
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>
                            <v-btn text>
                                Change Password
                            </v-btn>
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </template>
    </v-app-bar>
</template>

<script>
export default {
    computed: {
        currentUser() {
            return this.$store.state.auth.user;
        }
    },
    methods: {
        logOut() {
            this.$store.dispatch("auth/logout");
            this.$router.push("login");
        }
    }
};
</script>

<style></style>
