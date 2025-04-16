



<!-- <script setup>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { onBeforeUnmount, watch } from 'vue'

const props = defineProps({
    modelValue: String
})

const emit = defineEmits(['update:modelValue'])

const editor = new Editor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML())
    }
})

watch(() => props.modelValue, (value) => {
    if (value !== editor.getHTML()) {
        editor.commands.setContent(value)
    }
})

onBeforeUnmount(() => {
    editor.destroy()
})

</script> -->

<!-- <template>
    <div class="border rounded-md p-2">
        <EditorContent :editor="editor" />
    </div>
</template> -->