<template>
    <div id="register">
        <v-layout align-center justify-center>
            <v-flex x12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar dark color="blue">
                        <v-toolbar-title> Signup Form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form>
                            <v-alert
                                :value="userExists"
                                color="error"
                                icon="warning"
                            >
                                <div>{{ userExists }}</div>
                            </v-alert>

                            <v-text-field
                                prepend-icon="person"
                                name="name"
                                v-model="user.name"
                                label="Name"
                                :rules="[rules.required]"
                            >
                            </v-text-field>
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
                                label="Password"
                                v-model="user.password"
                                type="password"
                                hint="At least 8 characters"
                                :rules="[rules.required, rules.min]"
                            >
                            </v-text-field>
                            <v-text-field
                                prepend-icon="lock"
                                name="password"
                                label="Confirm Password"
                                v-model="password_confirmation"
                                type="password"
                                :rules="[rules.required, passwordMatch]"
                            >
                            </v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-divider light></v-divider>
                    <v-card-actions>
                        <v-btn rounded color="primary" dark to="login">
                            <v-icon>arrow_back_ios</v-icon>
                            Sign in
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn rounded color="indigo" dark @click="register">
                            Register
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
import User from "../../models/user";
export default {
    computed: {
        passwordMatch() {
            return () =>
                this.password === this.password_confirmation ||
                "Password must match";
        }
    },
    data: () => ({
        userExists: false,
        user: new User("", "", ""),
        message: "",
        password_confirmation: "",
        rules: {
            required: value => !!value || "Required.",
            min: v => (v && v.length >= 8) || "Min 8 characters",
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || "Invalid e-mail.";
            }
        }
    }),
    methods: {
        register() {
            this.$store.dispatch("auth/register", this.user).then(
                data => {
                    this.message = data.message;
                    this.$store.commit("SET_NOTIFICATION", {
                        display: true,
                        text: "Account created successfully! Please Login",
                        alertClass: "danger"
                    });
                    this.$router.push("login");
                },
                error => {
                    this.userExists =
                        (error.response && error.response.data) ||
                        error.message ||
                        error.toString();
                }
            );
        }
    }
};
</script>

<style></style>
