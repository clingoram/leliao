<template>
  <!-- 註冊頁面 -->
  <div class="container">
    <h1>註冊</h1>
    <div class="input-group mb-3">
      <span class="input-group-text">帳號</span>
      <input
        type="text"
        class="form-control"
        id="inputAccount"
        v-model.trim="form.name"
        v-bind:max="max"
        v-bind:min="min"
        required
      />
    </div>

    <div class="input-group mb-3">
      <span class="input-group-text">Email</span>
      <input
        type="email"
        class="form-control"
        id="inputEmail"
        v-model.trim="form.email"
        required
      />
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text">密碼</span>
      <input
        type="password"
        class="form-control"
        id="inputPwd"
        autocomplete="on"
        v-model="form.password"
        v-bind:max="max"
        required
      />
    </div>
    <button
      type="submit"
      class="btn btn-primary"
      v-on:click="checkInputsValue()"
    >
      Submit
    </button>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("register");
  },
  data() {
    return {
      max: 20,
      min: 5,
      form: {
        name: "",
        email: "",
        password: "",
        role: "",
      },
      // store token in storage or session.
      token: "",
    };
  },
  methods: {
    /**
     * 檢查inputs值
     * */
    checkInputsValue() {
      const name = document.getElementById("inputAccount").value;
      const email = document.getElementById("inputEmail").value;
      const pwd = document.getElementById("inputPwd").value;
      // console.log(name);

      // regex
      let accountPattern = /^[0-9A-Za-z]+$/;
      let passwordPattern = /^[0-9A-Za-z]\w{7,20}$/;
      let emailPattern =
        /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (accountPattern.test(name) === false || name.length < 5) {
        alert(`帳號長度請重設。`);
        return;
      }
      if (emailPattern.test(email) === false || email.search("@") === -1) {
        alert("email無效。");
        return;
      }
      if (passwordPattern.test(pwd) === false || pwd.length < 7) {
        alert("請重設密碼。");
        return;
      }
      return this.register();
    },
    /**
     * 註冊。
     * 把接收到的值傳到後端處理
     * */
    register() {
      // console.log(this.form);
      axios
        .post("api/lel/register", {
          form: this.form,
        })
        .then((response) => {
          // console.log(response);
          // if (response.status === 201) {
          confirm("註冊成功");

          sessionStorage.setItem("token", response.data.accessToken);
          sessionStorage.setItem("name", response.data.user.name);
          sessionStorage.setItem("id", response.data.user.id);

          // history.go(0);
          document.location.href = "/";

          // add
          // axios.get("/api/lel/csrf-cookie").then((response) => {
          //   this.$router.go("/dashboard");
          // });
          // }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  // add
};
</script>