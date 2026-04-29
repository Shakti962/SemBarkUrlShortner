<div>
    @unless (auth()->user()->isSuperAdmin())
        <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default mb-4">
            <div class="pt-4 px-4 flex items-center justify-between space-x-4">
                <h3 class="text-lg text-[#6875F5] font-semibold">Generate URLs</h3>
            </div>
            <div class="pt-2 p-4">
                <x-input id="url" wire:model="url" class="block mt-1 w-full" type="text" name="url"
                    placeholder="e.g. https://a-very-long-url.com" required autofocus />
                @error('url')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <x-button wire:click="generate()" class="mt-4 bg-[#6875F5]">Generate</x-button>
            </div>
        </div>
    @endunless
    <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default mt-4">
        <div class="p-4 flex items-center justify-between space-x-4">
            <h3 class="text-lg text-[#6875F5] font-semibold">Generated URLs</h3>
            <div class="relative flex items-center">
                <svg class="absolute w-5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                </svg>
                <select wire:model.live="filterDays" name="filterDays" id="filterDays" class="pl-8 p-1 rounded border">
                    <option value="0" selected>Today</option>
                    <option value="7">Last 7 Days</option>
                    <option value="30">Last 30 Days</option>
                </select>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-body table-fixed">
            @if (auth()->user()->isSuperAdmin())
                <thead class="text-sm font-bold border-b border-t border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Short URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Long URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clicks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Company
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created On
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($urls as $url)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap truncate"
                                title="{{ config('app.url') . '/' . $url->short_code }}">
                                {{ config('app.url') . '/' . $url->short_code }}
                            </th>
                            <td class="px-6 py-4 truncate" title="{{ $url->original_url }}">
                                {{ $url->original_url }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->clicks->sum('count') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->company->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->created_at->format("d M 'y") }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                No URLs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            @elseif(auth()->user()->isAdmin())
                <thead class="text-sm font-bold border-b border-t border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Short URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Long URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clicks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created On
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($urls as $url)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap truncate"
                                title="{{ config('app.url') . '/' . $url->short_code }}">
                                {{ config('app.url') . '/' . $url->short_code }}
                            </th>
                            <td class="px-6 py-4 truncate" title="{{ $url->original_url }}">
                                {{ $url->original_url }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->clicks->sum('count') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->created_at->format("d M 'y") }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                No URLs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            @else
                <thead class="text-sm font-bold border-b border-t border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Short URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Long URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clicks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created On
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($urls as $url)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap truncate"
                                title="{{ config('app.url') . '/' . $url->short_code }}">
                                {{ config('app.url') . '/' . $url->short_code }}
                            </th>
                            <td class="px-6 py-4 truncate" title="{{ $url->original_url }}">
                                {{ $url->original_url }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->clicks->sum('count') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $url->created_at->format("d M 'y") }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center">
                                No URLs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            @endif
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-4"
            aria-label="Table navigation">
            {{ $urls->links() }}
        </nav>
    </div>
</div>