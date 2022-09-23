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
    <p class="form-text warning">
      * 請記得註冊時的email和密碼，目前本網站尚未提供重設密碼功能。
    </p>
    <button
      type="submit"
      class="btn btn-success"
      v-on:click="checkInputsValue()"
    >
      註冊
    </button>
    <button type="button" class="btn btn-danger" v-on:click="clear()">
      清除
    </button>
  </div>
</template>
<script>
export default {
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

      // regex
      // input不能有單引號、OR、1 = 1和 --
      const accountPattern = /^[0-9A-Za-z]+$/;
      const passwordPattern = /^[0-9A-Za-z]\w{7,20}$/;
      const emailPattern =
        /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (accountPattern.test(name) === false || name.length < 3) {
        alert(`帳號長度請重設。`);
        return;
      }
      if (emailPattern.test(email) === false || email.search("@") === -1) {
        alert("email無效。");
        return;
      }
      if (
        passwordPattern.test(pwd) === false ||
        pwd.length < 7 ||
        pwd.length > 20
      ) {
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
      axios
        .post("api/lel/user/register", {
          form: this.form,
        })
        .then((response) => {
          confirm("註冊成功");
          console.log(response);
          // sessionStorage.setItem("branch", JSON.stringify(response.data));

          sessionStorage.setItem("identity", response.data.identity);
          sessionStorage.setItem("expires", response.data.expires_at);

          sessionStorage.setItem("id", response.data.user.id);
          sessionStorage.setItem("name", this.form.name);
          document.location.href = "/";
        })
        .catch((error) => {
          console.log(error);
        });
    },
    clear() {
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";
      this.form.role = "";
    },
  },
};
</script>