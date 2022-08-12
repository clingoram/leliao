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
  </nav>
  <!-- 註冊/登入頁面會出現在上面，分類和文章之上 -->
  <router-view />
</template>
<script>
// import UserMenu from "./UserMenu.vue";
export default {
  mounted() {
    console.log("Header");
  },
  components: {
    // UserMenu,
  },
};
</script>