<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">


            <div class="grid gap-6 xl:grid-cols-3">
                <div class="xl:col-span-2 glass-panel rounded-xl p-5 md:p-7 border border-white/10 shadow-xl">
                    <livewire:profile.update-profile-information-form />
                </div>

                <div class="space-y-6">
                    <div class="glass-panel rounded-xl p-5 md:p-6 border border-white/10 shadow-xl">
                        <livewire:profile.update-password-form />
                    </div>

                    <div class="glass-panel rounded-xl p-5 md:p-6 border border-red-500/20 shadow-xl">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
