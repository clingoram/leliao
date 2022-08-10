<template>
  <!-- 登入 -->
  <form>
    <div class="mb-3">
      <label for="email_address" class="form-label">Email address</label>
      <input
        type="email"
        class="form-control"
        id="email_address"
        aria-describedby="emailHelp"
      />
      <div id="emailHelp" class="form-text">
        We'll never share your email with anyone else.
      </div>
    </div>
    <div class="mb-3">
      <label for="input_pwd" class="form-label">Password</label>
      <input type="password" class="form-control" id="input_pwd" />
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" />
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>
<script>
export default {
  mounted() {
    console.log("login");
  },
  data() {
    return {
      min: 5,
      max: 20,
      form: {
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
     * 若檢查通過，則把值傳給function
     * */
    checkInputsValue() {
      const email = document.getElementById("email_address").value;
      const pwd = document.getElementById("input_pwd").value;

      if (pwd === "") {
        alert("密碼錯誤");
        return;
      }
      return true;
    },
    onSubmit(event) {
      event.preventDefault();
      // alert(JSON.stringify(this.form));
      if (this.checkInputsValue() === true) {
        return this.login();
      }
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      // this.form.email = "";
      this.form.email = "";
      this.form.password = "";
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    login() {
      // console.log(typeof this.form);
      axios
        .post("api/leliao/login", {
          form: this.form,
        })
        .then((response) => {
          console.log(this.form.email);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
