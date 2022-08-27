<template>
  <!-- 登入 -->
  <div class="container">
    <div class="mb-3">
      <label for="email_address" class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        id="email_address"
        v-model="loginForm.email"
        aria-describedby="emailHelp"
      />
      <div id="emailHelp" class="form-text">
        We'll never share your email with anyone else.
      </div>
    </div>
    <div class="mb-3">
      <label for="input_pwd" class="form-label">密碼</label>
      <input
        type="password"
        class="form-control"
        id="input_pwd"
        v-model="loginForm.password"
      />
    </div>
    <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
    <button
      type="submit"
      class="btn btn-primary"
      v-on:click="checkInputsValue()"
    >
      Submit
    </button>
    <!-- <button v-on:click="removeToken()">Clear</button> -->
  </div>
</template>
<script>
// import $api from "../../api";
export default {
  mounted() {
    console.log("login");
  },
  data() {
    return {
      loginForm: {
        email: "",
        password: "",
      },
      accessToken: "",
      name: "",
    };
  },
  // async beforeMount() {
  //   let resUser = await $api.get("/f/all");
  //   this.userData = resUser.data;

  //   let res = await $api.get("/login");
  //   this.isLoggedIn = true;
  //   localStorage.setItem("token", res.data.accessToken);
  // },
  methods: {
    /**
     * 檢查inputs值。
     * 若檢查通過，則把值傳給function
     * */
    checkInputsValue() {
      const email = document.getElementById("email_address").value;
      const pwd = document.getElementById("input_pwd").value;

      const passwordPattern = /^[0-9A-Za-z]\w{7,20}$/;
      const emailPattern =
        /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (
        emailPattern.test(email) === false &&
        passwordPattern.test(pwd) === false
      ) {
        alert("email密碼不能為空");
        return;
      }
      // this.loginForm.token = token;

      return this.login();
      // return this.checkLoginOrNot();
    },

    // checkLoginOrNot() {
    //   axios.get("/sanctum/csrf-cookie").then((response) => {
    //     console.log(response);

    //     axios
    //       .post("api/lel/login", {
    //         loginForm: this.loginForm,
    //       })
    //       .then((response) => {
    //         console.log(response);
    //         // this.isLoggedIn = true;
    //         localStorage.setItem("token", response.data.accessToken);
    //       })
    //       .catch(function (error) {
    //         console.error(error);
    //       });
    //   });
    // },
    login() {
      axios
        .post("api/lel/login", {
          loginForm: this.loginForm,
        })
        .then((response) => {
          // console.log(response.data.accessToken);
          // console.log(response.data.user.name);
          // localStorage.setItem("token", response.data.accessToken);
          // localStorage.setItem("name", response.data.user.name);
          sessionStorage.setItem("token", response.data.accessToken);
          sessionStorage.setItem("name", response.data.user.name);

          // redirect to home page.
          document.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
