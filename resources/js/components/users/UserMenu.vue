<template>
  <!-- 使用者資訊(登出、登入、註冊) -->
  <!-- 判斷是否有登入，依據狀況在dropdown顯示不同頁面連結 -->
  <div class="dropdown">
    <button
      class="btn btn-secondary dropdown-toggle"
      type="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      註冊 / 登入
    </button>
    <ul class="dropdown-menu">
      <!-- <div v-if="isGuest" class="navbar-guest"> -->
      <li>
        <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
      </li>
      <li>
        <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
      </li>
      <!-- </div>
      <div v-else class="navbar-auth">
        <li>登出</li>
      </div> -->
    </ul>
  </div>
  <!-- <router-view /> -->
</template>
<script>
export default {
  // props: ["isGuest"],
  data() {},
};
</script>
