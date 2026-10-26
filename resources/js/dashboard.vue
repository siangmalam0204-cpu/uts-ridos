<script setup>
import BarangLayout from '@/Layouts/BarangLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BarangLayout>
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
            <p class="mt-2 text-gray-600">Selamat datang di Sistem Informasi Inventaris Barang Kantor.</p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div class="rounded-xl bg-white p-6 shadow">
                <h3 class="text-lg font-semibold text-gray-700">Pengelolaan Barang</h3>
                <p class="my-3 text-sm text-gray-500">Tambahkan, lihat, ubah, dan hapus data barang kantor.</p>
                <Link href="/barang" class="inline-block rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
                    Buka Data Barang
                </Link>
            </div>

            <div class="rounded-xl bg-white p-6 shadow">
                <h3 class="text-lg font-semibold text-gray-700">Informasi Sistem</h3>
                <p class="mt-3 text-gray-600">Aplikasi untuk mengelola inventaris barang kantor.</p>
            </div>
        </div>
    </BarangLayout>
</template>
