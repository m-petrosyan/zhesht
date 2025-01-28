<script setup>
import FacebookIcon from "@/Components/Icons/FacebookIcon.vue";
import InstagramIcon from "@/Components/Icons/InstagramIcon.vue";
import TelegramIcon from "@/Components/Icons/TelegramIcon.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import ErrorMessages from "@/Components/Ui/ErrorMessages.vue";

const form = useForm({
    email: '',
});
const isSubscribed = ref(false);

const submit = () => {
    form.post(route('subscribe'), {
        preserveScroll: true,
        onSuccess: () => {
            isSubscribed.value = !isSubscribed.value;
            form.email = '';
        },
    });
};
</script>

<template>
    <div class="w-full bg-black text-white px-10 lg:px-0" id="footer">
        <div class="lg:w-3/5 md:w-full mx-auto py-10">
            <div class="flex lg:flex-row flex-col gap-y-10 items-center justify-between lg:gap-x-0 gap-x-10">
                <div class="flex-col text-center text-balance">
                    <h3 class="text-3xl">Subscribe to new events</h3>
                    <small>We will send you a notification when there are new events</small>
                </div>
                <form @submit.prevent="submit"
                      class="flex flex-col sm:flex-row gap-y-4 gap-x-5 lg:w-3/5 w-full lg:justify-start justify-center">
                    <b v-if="isSubscribed" class="text-green-600">Thank you! You are now subscribed to updates about new
                        events.</b>
                    <input v-model="form.email" class="sm:w-1/2 w-full rounded-2xl text-black" type="text"
                           placeholder="Email Address">
                    <button class="sm:w-auto w-full border-2 border-main text-main py-2 px-5 rounded-2xl text-lg">
                        Subscribe
                    </button>
                    <ErrorMessages simple="true" :messages="$page.props.errors"/>
                </form>
            </div>
            <div class="flex justify-between mt-20">
                <div>
                    <p>© {{ new Date().getFullYear() }} ZhestEvents</p>
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
