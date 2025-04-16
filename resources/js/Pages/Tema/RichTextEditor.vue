<script setup>
import { ref, onMounted } from 'vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import TextStyle from '@tiptap/extension-text-style'
import Color from '@tiptap/extension-color'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
  content: props.modelValue,
  extensions: [
    StarterKit,
    TextStyle,
    Color,
  ],
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML())
  },
})
</script>

<template>
  <div v-if="editor">
    <!-- Toolbar -->
    <div class="mb-2 space-x-2">
      <button 
        @click="editor.chain().focus().toggleBold().run()"
        :class="{'bg-blue-500 text-white': editor?.isActive('bold')}"
        class="px-2 py-1 border rounded"
      >
        Negrita
      </button>

      <button 
        @click="editor.chain().focus().toggleItalic().run()"
        :class="{'bg-blue-500 text-white': editor?.isActive('italic')}"
        class="px-2 py-1 border rounded"
      >
        Cursiva
      </button>

      <button 
        @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
        :class="{'bg-blue-500 text-white': editor?.isActive('heading', { level: 1 })}"
        class="px-2 py-1 border rounded"
      >
        H1
      </button>

      <button 
        @click="editor.chain().focus().setColor('red').run()"
        class="px-2 py-1 border rounded bg-red-100 text-red-700"
      >
        Rojo
      </button>
    </div>

    <!-- Editor -->
    <EditorContent :editor="editor" class="border rounded p-2 min-h-[120px]" />
  </div>
</template>
