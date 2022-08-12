<template>
  <!-- 使用者資訊(登出、登入、註冊、個人檔案) -->
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
      <li><router-link to="/user/login">登入</router-link></li>
      <li><router-link to="/user/register">註冊</router-link></li>
    </ul>
  </div>
  <!-- <router-view /> -->
</template>
<script>
export default {
  data() {},
};
</script>
