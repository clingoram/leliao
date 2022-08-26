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
      <!-- <li v-if="(isLoggedIn = true)">
        <p>{{ this.name }}</p>
      </li> -->
      <!-- <li>
        <button v-on:click="checkLoginOrNot">Test API</button>
      </li> -->
      <li>
        <router-link
          v-bind:to="{ name: 'login-page' }"
          v-if="(isLoggedIn = true)"
          >登入</router-link
        >
      </li>
      <li>
        <router-link
          v-bind:to="{ name: 'register-page' }"
          v-if="(isLoggedIn = true)"
          >註冊</router-link
        >
      </li>
      <!-- <li v-if="(isLoggedIn = true)">
        <a class="nav-link" v-on:click="logout">登出</a>
      </li> -->
    </ul>
  </div>
  <!-- <router-view /> -->
</template>
<script>
export default {
  // props: ["isGuest"],
  data() {
    return {
      isLoggedIn: true,
      email: "",
      password: "",
      token: "",
      // login: {
      //   email: "",
      //   password: "",
      //   token: "",
      // },
    };
  },
  methods: {
    // add
    async checkLoginOrNot() {
      // const userdata = await $api.get("http://leliao/api/lel/");
      // console.log(userdata.data);
      // axios.get("api/lel/csrf-cookie").then((response) => {
      //   axios
      //     .post("api/lel/login", {
      //       email: this.email,
      //       password: this.password,
      //     })
      //     .then((response) => {
      //       this.$router.go("/dashboard");
      //     })
      //     .catch(function (error) {
      //       console.error(error);
      //     });
      // });
    },
    logout() {
      if (this.token !== null) {
        axios.get("api/lel/logout");
      }
    },
  },
};
</script>
