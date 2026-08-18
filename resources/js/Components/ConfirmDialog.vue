<script setup>
defineProps({
    show: Boolean,
    title: String,
    message: String,
    confirmText: {
        type: String,
        default: 'Ya, Lanjutkan',
    },
});

const emit = defineEmits(['confirm', 'cancel']);
</script>

<template>
    <div
        v-if="show"
        class="fixed inset-0 z-50 bg-slate-950/40 backdrop-blur-[2px] flex items-center justify-center p-4"
        @click.self="emit('cancel')"
    >
        <div
            class="bg-white rounded-2xl border border-slate-200 shadow-xl w-full max-w-sm p-6"
        >
            <h3 class="font-semibold text-slate-900">
                {{ title }}
            </h3>

            <p class="text-sm text-slate-500 mt-2 leading-6">
                {{ message }}
            </p>

            <div class="flex justify-end gap-2 mt-5">
                <button
                    type="button"
                    @click="emit('cancel')"
                    class="px-4 py-2 text-sm text-slate-600 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors"
                >
                    Batal
                </button>

                <button
                    type="button"
                    @click="emit('confirm')"
                    class="px-4 py-2 text-sm text-white bg-[#28558f] hover:bg-[#1f4678] rounded-lg font-medium transition-colors"
                >
                    {{ confirmText }}
                </button>
            </div>
        </div>
    </div>
</template>