<script setup>

import { onMounted, ref } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import RichTextEditor from "./RichTextEditor.vue";

defineProps({
    message: String,
    temas: Object
});

const editando = ref({})
const definicionesEditadas = ref({})

// console.log(editando);

const activarEdicion = (id, definicionActual) => {

    // console.log(id, definicionActual);
    
    editando.value[id] = true;
    definicionesEditadas.value[id] = definicionActual;
}

const guardarDefinicion = (id) => {

    // console.log(id);
    
    router.put(`/tema/${id}`, {
        definicion: definicionesEditadas.value[id]
    }, {
        onSuccess: () => {
            editando.value[id] = false;
        }
    })
}


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

                            <!-- modo edicion -->
                            <template v-if="editando[item._id]">
                                
                                <!-- <textarea v-model="definicionesEditadas[item._id]" class="w-full p-2 border rounded resize-none" rows="3"></textarea> -->
                                
                                <RichTextEditor v-model="definicionesEditadas[item._id]" />
                                
                                <button 
                                    class="px-4 py-1 mt-2 text-white bg-green-600 rounded hover:bg-green-700"
                                    @click="guardarDefinicion(item._id)">
                                    Guardar
                                </button>
                            </template>

                            <!-- modo lectura -->
                            <template v-else>
                                <p class="p-2 bg-gray-100 rounded" v-html="item.definicion">
                                </p>
                                <button
                                    class="px-4 py-1 mt-2 text-white bg-blue-600 rounded hover:bg-blue-700"
                                    @click="activarEdicion(item._id, item.definicion)">
                                    Editar
                                </button>
                                <!-- <button @click="console.log('ID:', item._id); activarEdicion(item._id, item.definicion)">Editar</button> -->

                            </template>

                            <pre class="line-numbers overflow-auto rounded-lg bg-gray-900 text-white text-sm p-4"><code class="language-java" v-html="item.ejemplo_codigo"></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
