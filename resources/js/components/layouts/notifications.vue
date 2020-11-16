<template>
    <div class="notification">
        <v-snackbar
            :color="NOTIFICATION.alertClass"
            v-model="snackbar"
            bottom
            right
            :timeout="NOTIFICATION.timeout"
        >
            <v-icon>notification_important</v-icon>
            {{ NOTIFICATION.text }}
            <v-btn text dark @click="snackbar = false">
                <v-icon>clear</v-icon>
            </v-btn>
        </v-snackbar>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    computed: {
        ...mapGetters(["NOTIFICATION"]),
        snackbar: {
            get() {
                return this.$store.getters.NOTIFICATION.display;
            },
            set(value) {
                this.$store.commit("SET_NOTIFICATION", {
                    display: false
                });
            }
        }
    }
};
</script>

<style></style>
