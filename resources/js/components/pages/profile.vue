<template>
    <div class="profile">
        <h3>
        <strong>{{currentUser.user.name}}</strong> Profile
      </h3>
    </header>
    <p>
      <strong>Token:</strong>
      {{currentUser.token.substring(0, 20)}} ... {{currentUser.token.substr(currentUser.token.length - 20)}}
    </p>
    <p>
      <strong>Id:</strong>
      {{currentUser.user.id}}
    </p>
    <p>
      <strong>Email:</strong>
      {{currentUser.user.email}}
    </p>
        
    </div>
</template>

<script>
export default {
     computed: {
    currentUser() {
      return this.$store.state.auth.user;
    }
  },
  mounted() {
    if (!this.currentUser) {
      this.$router.push('/login');
    }
  }
};
</script>

<style></style>
