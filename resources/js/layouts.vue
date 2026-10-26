<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <div class="min-h-screen bg-gray-100 md:flex">
        <aside class="w-full bg-slate-900 p-5 text-white md:min-h-screen md:w-64">
            <h1 class="mb-8 text-xl font-bold">INVENTARIS BARANG</h1>

            <nav class="space-y-2">
                <Link href="/dashboard" class="block rounded-lg px-4 py-3 hover:bg-slate-700" :class="{ 'bg-slate-700': page.url === '/dashboard' }">
                    Dashboard
                </Link>

                <Link href="/barang" class="block rounded-lg px-4 py-3 hover:bg-slate-700" :class="{ 'bg-slate-700': page.url.startsWith('/barang') }">
                    Data Barang
                </Link>
            </nav>

            <div class="mt-8 border-t border-slate-700 pt-5">
                <div class="mb-3 text-sm text-slate-300">
                    {{ page.props.auth?.user?.name }}
                </div>

                <Link href="/logout" method="post" as="button" class="w-full rounded-lg bg-red-600 px-4 py-2 text-left hover:bg-red-700">
                    Logout
                </Link>
            </div>
        </aside>

        <main class="min-w-0 flex-1 p-5 md:p-8">
            <div v-if="page.props.flash?.success" class="mb-5 rounded-lg border border-green-300 bg-green-100 p-4 text-green-800">
                {{ page.props.flash.success }}
            </div>

            <div v-if="page.props.flash?.error" class="mb-5 rounded-lg border border-red-300 bg-red-100 p-4 text-red-800">
                {{ page.props.flash.error }}
            </div>

            <slot />
        </main>
    </div>
</template>
