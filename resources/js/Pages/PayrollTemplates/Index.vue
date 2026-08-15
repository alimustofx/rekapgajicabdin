<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    templates: Array,
});

const form = useForm({
    name: '',
    file: null,
});

function submit() {
    form.post(route('payroll-templates.store'), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Template Payroll" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Template Payroll
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola template Excel yang digunakan untuk proses payroll.
                </p>
            </div>
        </template>

        <div class="min-h-[calc(100vh-65px)] bg-slate-50/70">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

                <!-- Page Header -->
                <div class="mb-7">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-3.5 h-3.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 4h16v16H4z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 8h8M8 12h8M8 16h5"
                            />
                        </svg>

                        Payroll Configuration
                    </div>

                    <h1
                        class="mt-3 text-2xl sm:text-3xl font-bold tracking-tight text-slate-950"
                    >
                        Template Payroll
                    </h1>

                    <p
                        class="mt-2 text-sm leading-6 text-slate-500 max-w-2xl"
                    >
                        Upload dan kelola template Excel yang akan digunakan
                        sebagai dasar pembuatan payroll.
                    </p>
                </div>


                <!-- Main Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    <!-- Upload -->
                    <div class="lg:col-span-2">

                        <form
                            @submit.prevent="submit"
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                        >

                            <!-- Form Header -->
                            <div
                                class="px-5 sm:px-6 py-5 border-b border-slate-100"
                            >
                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-5 h-5 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 16V4"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8 8l4-4 4 4"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 13v5a2 2 0 002 2h10a2 2 0 002-2v-5"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <h3
                                            class="text-sm font-bold text-slate-900"
                                        >
                                            Upload Template
                                        </h3>

                                        <p
                                            class="text-xs text-slate-500 mt-0.5"
                                        >
                                            Tambahkan template payroll baru
                                        </p>
                                    </div>

                                </div>
                            </div>


                            <!-- Form Body -->
                            <div class="p-5 sm:p-6 space-y-5">

                                <!-- Name -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-700 mb-2"
                                    >
                                        Nama Template
                                    </label>

                                    <input
                                        v-model="form.name"
                                        type="text"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50/60 px-4 py-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:ring-[#28558f] focus:bg-white transition-colors"
                                        placeholder="Contoh: Template Payroll Agustus 2026"
                                    />

                                    <p
                                        v-if="form.errors.name"
                                        class="flex items-center gap-1.5 text-xs text-red-600 mt-2"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-3.5 h-3.5"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 8v4"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 16h.01"
                                            />
                                        </svg>

                                        {{ form.errors.name }}
                                    </p>
                                </div>


                                <!-- File -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-700 mb-2"
                                    >
                                        File Template
                                    </label>

                                    <label
                                        class="relative flex flex-col items-center justify-center w-full min-h-[150px] rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 hover:bg-blue-50/40 hover:border-blue-200 cursor-pointer transition-all duration-200"
                                    >
                                        <input
                                            type="file"
                                            accept=".xlsx,.xls"
                                            @input="
                                                form.file =
                                                    $event.target.files[0]
                                            "
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                        />

                                        <div
                                            class="w-11 h-11 rounded-xl bg-white border border-slate-200 shadow-sm flex items-center justify-center"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-5 h-5 text-[#28558f]"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 16V4"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 8l4-4 4 4"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 13v5a2 2 0 002 2h10a2 2 0 002-2v-5"
                                                />
                                            </svg>
                                        </div>

                                        <span
                                            class="mt-3 text-sm font-semibold text-slate-700 text-center px-4"
                                        >
                                            {{
                                                form.file?.name ??
                                                    'Pilih file template'
                                            }}
                                        </span>

                                        <span
                                            class="mt-1 text-xs text-slate-400"
                                        >
                                            Format .xlsx atau .xls
                                        </span>
                                    </label>

                                    <p
                                        v-if="form.errors.file"
                                        class="flex items-center gap-1.5 text-xs text-red-600 mt-2"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="w-3.5 h-3.5"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="9"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 8v4"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                d="M12 16h.01"
                                            />
                                        </svg>

                                        {{ form.errors.file }}
                                    </p>
                                </div>


                                <!-- Submit -->
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#28558f] hover:bg-[#1f4678] disabled:opacity-50 disabled:cursor-not-allowed text-white px-5 py-3 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-200"
                                >
                                    <svg
                                        v-if="!form.processing"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 16V4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 8l4-4 4 4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13v5a2 2 0 002 2h10a2 2 0 002-2v-5"
                                        />
                                    </svg>

                                    <svg
                                        v-else
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4 animate-spin"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                            class="opacity-25"
                                        />

                                        <path
                                            d="M21 12a9 9 0 00-9-9"
                                        />
                                    </svg>

                                    {{
                                        form.processing
                                            ? 'Mengunggah...'
                                            : 'Upload Template'
                                    }}
                                </button>

                            </div>


                            <!-- Footer Note -->
                            <div
                                class="px-5 sm:px-6 py-4 bg-slate-50 border-t border-slate-100"
                            >
                                <div class="flex items-start gap-2.5">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 10v6"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M12 7.5h.01"
                                        />
                                    </svg>

                                    <p
                                        class="text-[11px] leading-5 text-slate-400"
                                    >
                                        Gunakan template Excel dengan struktur
                                        kolom yang sesuai dengan sistem payroll.
                                    </p>

                                </div>
                            </div>

                        </form>

                    </div>


                    <!-- Template List -->
                    <div class="lg:col-span-3">

                        <div
                            class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden"
                        >

                            <!-- Header -->
                            <div
                                class="px-5 sm:px-6 py-5 border-b border-slate-100"
                            >
                                <div
                                    class="flex items-center justify-between gap-4"
                                >

                                    <div>
                                        <h3
                                            class="text-sm font-bold text-slate-900"
                                        >
                                            Daftar Template
                                        </h3>

                                        <p
                                            class="text-xs text-slate-500 mt-0.5"
                                        >
                                            Template payroll yang tersedia
                                        </p>
                                    </div>

                                    <div
                                        class="inline-flex items-center justify-center min-w-8 h-8 px-2 rounded-lg bg-slate-100 text-xs font-bold text-slate-600"
                                    >
                                        {{ templates.length }}
                                    </div>

                                </div>
                            </div>


                            <!-- Empty -->
                            <div
                                v-if="templates.length === 0"
                                class="flex flex-col items-center justify-center text-center px-6 py-16"
                            >
                                <div
                                    class="w-14 h-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="w-6 h-6 text-slate-400"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 4h16v16H4z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8 8h8M8 12h8M8 16h5"
                                        />
                                    </svg>
                                </div>

                                <h4
                                    class="mt-4 text-sm font-bold text-slate-800"
                                >
                                    Belum ada template
                                </h4>

                                <p
                                    class="mt-1.5 text-xs leading-5 text-slate-400 max-w-xs"
                                >
                                    Template payroll yang Anda upload akan
                                    muncul di sini.
                                </p>
                            </div>


                            <!-- List -->
                            <div v-else class="divide-y divide-slate-100">

                                <div
                                    v-for="template in templates"
                                    :key="template.id"
                                    class="p-5 sm:px-6 hover:bg-slate-50/70 transition-colors"
                                >
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4"
                                    >

                                        <!-- Template Info -->
                                        <div
                                            class="flex items-center gap-4 min-w-0"
                                        >

                                            <div
                                                class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center shrink-0"
                                            >
                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="1.8"
                                                    class="w-5 h-5 text-emerald-600"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M4 4h16v16H4z"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M8 8h8M8 12h8M8 16h5"
                                                    />
                                                </svg>
                                            </div>

                                            <div class="min-w-0">

                                                <h4
                                                    class="text-sm font-semibold text-slate-900 truncate"
                                                >
                                                    {{ template.name }}
                                                </h4>

                                                <div
                                                    class="flex items-center gap-2 mt-1.5"
                                                >
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-[10px] font-semibold"
                                                        :class="
                                                            template.is_active
                                                                ? 'bg-emerald-50 text-emerald-700'
                                                                : 'bg-slate-100 text-slate-500'
                                                        "
                                                    >
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full"
                                                            :class="
                                                                template.is_active
                                                                    ? 'bg-emerald-500'
                                                                    : 'bg-slate-400'
                                                            "
                                                        ></span>

                                                        {{
                                                            template.is_active
                                                                ? 'Aktif'
                                                                : 'Tidak Aktif'
                                                        }}
                                                    </span>

                                                    <span
                                                        class="text-[10px] text-slate-400"
                                                    >
                                                        Excel Template
                                                    </span>
                                                </div>

                                            </div>

                                        </div>


                                        <!-- Action -->
                                        <a
                                            :href="
                                                route(
                                                    'payroll-templates.download',
                                                    template.id
                                                )
                                            "
                                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-blue-50 hover:border-blue-200 text-slate-600 hover:text-[#28558f] px-4 py-2.5 text-xs font-semibold transition-colors shrink-0"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="w-4 h-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M12 4v11"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M8 11l4 4 4-4"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M5 20h14"
                                                />
                                            </svg>

                                            Download
                                        </a>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Bottom Info -->
                <div
                    class="mt-6 flex items-start gap-3 px-1"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="w-4 h-4 text-slate-400 shrink-0 mt-0.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3l7 3v5c0 4.5-2.8 7.7-7 10-4.2-2.3-7-5.5-7-10V6l7-3z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                    <p class="text-xs leading-5 text-slate-400">
                        Template digunakan sebagai struktur dasar proses payroll.
                        Pastikan file yang diunggah merupakan versi yang benar
                        sebelum digunakan dalam proses penggajian.
                    </p>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>