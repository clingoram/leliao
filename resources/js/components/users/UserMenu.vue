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
      <li v-if="isLoggedIn">
        <p>{{ this.name }}</p>
      </li>
      <li v-if="isLoggedIn">
        <router-link v-bind:to="{ name: 'add' }">新增文章</router-link>
      </li>
      <li v-if="isLoggedIn">
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
      name: "",
      id: "",
      accessToken: "",
    };
  },
  // created() {
  //   this.beforeMount();
  // },
  async beforeMount() {
    // let res = await $api.get("/login");
    // this.isLoggedIn = true;

    if (sessionStorage.getItem("token") !== null) {
      // this.accessToken = localStorage.getItem("token");
      // this.name = localStorage.getItem("name");

      this.accessToken = sessionStorage.getItem("token");
      this.name = sessionStorage.getItem("name");
      this.id = sessionStorage.getItem("id");
      // console.log(this.id);
      console.log(`token: ${this.accessToken}`);
      this.isLoggedIn = true;
    } else {
      console.log("no token");
      this.isLoggedIn = false;
    }
  },
  // async beforeMount() {
  //   axios.get("/sanctum/csrf-cookie").then((response) => {
  //     console.log(response);

  //     axios
  //       .post("api/lel/login", {
  //         loginForm: this.loginForm,
  //       })
  //       .then((response) => {
  //         console.log(response);
  //         this.isLoggedIn = true;
  //         localStorage.setItem("token", response.data.accessToken);
  //       })
  //       .catch(function (error) {
  //         console.error(error);
  //       });
  //   });
  // },
  methods: {
    // beforeMount() {
    //   // let res = await $api.get("/login");
    //   // this.isLoggedIn = true;

    //   if (sessionStorage.getItem("token") !== null) {
    //     // this.accessToken = localStorage.getItem("token");
    //     // this.name = localStorage.getItem("name");

    //     this.accessToken = sessionStorage.getItem("token");
    //     this.name = sessionStorage.getItem("name");
    //     console.log(this.name);
    //     console.log(this.accessToken);
    //     this.isLoggedIn = true;
    //   } else {
    //     console.log("no token");
    //     this.isLoggedIn = false;
    //   }
    // },
    logout() {
      if (sessionStorage.getItem("token") !== null) {
        this.isLoggedIn = false;
        sessionStorage.removeItem("token");
        sessionStorage.removeItem("name");
        sessionStorage.removeItem("id");
        // // axios.get("api/lel/logout");
        // document.location.href = "/";

        // axios
        //   .post("api/lel/logout", {
        //     name: this.name,
        //     accessToken: this.accessToken,
        //   })
        //   .then((response) => {
        //     console.log(response);
        //     confirm("成功登出");
        //     // this.isLoggedIn = false;
        //     // sessionStorage.removeItem("token");
        //     // sessionStorage.removeItem("name");
        //     // sessionStorage.removeItem("id");
        //     document.location.href = "/";
        //   })
        //   .catch((error) => {
        //     console.log(error);
        //   });
      }
    },
  },
};
</script>
