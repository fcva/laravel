<script setup>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue'
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

const props = defineProps({
  modelValue: String
})
const emit = defineEmits(['update:modelValue'])

const editor = ref(null)

onMounted(() => {
  editor.value = new Editor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
      emit('update:modelValue', editor.getHTML())
    }
  })
})

onBeforeUnmount(() => {
  if (editor.value) {
    editor.value.destroy()
  }
})

// Actualizar contenido si cambia desde fuera
watch(() => props.modelValue, (newVal) => {
  if (editor.value && newVal !== editor.value.getHTML()) {
    editor.value.commands.setContent(newVal)
  }
})
</script>

<template>
    <div v-if="editor">
        <div class="mb-6">
            <div class="flex flex-wrap gap-2 mb-2">
            <button
                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                @click="editor?.chain().focus().toggleBold().run()"
                :class="{ 'bg-gray-400': editor?.isActive('bold') }"
            >
                Negrita
            </button>
            <button
                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'bg-gray-400': editor.isActive('italic') }"
            >
                Cursiva
            </button>
            <button
                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                :class="{ 'bg-gray-400': editor.isActive('heading', { level: 1 }) }"
            >
                H1
            </button>
            <button
                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'bg-gray-400': editor.isActive('bulletList') }"
            >
                Lista
            </button>
            <button
                class="px-3 py-1 bg-red-100 rounded hover:bg-red-200"
                @click="editor.chain().focus().unsetAllMarks().clearNodes().run()"
            >
                Limpiar
            </button>
            </div>

            <EditorContent :editor="editor" class="bg-white p-4 border rounded shadow-md min-h-[200px]" />
        </div>
    </div>
</template>