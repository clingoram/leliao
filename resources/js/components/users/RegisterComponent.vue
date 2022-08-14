<template>
  <!-- 註冊頁面 -->
  <div class="container">
    <h1>註冊</h1>
    <form>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputAccount">帳號</span>
        <input
          type="text"
          class="form-control"
          aria-describedby="inputAccount"
          required
          v-model.trim="form.name"
          v-bind:max="max"
          v-bind:min="min"
        />
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text" id="inputEmail">Email</span>
        <input
          type="email"
          class="form-control"
          aria-describedby="inputEmail"
          required
          v-model="form.email"
        />
        <!-- <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div> -->
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputPwd">密碼</span>
        <input
          type="password"
          class="form-control"
          aria-describedby="inputPwd"
          required
          v-model="form.password"
        />
      </div>
      <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> -->
      <button type="submit" class="btn btn-primary" v-on:click="register()">
        Submit
      </button>
    </form>
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
        name: this.name,
        email: this.email,
        password: this.password,
      },
      // show: true,
    };
  },
  methods: {
    /**
     * 檢查inputs值。
     * 若檢查通過，則true
     * */
    // checkInputsValue() {
    //   const name = document.getElementById("inputAccount").value;
    //   const email = document.getElementById("inputEmail").value;
    //   const pwd = document.getElementById("inputPwd").value;

    //   let accountPattern = /^[0-9A-Za-z]+$/;
    //   let passwordPattern = /^[0-9A-Za-z]\w{7,14}$/;

    //   if (accountPattern.test(name) === false) {
    //     alert(`帳號長度請重設。`);
    //     return;
    //   }
    //   if (pwd.match(passwordPattern) === null) {
    //     alert("請重設密碼");
    //     return;
    //   }
    //   return true;
    // },
    onSubmit(event) {
      event.preventDefault();

      // alert(JSON.stringify(this.form));

      // if (this.checkInputsValue() === true) {
      //   return this.register();
      // }
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";

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
      console.log(this.form);
      // axios
      //   .post("api/lel/register", {
      //     form: this.form,
      //   })
      //   .then((response) => {
      //     console.log(response);
      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });
    },
  },
};
</script>