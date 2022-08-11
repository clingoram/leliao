<template>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Leliao</a>
      <!-- <user-menu /> -->
      <ul class="nav">
        <li class="nav-item">
          <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
        </li>
        <li class="nav-item">
          <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
        </li>
      </ul>
    </div>
    <!-- <router-view /> -->
  </nav>
</template>
<script>
// import UserMenu from "./UserMenu.vue";
export default {
  components: {
    // UserMenu,
  },
};
</script>