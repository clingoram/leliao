<template>
  <!-- 註冊頁面 -->
  <div class="container">
    <h1>註冊</h1>
    <form>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default"
          >Account</span
        >
        <input
          type="text"
          class="form-control"
          aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-default"
        />
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input
          type="email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
        />
        <div id="emailHelp" class="form-text">
          We'll never share your email with anyone else.
        </div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          id="exampleInputPassword1"
        />
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
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