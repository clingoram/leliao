<template>
  <!-- 使用者資訊(登出、登入、註冊) -->
  <!-- 判斷是否有登入，依據狀況在dropdown顯示不同頁面連結 -->
  <div class="dropdown">
    <div v-if="isLoggedIn === true">
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        {{ this.name }}
      </button>
      <ul class="dropdown-menu">
        <li>
          <router-link v-bind:to="{ name: 'management' }">帳號頁面</router-link>
        </li>
        <li>
          <router-link v-bind:to="{ name: 'add' }">新增文章</router-link>
        </li>
        <li>
          <a class="nav-link" v-on:click="logout">登出</a>
        </li>
      </ul>
    </div>
    <div v-else>
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        註冊 / 登入
      </button>
      <ul class="dropdown-menu">
        <li v-if="!isLoggedIn">
          <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
        </li>
        <li v-if="!isLoggedIn">
          <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
// import $api from "../../api/api";

export default {
  data() {
    return {
      isLoggedIn: false,
      accessToken: "",
      name: "",
      // roleResult: false,
    };
  },
  created() {
    if (
      sessionStorage.getItem("token") !== null &&
      sessionStorage.getItem("token") !== "undefined"
    ) {
      this.accessToken = sessionStorage.getItem("token");
      this.name = sessionStorage.getItem("name");
      this.isLoggedIn = true;
    } else {
      this.isLoggedIn = false;
    }
  },
  methods: {
    /**
     * 檢查登入者role
     */
    // checkRole() {
    //   // console.log(sessionStorage.getItem("name"));
    //   axios
    //     .get(
    //       "api/lel/check/" +
    //         sessionStorage.getItem("id") +
    //         "/" +
    //         sessionStorage.getItem("name")
    //     )
    //     .then((response) => {
    //       console.log(response.data);
    //       // this.roleResult = response.data === 1 ? true : false;
    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },
    /**
     * 登出
     * */
    logout() {
      if (sessionStorage.removeItem("token")) {
        sessionStorage.removeItem("id");
        sessionStorage.removeItem("name");
        this.isLoggedIn = false;
      }
      axios
        .post("api/lel/logout")
        .then((response) => {
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
