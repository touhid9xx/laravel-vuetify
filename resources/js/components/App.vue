<template>
    <v-app>
        <Navbar />

        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
            <Notification />
        </v-main>
        <Footer />
    </v-app>
</template>

<script>
import Navbar from "./layouts/navbar";
import Footer from "./layouts/footer";
import Notification from "../components/layouts/notifications";
export default {
    components: {
        Navbar,
        Footer,
        Notification
    }
};
</script>

<style></style>
