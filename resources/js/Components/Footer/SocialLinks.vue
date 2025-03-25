<script setup>
import InstagramIcon from "@/Components/Icons/InstagramIcon.vue";
import YoutubeIcon from "@/Components/Icons/YoutubeIcon.vue";
import TelegramIcon from "@/Components/Icons/TelegramIcon.vue";
import FacebookIcon from "@/Components/Icons/FacebookIcon.vue";

const socialLinks = [
  {icon: FacebookIcon, url: "https://www.facebook.com/ZheshtEvents/"},
  {icon: InstagramIcon, url: "https://www.instagram.com/zheshtevents/"},
  {icon: TelegramIcon, url: "https://t.me/zheshtevents"},
  {icon: YoutubeIcon, url: "https://www.youtube.com/@Zhesht"},
];
</script>

<template>
  <div class="flex gap-x-3">
    <a v-for="link in socialLinks" :key="link.url" :href="link.url" target="_blank">
      <component :is="link.icon"/>
    </a>
  </div>
</template>