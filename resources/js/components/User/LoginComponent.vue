<template>
  <!-- 登入 -->
  <div class="container">
    <h1>登入</h1>
    <div class="mb-3">
      <label for="email_address" class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        id="email_address"
        v-model="loginForm.email"
        required
      />
    </div>
    <div class="mb-3">
      <label for="input_pwd" class="form-label">密碼</label>
      <input
        type="password"
        class="form-control"
        id="input_pwd"
        v-model="loginForm.password"
        required
      />
    </div>
    <p class="form-text warning">
      * 目前註冊功能暫時關閉。<br />
      * 若需登入，請至<a href="https://github.com/clingoram/leliao">GitHub</a
      >，內有預設3組帳密可供測試。
    </p>
    <button
      type="submit"
      class="btn btn-success"
      v-on:click="checkInputsValue()"
      style="padding-right: 5px"
    >
      登入
    </button>
    <button type="button" class="btn btn-danger" v-on:click="clearAll()">
      清除
    </button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      loginForm: {
        email: "",
        password: "",
      },
      // name: "",
    };
  },
  methods: {
    /**
     * 檢查inputs值。
     * 若檢查通過，則把值傳給login
     * */
    checkInputsValue() {
      const email = document.getElementById("email_address").value;
      const pwd = document.getElementById("input_pwd").value;

      const passwordPattern = /^[0-9A-Za-z]\w{7,20}$/;
      const emailPattern =
        /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (
        email.search("@") === -1 ||
        emailPattern.test(email) === false ||
        passwordPattern.test(pwd) === false
      ) {
        alert("email密碼不能為空。");
        return;
      }

      return this.login();
    },
    /**
     * 登入
     */
    login() {
      axios.get("/sanctum/csrf-cookie").then((response) => {
        axios
          .post("api/lel/user/login", {
            loginForm: this.loginForm,
          })
          .then((response) => {
            // console.log(response.data);
            // sessionStorage.setItem("branch", JSON.stringify(response.data));

            sessionStorage.setItem("id", response.data.udata.uid);
            sessionStorage.setItem("name", response.data.udata.uac);
            sessionStorage.setItem("identity", response.data.identity);
            sessionStorage.setItem("expires", response.data.expires_at);
            document.location.href = "/";
          })
          .catch(function (error) {
            alert(error.response.data);
          });
      });
    },
    /**
     * 清除所有inputs值
     *  */
    clearAll() {
      this.loginForm.email = "";
      this.loginForm.password = "";
    },
  },
};
</script>
