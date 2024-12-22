<template>
    <QuillEditor class="quill-with-upload"
                 style="min-height: 300px"
                 :modules="modules" contentType="html"
                 toolbar="full"/>
</template>

<script setup>
import ImageUploader from 'quill-image-uploader';
import {QuillEditor} from '@vueup/vue-quill'

const modules = {
    name: 'imageUploader',
    module: ImageUploader,
    options: {
        upload: file => {
            return new Promise((resolve, reject) => {
                const formData = new FormData();
                formData.append('image', file);

                axios.post('/upload-image', formData, {
                    headers: {
                        'X-CSRF-TOKEN': document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN')).split('=')[1]
                    }
                })
                    .then(res => {
                        resolve(res.data.url);
                    })
                    .catch(err => {
                        reject("Upload failed");
                    })
            })
        }
    },
}
</script>
<style>
.quill-with-upload {
    .ql-editor {
        .ql-align-center img {
            margin: 0 auto !important;
        }

        .ql-align-right img {
            float: right !important;
        }
    }
}
</style>
