<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    type: String,
});

function kosong() {
    return {
        nama: '',
        nip: '',
        kategori: 'Kenaikan Pangkat',
        file: null,

        gol_baru: '',
        istri_suami_baru: '',
        anak_baru: '',
        gaji_pokok_baru: '',
        tunj_struktural_baru: '',
        tunj_fungsional_baru: '',
        masa_kerja_baru: '',

        gol_lama: '',
        istri_suami_lama: '',
        anak_lama: '',
        gaji_pokok_lama: '',
        tunj_struktural_lama: '',
        tunj_fungsional_lama: '',
        masa_kerja_lama: '',
    };
}

const form = useForm({
    items: [kosong()],
});

function tambahBaris() {
    form.items.push(kosong());
}

function hapusBaris(i) {
    form.items.splice(i, 1);
}

function submit() {
    form.post(route('change-submissions.store', props.type), {
        forceFormData: true,
    });
}
</script>

<template>
    <Head title="Lapor Perubahan Gaji" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2
                        class="text-xl font-bold tracking-tight text-slate-900"
                    >
                        Lapor Perubahan Gaji
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Ajukan perubahan data gaji pegawai {{ type }}.
                    </p>
                </div>

                <div
                    class="hidden sm:flex items-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-3 py-2"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-4 w-4 text-[#28558f]"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 3h5v5"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 3l-7 7"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 13v5a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5"
                        />
                    </svg>

                    <span
                        class="text-xs font-semibold text-[#28558f]"
                    >
                        {{ type }}
                    </span>
                </div>
            </div>
        </template>

        <div class="min-h-full bg-slate-50/70 py-6 sm:py-8">
            <div
                class="mx-auto max-w-5xl space-y-5 px-4 sm:px-6 lg:px-8"
            >

                <!-- Mobile Type -->
                <div
                    class="flex items-center gap-3 rounded-2xl border border-blue-100 bg-white px-4 py-3 shadow-sm sm:hidden"
                >
                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4 text-[#28558f]"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 3h5v5"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 3l-7 7"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 13v5a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5"
                            />
                        </svg>
                    </div>

                    <div>
                        <p
                            class="text-[10px] font-semibold uppercase tracking-wider text-slate-400"
                        >
                            Jenis Pegawai
                        </p>

                        <p class="text-sm font-semibold text-slate-800">
                            {{ type }}
                        </p>
                    </div>
                </div>


                <!-- Information -->
                <div
                    class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 sm:p-5"
                >
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white shadow-sm"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-4 w-4 text-[#28558f]"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />
                                <path
                                    stroke-linecap="round"
                                    d="M12 11v5M12 8h.01"
                                />
                            </svg>
                        </div>

                        <div>
                            <p
                                class="text-sm font-semibold text-slate-800"
                            >
                                Petunjuk Pengisian
                            </p>

                            <p
                                class="mt-1 text-xs leading-5 text-slate-500"
                            >
                                Isi data pegawai dengan lengkap. Data lama
                                digunakan sebagai pembanding dengan data baru.
                                Lampirkan SK atau dokumen pendukung dalam format
                                PDF atau gambar.
                            </p>
                        </div>
                    </div>
                </div>


                <!-- Employee Forms -->
                <div
                    v-for="(item, i) in form.items"
                    :key="i"
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                >

                    <!-- Form Header -->
                    <div
                        class="flex items-center justify-between border-b border-slate-100 bg-slate-50/70 px-5 py-4 sm:px-6"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-[#28558f]"
                            >
                                {{ i + 1 }}
                            </div>

                            <div>
                                <h3
                                    class="text-sm font-bold text-slate-900"
                                >
                                    Data Pegawai
                                </h3>

                                <p
                                    class="mt-0.5 text-[11px] text-slate-400"
                                >
                                    Pegawai #{{ i + 1 }}
                                </p>
                            </div>
                        </div>

                        <button
                            v-if="form.items.length > 1"
                            @click="hapusBaris(i)"
                            type="button"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-100 bg-red-50 px-3 py-2 text-[11px] font-semibold text-red-600 transition hover:bg-red-100"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-3.5 w-3.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    d="M4 7h16M10 11v6M14 11v6"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 7l1 14h10l1-14M9 7V4h6v3"
                                />
                            </svg>

                            Hapus
                        </button>
                    </div>


                    <div class="p-5 sm:p-6">

                        <!-- Identity -->
                        <div class="mb-6">
                            <div class="mb-3 flex items-center gap-2">
                                <div
                                    class="h-1.5 w-1.5 rounded-full bg-[#28558f]"
                                ></div>

                                <p
                                    class="text-[11px] font-bold uppercase tracking-wider text-slate-500"
                                >
                                    Identitas Pegawai
                                </p>
                            </div>

                            <div
                                class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                            >
                                <div>
                                    <label
                                        class="mb-1.5 block text-xs font-semibold text-slate-600"
                                    >
                                        Nama Pegawai
                                    </label>

                                    <input
                                        v-model="item.nama"
                                        type="text"
                                        placeholder="Masukkan nama lengkap"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                                    />
                                </div>

                                <div>
                                    <label
                                        class="mb-1.5 block text-xs font-semibold text-slate-600"
                                    >
                                        NIP
                                    </label>

                                    <input
                                        v-model="item.nip"
                                        type="text"
                                        placeholder="Masukkan NIP"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                                    />
                                </div>
                            </div>
                        </div>


                        <!-- Category -->
                        <div class="mb-6">
                            <label
                                class="mb-1.5 block text-xs font-semibold text-slate-600"
                            >
                                Jenis Perubahan
                            </label>

                            <select
                                v-model="item.kategori"
                                class="w-full rounded-xl border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-700 focus:border-[#28558f] focus:bg-white focus:ring-[#28558f]"
                            >
                                <option>Kenaikan Pangkat</option>
                                <option>
                                    Kenaikan Gaji Berkala
                                </option>
                                <option>
                                    Perubahan Tunjangan Anak
                                </option>
                                <option>
                                    Perubahan Tunjangan Istri/Suami
                                </option>
                                <option>Lainnya</option>
                            </select>
                        </div>


                        <!-- Old / New Data -->
                        <div
                            class="grid grid-cols-1 gap-5 lg:grid-cols-2"
                        >

                            <!-- Data Lama -->
                            <div
                                class="rounded-2xl border border-slate-200 bg-slate-50/60 p-4 sm:p-5"
                            >
                                <div
                                    class="mb-4 flex items-center gap-3"
                                >
                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-4 w-4 text-slate-500"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 19V5M5 12l7-7 7 7"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-bold text-slate-800"
                                        >
                                            Data Lama
                                        </p>

                                        <p
                                            class="text-[11px] text-slate-400"
                                        >
                                            Data sebelum perubahan
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-3">

                                    <input
                                        v-model="item.gol_lama"
                                        placeholder="Golongan"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.istri_suami_lama"
                                        placeholder="Istri/Suami"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.anak_lama"
                                        placeholder="Jumlah Anak"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.gaji_pokok_lama"
                                        placeholder="Gaji Pokok"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.tunj_struktural_lama"
                                        placeholder="Tunj. Struktural"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.tunj_fungsional_lama"
                                        placeholder="Tunj. Fungsional"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.masa_kerja_lama"
                                        placeholder="Masa Kerja"
                                        class="w-full rounded-xl border-slate-200 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                </div>
                            </div>


                            <!-- Data Baru -->
                            <div
                                class="rounded-2xl border border-blue-100 bg-blue-50/40 p-4 sm:p-5"
                            >
                                <div
                                    class="mb-4 flex items-center gap-3"
                                >
                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-4 w-4 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 5v14M5 12h14"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-bold text-slate-800"
                                        >
                                            Data Baru
                                        </p>

                                        <p
                                            class="text-[11px] text-slate-400"
                                        >
                                            Data setelah perubahan
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-3">

                                    <input
                                        v-model="item.gol_baru"
                                        placeholder="Golongan"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.istri_suami_baru"
                                        placeholder="Istri/Suami"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.anak_baru"
                                        placeholder="Jumlah Anak"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.gaji_pokok_baru"
                                        placeholder="Gaji Pokok"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.tunj_struktural_baru"
                                        placeholder="Tunj. Struktural"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.tunj_fungsional_baru"
                                        placeholder="Tunj. Fungsional"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                    <input
                                        v-model="item.masa_kerja_baru"
                                        placeholder="Masa Kerja"
                                        class="w-full rounded-xl border-blue-100 bg-white text-sm focus:border-[#28558f] focus:ring-[#28558f]"
                                    />

                                </div>
                            </div>

                        </div>


                        <!-- Supporting File -->
                        <div class="mt-6">
                            <div
                                class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/60 p-4 sm:p-5"
                            >
                                <div
                                    class="mb-3 flex items-center gap-3"
                                >
                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white shadow-sm"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-4 w-4 text-[#28558f]"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 16V4m0 0L8 8m4-4l4 4"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12v6a2 2 0 002 2h10a2 2 0 002-2v-6"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <p
                                            class="text-sm font-semibold text-slate-800"
                                        >
                                            SK Pendukung
                                        </p>

                                        <p
                                            class="text-[11px] text-slate-400"
                                        >
                                            PDF, JPG, JPEG, atau PNG
                                        </p>
                                    </div>
                                </div>

                                <input
                                    type="file"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    @input="
                                        item.file =
                                            $event.target.files[0]
                                    "
                                    class="block w-full text-xs text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-[#28558f] hover:file:bg-blue-100"
                                />
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Add Employee -->
                <button
                    @click="tambahBaris"
                    type="button"
                    class="group flex w-full items-center justify-center gap-2 rounded-2xl border border-dashed border-blue-200 bg-white px-5 py-4 text-sm font-semibold text-[#28558f] shadow-sm transition hover:border-blue-300 hover:bg-blue-50/50"
                >
                    <span
                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 transition group-hover:bg-blue-100"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>
                    </span>

                    Tambah Pegawai Lain
                </button>


                <!-- Submit Card -->
                <div
                    class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-6"
                >
                    <div>
                        <p
                            class="text-sm font-semibold text-slate-800"
                        >
                            Kirim Pengajuan
                        </p>

                        <p
                            class="mt-1 text-xs text-slate-500"
                        >
                            Pastikan seluruh data sudah diperiksa sebelum
                            dikirim.
                        </p>
                    </div>

                    <button
                        @click="submit"
                        :disabled="form.processing"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#28558f] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#214873] disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto"
                    >
                        <svg
                            v-if="!form.processing"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2L11 13"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2l-7 20-4-9-9-4 20-7z"
                            />
                        </svg>

                        <svg
                            v-else
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4 animate-spin"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                class="opacity-30"
                            />
                            <path
                                stroke-linecap="round"
                                d="M21 12a9 9 0 00-9-9"
                            />
                        </svg>

                        {{
                            form.processing
                                ? 'Mengirim...'
                                : 'Kirim Pengajuan'
                        }}
                    </button>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>