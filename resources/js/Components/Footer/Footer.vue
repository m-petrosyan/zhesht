<script setup>
import FacebookIcon from "@/Components/Icons/FacebookIcon.vue";
import InstagramIcon from "@/Components/Icons/InstagramIcon.vue";
import TelegramIcon from "@/Components/Icons/TelegramIcon.vue";
</script>

<template>
    <div class="w-full bg-black text-white">
        <div class="lg:w-3/5 md:w-full mx-auto py-10">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-3xl">Subscribe to new events</h3>
                    <small>We will send you a notification when there are new events</small>
                </div>
                <div class="flex gap-x-5 w-3/5">
                    <input class="w-1/2 rounded-2xl text-black" type="text" placeholder="Email Address">
                    <button class="border-2 border-main text-main py-2 px-5 rounded-2xl text-lg">Subscribe</button>
                </div>
            </div>
            <div class="flex justify-between mt-20">
                <div>
                    <p>© 2024 ZhestEvents</p>
                </div>
                <div class="flex gap-x-3">
                    <FacebookIcon/>
                    <InstagramIcon/>
                    <TelegramIcon/>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
