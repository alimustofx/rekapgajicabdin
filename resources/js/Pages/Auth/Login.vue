<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
        <Head title="Masuk - Sistem Monitoring Gaji Cabdin" />

        <div class="min-h-screen bg-slate-50 flex">

            <!-- LEFT PANEL -->
            <div
                class="hidden lg:flex lg:w-[52%] relative overflow-hidden bg-[#0d1e35]"
            >
                <!-- Background -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#17385f] via-[#28558f] to-[#0d1e35]"
                ></div>

                <div
                    class="absolute -top-32 -right-32 w-[520px] h-[520px] rounded-full border border-white/10"
                ></div>

                <div
                    class="absolute -bottom-48 -left-32 w-[620px] h-[620px] rounded-full border border-white/5"
                ></div>

                <div
                    class="absolute top-1/3 right-[-80px] w-72 h-72 rounded-full bg-blue-400/10 blur-3xl"
                ></div>

                <div
                    class="relative z-10 flex flex-col justify-between w-full p-12 xl:p-16"
                >
                    <!-- Brand -->
                    <div class="flex items-center gap-3">
                        <div
                            class="w-11 h-11 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center"
                        >
                            <svg
                                viewBox="0 0 40 40"
                                fill="none"
                                class="w-8 h-8"
                            >
                                <path
                                    d="M20 4L7 11.5V28.5L20 36L33 28.5V11.5L20 4Z"
                                    stroke="white"
                                    stroke-width="3"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M20 4V20M20 20L7 27.5M20 20L33 12.5"
                                    stroke="white"
                                    stroke-width="3"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>

                        <div class="leading-tight">
                            <div class="font-bold text-white text-lg">
                                Sistem Monitoring Gaji Cabdin
                            </div>

                            <div class="text-xs text-blue-100/70 mt-0.5">
                                Cabang Dinas Pendidikan
                            </div>
                        </div>
                    </div>

                    <!-- Main Copy -->
                    <div class="max-w-xl">
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/10 text-blue-100 text-xs font-semibold mb-6"
                        >
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-blue-300"
                            ></span>

                            Platform Monitoring Cabdin
                        </div>

                        <h1
                            class="text-4xl xl:text-5xl font-bold text-white leading-[1.08] tracking-tight"
                        >
                            Kelola data gaji dan payroll
                            <span class="text-blue-200">
                                lebih terstruktur.
                            </span>
                        </h1>

                        <p
                            class="mt-6 text-base leading-7 text-blue-100/75 max-w-lg"
                        >
                            Satu sistem untuk menerima rekap gaji, melakukan
                            pengecekan, memperbaiki data yang belum sesuai,
                            hingga pengiriman payroll untuk proses approval
                            Cabang Dinas.
                        </p>

                        <!-- Process Preview -->
                        <div
                            class="mt-9 bg-white/[0.07] border border-white/10 rounded-2xl p-5 max-w-lg"
                        >
                            <div
                                class="text-[11px] uppercase tracking-wider font-semibold text-blue-200/70 mb-5"
                            >
                                Alur Sistem
                            </div>

                            <div class="space-y-4">

                                <!-- Step -->
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-400/10 border border-blue-200/10 flex items-center justify-center shrink-0"
                                    >
                                        <span
                                            class="text-[11px] font-bold text-blue-200"
                                        >
                                            01
                                        </span>
                                    </div>

                                    <div class="flex-1">
                                        <div
                                            class="text-xs font-semibold text-white"
                                        >
                                            Rekap Gaji
                                        </div>

                                        <div
                                            class="text-[10px] text-blue-100/50"
                                        >
                                            Diterima dari Cabdin
                                        </div>
                                    </div>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4 text-blue-200/40"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14m-5-5l5 5-5 5"
                                        />
                                    </svg>
                                </div>

                                <!-- Step -->
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-400/10 border border-blue-200/10 flex items-center justify-center shrink-0"
                                    >
                                        <span
                                            class="text-[11px] font-bold text-blue-200"
                                        >
                                            02
                                        </span>
                                    </div>

                                    <div class="flex-1">
                                        <div
                                            class="text-xs font-semibold text-white"
                                        >
                                            Pengecekan Operator
                                        </div>

                                        <div
                                            class="text-[10px] text-blue-100/50"
                                        >
                                            Validasi dan pemeriksaan data
                                        </div>
                                    </div>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4 text-blue-200/40"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14m-5-5l5 5-5 5"
                                        />
                                    </svg>
                                </div>

                                <!-- Step -->
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-400/10 border border-emerald-200/10 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="w-4 h-4 text-emerald-300"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12l4 4L19 6"
                                            />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <div
                                            class="text-xs font-semibold text-white"
                                        >
                                            FIX
                                        </div>

                                        <div
                                            class="text-[10px] text-blue-100/50"
                                        >
                                            Data PNS & PPPK sesuai
                                        </div>
                                    </div>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4 text-blue-200/40"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14m-5-5l5 5-5 5"
                                        />
                                    </svg>
                                </div>

                                <!-- Step -->
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-400/10 border border-blue-200/10 flex items-center justify-center shrink-0"
                                    >
                                        <span
                                            class="text-[11px] font-bold text-blue-200"
                                        >
                                            04
                                        </span>
                                    </div>

                                    <div class="flex-1">
                                        <div
                                            class="text-xs font-semibold text-white"
                                        >
                                            Payroll
                                        </div>

                                        <div
                                            class="text-[10px] text-blue-100/50"
                                        >
                                            Dikirim untuk approval Cabdin
                                        </div>
                                    </div>

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="w-4 h-4 text-blue-200/40"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 12h14m-5-5l5 5-5 5"
                                        />
                                    </svg>
                                </div>

                                <!-- Step -->
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-amber-400/10 border border-amber-200/10 flex items-center justify-center shrink-0"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="w-4 h-4 text-amber-300"
                                        >
                                            <circle
                                                cx="12"
                                                cy="12"
                                                r="8"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                d="M12 8v4l3 2"
                                            />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        <div
                                            class="text-xs font-semibold text-white"
                                        >
                                            Approval Cabdin
                                        </div>

                                        <div
                                            class="text-[10px] text-blue-100/50"
                                        >
                                            Menunggu persetujuan
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Bottom -->
                    <div class="text-xs text-blue-100/45">
                        Sistem internal · Akses terbatas untuk Admin & Operator
                    </div>
                </div>
            </div>


            <!-- RIGHT PANEL -->
            <div
                class="flex-1 flex flex-col min-h-screen bg-white"
            >
                <!-- Mobile Brand -->
                <div
                    class="lg:hidden px-6 py-5 border-b border-slate-100"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-[#28558f] flex items-center justify-center shrink-0"
                        >
                            <svg
                                viewBox="0 0 40 40"
                                fill="none"
                                class="w-7 h-7"
                            >
                                <path
                                    d="M20 4L7 11.5V28.5L20 36L33 28.5V11.5L20 4Z"
                                    stroke="white"
                                    stroke-width="3"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M20 4V20M20 20L7 27.5M20 20L33 12.5"
                                    stroke="white"
                                    stroke-width="3"
                                />
                            </svg>
                        </div>

                        <div class="leading-tight">
                            <div class="font-bold text-slate-950">
                                Sistem Monitoring Gaji Cabdin
                            </div>

                            <div class="text-xs text-slate-500 mt-0.5">
                                Cabang Dinas Pendidikan
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Area -->
                <div
                    class="flex-1 flex items-center justify-center px-6 py-10 sm:px-10"
                >
                    <div class="w-full max-w-md">

                        <!-- Heading -->
                        <div class="mb-8">
                            <div
                                class="inline-flex items-center px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-[#28558f] text-xs font-semibold mb-4"
                            >
                                Akses Sistem
                            </div>

                            <h2
                                class="text-3xl font-bold tracking-tight text-slate-950"
                            >
                                Selamat datang kembali
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Masuk untuk mengelola monitoring gaji dan proses
                                payroll Cabang Dinas.
                            </p>
                        </div>

                        <!-- Status -->
                        <div
                            v-if="status"
                            class="mb-5 rounded-lg border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700"
                        >
                            {{ status }}
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submit">

                            <!-- Email -->
                            <div>
                                <InputLabel
                                    for="email"
                                    value="Email"
                                    class="!text-sm !font-semibold !text-slate-700"
                                />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-2 block w-full !rounded-xl !border-slate-200 !bg-slate-50/50 !px-4 !py-3 focus:!border-[#28558f] focus:!ring-[#28558f]"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan email"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>


                            <!-- Password -->
                            <div class="mt-5">
                                <div class="flex items-center justify-between">
                                    <InputLabel
                                        for="password"
                                        value="Password"
                                        class="!text-sm !font-semibold !text-slate-700"
                                    />

                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                        class="text-xs font-medium text-[#28558f] hover:text-[#1f4678]"
                                    >
                                        Lupa password?
                                    </Link>
                                </div>

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-2 block w-full !rounded-xl !border-slate-200 !bg-slate-50/50 !px-4 !py-3 focus:!border-[#28558f] focus:!ring-[#28558f]"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>


                            <!-- Remember -->
                            <div class="mt-5">
                                <label class="flex items-center cursor-pointer">
                                    <Checkbox
                                        name="remember"
                                        v-model:checked="form.remember"
                                    />

                                    <span class="ms-2 text-sm text-slate-500">
                                        Ingat saya di perangkat ini
                                    </span>
                                </label>
                            </div>


                            <!-- Submit -->
                            <div class="mt-7">
                                <PrimaryButton
                                    class="!w-full !justify-center !rounded-xl !bg-[#28558f] hover:!bg-[#1f4678] !py-3 !text-sm !font-semibold !shadow-sm hover:!shadow-md transition-all duration-200"
                                    :class="{
                                        'opacity-50': form.processing
                                    }"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing">
                                        Memproses...
                                    </span>

                                    <span v-else class="flex items-center justify-center gap-2">
                                        Masuk ke Sistem

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h14m-6-6l6 6-6 6"
                                            />
                                        </svg>
                                    </span>
                                </PrimaryButton>
                            </div>

                            <!-- Security Note -->
                            <div
                                class="mt-6 flex items-start gap-3 rounded-xl bg-slate-50 border border-slate-100 px-4 py-3.5"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="w-5 h-5 text-[#28558f] shrink-0 mt-0.5"
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

                                <div>
                                    <div
                                        class="text-xs font-semibold text-slate-700"
                                    >
                                        Akses sistem terbatas
                                    </div>

                                    <div
                                        class="text-[11px] leading-5 text-slate-400 mt-0.5"
                                    >
                                        Akun pengguna dikelola oleh Admin
                                        Cabang Dinas.
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Footer -->
                        <div
                            class="mt-8 pt-6 border-t border-slate-100 text-center"
                        >
                            <p class="text-[11px] text-slate-400">
                                Sistem Monitoring Gaji Cabdin
                            </p>

                            <p class="text-[10px] text-slate-300 mt-1">
                                Cabang Dinas Pendidikan
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
</template>