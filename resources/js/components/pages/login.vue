<template>
    <div class="login">
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-form>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="blue">
                            <v-toolbar-title>Login Form</v-toolbar-title>
                        </v-toolbar>
                        <v-alert color="error" :value="error" icon="close">
                            The credentials are not correct
                        </v-alert>
                        <v-card-text>
                            <v-text-field
                                prepend-icon="email"
                                name="email"
                                v-model="user.email"
                                label="Email"
                                type="email"
                                :rules="[rules.required, rules.email]"
                            >
                            </v-text-field>
                            <v-text-field
                                prepend-icon="lock"
                                name="password"
                                v-model="user.password"
                                label="Password"
                                type="password"
                                :rules="[rules.required, rules.min]"
                            >
                            </v-text-field>
                        </v-card-text>
                        <v-divider light></v-divider>
                        <v-card-actions>
                            <v-btn rounded color="indigo" dark to="register">
                                Sign up
                                <v-icon>forward </v-icon>
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                rounded
                                color="primary"
                                dark
                                @click.prevent="login"
                            >
                                Login
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
import User from "../../models/user";
export default {
    data: () => ({
        user: new User("", ""),
        error: false,
        rules: {
            required: value => !!value || "Required.",
            min: v => (v && v.length >= 8) || "Min 8 characters",
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || "Invalid e-mail.";
            }
        }
    }),
    computed: {
        loggedIn() {
            return this.$store.state.auth.status.loggedIn;
        }
    },
    created() {
        if (this.loggedIn) {
            this.$router.push("dashboard");
        }
    },
    methods: {
        login() {
            if (this.user.email && this.user.password) {
                this.$store.dispatch("auth/login", this.user).then(
                    () => {
                        this.$store.commit("SET_NOTIFICATION", {
                            display: true,
                            text: "Login successful",
                            alertClass: "error"
                        });
                        this.$router.push("profile");
                    },
                    error => {
                        this.error =
                            (error.response && error.response.data) ||
                            error.message ||
                            error.toString();
                    }
                );
                //  console.log(this.user.email, this.user.password);
            }
        }
    }
};
</script>

<style></style>
