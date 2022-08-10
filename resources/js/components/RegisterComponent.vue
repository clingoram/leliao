<template>
  <!-- 註冊頁面 -->
  <div class="container">
    <h1>註冊</h1>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="registerAccount"
        label="帳號名稱"
        label-for="registerAccount"
        description="請輸入數字0-9及大小寫字母，長度在5 - 20之間。"
      >
        <b-form-input
          id="register_account"
          v-model.trim="form.name"
          placeholder="帳號"
          required
          v-bind:max="max"
          v-bind:min="min"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="registerEmail"
        label="Email:"
        label-for="registerEmail"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="register_email"
          v-model="form.email"
          type="email"
          placeholder="Email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="registerPassword"
        label="密碼"
        label-for="registerPassword"
        description="請輸入數字0-9及大小寫字母。"
      >
        <b-form-input
          id="register_password"
          v-model="form.password"
          placeholder="密碼"
          type="password"
          required
          v-bind:max="max"
          v-bind:min="min"
          autocomplete="on"
        ></b-form-input>
      </b-form-group>
      <b-button
        type="submit"
        variant="outline-primary"
        v-on:click="checkInputsValue"
        >送出</b-button
      >
      <b-button type="reset" variant="danger">重設</b-button>
      <p>已有帳號?到<router-link to="/login">登入</router-link></p>
    </b-form>
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
        name: this.name ? this.name : "",
        email: this.email ? this.email : "",
        password: this.password ? this.password : "",
        role: "A" ? "A" : "M",
      },
      show: true,
    };
  },
  methods: {
    /**
     * 檢查inputs值。
     * 若檢查通過，則true
     * */
    checkInputsValue() {
      const name = document.getElementById("register_account").value;
      const email = document.getElementById("register_email").value;
      const pwd = document.getElementById("register_password").value;

      let accountPattern = /^[0-9A-Za-z]+$/;
      let passwordPattern = /^[0-9A-Za-z]\w{7,14}$/;

      if (accountPattern.test(name) === false) {
        alert(`帳號長度請重設。`);
        return;
      }
      if (pwd.match(passwordPattern) === null) {
        alert("請重設密碼");
        return;
      }
      return true;
    },
    onSubmit(event) {
      event.preventDefault();

      // alert(JSON.stringify(this.form));

      if (this.checkInputsValue() === true) {
        return this.register();
      }
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    /**
     * 註冊。
     * 把接收到的值傳到後端處理
     * */
    register() {
      // let getValue = this.checkInputsValue();
      // console.log(getValue);
      axios
        .post("api/leliao/register", {
          form: this.form,
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>