<template>
  <!-- 登入 -->
  <div class="container">
    <form>
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
    </form>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("login");
  },
  data() {
    return {
      loginForm: {
        email: "",
        password: "",
        // token: "",
      },
    };
  },
  methods: {
    /**
     * 檢查inputs值。
     * 若檢查通過，則把值傳給function
     * */
    checkInputsValue() {
      // const token = "asdsadsafASFadfsaf";

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
    },
    login() {
      // Cookies.set("login", JSON.stringify(this.loginForm), { expires: 1 });
      // console.log(this.loginForm);

      // if (Cookies.get("login") && this.loginForm.token) {
      //   this.$router.push({ name: "Dashboard" });
      // }

      // console.log(typeof this.form);
      axios
        .post("api/lel/login", {
          form: this.form,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeToken() {
      Cookies.remove("login");
    },
  },
};
</script>
