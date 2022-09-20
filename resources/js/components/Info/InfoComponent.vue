<template>
  <!-- 網站簡介 -->
  <div class="container">
    <h1>關於Leliao</h1>
    <h4>- 簡介:</h4>
    <p>
      「Leliao 了聊」是個人作品，沒有商業用途，概念來自網路PTT上的文章。<br />
      會取名為「了聊」，是因為希望這個社群網站的文章可以讓人解到一些事情，再進階一點的功能則是希望是能做到可以跟其他使用者聊天。
    </p>
    <h4>- 技術:</h4>
    <p>
      Laravel + Vue + Sanctum + PostgreSQL <br />
      使用 axios 串接API <br />使用 Laradock 建造開發環境
    </p>
    <h4>- 目前功能:</h4>
    <ol v-for="item in functions" v-bind:key="item.id">
      <li>{{ item.id }}. {{ item.text }}</li>
    </ol>
    <p>
      詳細請至我的<a href="https://github.com/clingoram">GitHub</a>。
      <br />
    </p>
    <p id="author">Mavis</p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      functions: [
        { id: 1, text: "註冊" },
        { id: 2, text: "登入" },
        { id: 3, text: "登出" },
        { id: 4, text: "發表文章" },
        { id: 5, text: "回應文章" },
        { id: 6, text: "針對回應按愛心(Like)" },
      ],
    };
  },
};
</script>