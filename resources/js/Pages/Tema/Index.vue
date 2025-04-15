<script setup>

import { onMounted } from "vue";
// import Prism from "prismjs";
// import "prismjs/themes/prism.css";
// import "prismjs/components/prism-java";

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    message: String,
    temas: Object
});

onMounted(() => {
    // Prism.highlightAll();
    if (window.Prism) {
        window.Prism.highlightAll();
    }
});

</script>

<template>
    <Head title="Tema"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800">
                Tema
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 bg-blue-100">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg bg-amber-100">
                    <div class="p-6 text-gray-900 bg-green-200 mb-4">
                        You're {{ message }}
                    </div>

                    <div class="p-6 text-gray-900 bg-green-100">
                        <div v-for="(item, key) in temas.data" :key="key">
                            <div class="mb-2 font-semibold text-lg text-gray-800">
                                {{ item.nro_tema }}. {{ item.nombre }}
                            </div>

                            <div class="mb-2 text-lg text-gray-800">
                                {{ item.definicion }}
                            </div>
                            <!-- <td> -->
                                <!-- <pre>
                                    <code class="language-java" v-html="item.ejemplo_codigo"></code>
                                </pre> -->
                                <!-- <pre class="line-numbers overflow-auto rounded-lg bg-gray-900 text-white text-sm p-4"><code class="language-java" v-html="item.ejemplo_codigo"></code></pre> -->
                            <!-- </td> -->
                            <pre class="line-numbers overflow-auto rounded-lg bg-gray-900 text-white text-sm p-4"><code class="language-java" v-html="item.ejemplo_codigo"></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
