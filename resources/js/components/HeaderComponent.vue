<template>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Leliao</a>
      <user-menu />
    </div>
  </nav>

  <router-view />
  <!-- 註冊/登入頁面會出現在上面，分類和文章之上 -->
</template>
<script>
import UserMenu from "./users/UserMenu.vue";

export default {
  mounted() {
    console.log("Header");
  },
  components: {
    UserMenu,
  },
};
</script>