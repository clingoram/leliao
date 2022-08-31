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
      <li v-if="isLoggedIn === true">
        <p>{{ this.name }}</p>
      </li>
      <li v-if="isLoggedIn === true">
        <router-link v-bind:to="{ name: 'add' }">新增文章</router-link>
      </li>
      <li v-if="isLoggedIn === true">
        <a class="nav-link" v-on:click="logout">登出</a>
      </li>
      <li v-if="!isLoggedIn">
        <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
      </li>
      <li v-if="!isLoggedIn">
        <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
      </li>
    </ul>
  </div>
  <!-- <router-view /> -->
</template>
<script>
// import $api from "../../api";

export default {
  data() {
    return {
      isLoggedIn: false,
      // accessToken: "",
      name: "",
    };
  },
  created() {
    if (sessionStorage.getItem("token") !== null) {
      // this.accessToken = sessionStorage.getItem("token");
      this.name = sessionStorage.getItem("name");
      this.isLoggedIn = true;

      // axios.defaults.headers.common[
      //   "Authorization"
      // ] = `Bearer ${this.accessToken}`;
    }
  },
  methods: {
    logout() {
      axios
        .post("api/lel/logout")
        .then((response) => {
          // console.log(response);
          confirm("成功登出");
          document.location.href = "/";
          this.isLoggedIn = false;
          sessionStorage.removeItem("token");
          sessionStorage.removeItem("id");
          sessionStorage.removeItem("name");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
