<template>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Leliao</a>
      <ul class="nav">
        <li class="nav-item">
          <router-link v-bind:to="{ name: 'login-page' }">登入</router-link>
        </li>
        <li class="nav-item">
          <router-link v-bind:to="{ name: 'register-page' }">註冊</router-link>
        </li>
      </ul>
    </div>
  </nav>
  <!-- <router-view /> -->
</template>
<script>
</script>