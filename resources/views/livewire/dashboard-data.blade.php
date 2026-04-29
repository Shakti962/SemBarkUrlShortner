<div>
    <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default mt-4">
        <div class="p-4 flex items-center justify-between space-x-4">
            <h3 class="text-lg text-[#6875F5] font-semibold">Generated URLs</h3>
            <div class="">
                @unless(auth()->user()->isSuperAdmin())
                    <a href="{{ route('url') }}" class="bg-[#6875F5] py-1 px-4 text-white rounded">Generate
                        URL</a>
                @endunless
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
            <a href="{{ route('url') }}" class="bg-[#6875F5] py-1 px-4 text-white rounded text-xs">View All &#8594</a>
        </nav>
    </div>
    @if (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
        <div class="overflow-x-auto bg-white shadow-xs rounded-base border border-default mt-4">
            <div class="p-4 flex items-center justify-between space-x-4">
                <h3 class="text-lg text-[#6875F5] font-semibold">
                    {{ auth()->user()->isSuperAdmin() ? 'Company' : 'Team Member' }}
                </h3>
                <a href="{{ route('invite') }}" class="bg-[#6875F5] py-1 px-4 text-white rounded">Invite</a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-body">
                @if (auth()->user()->isSuperAdmin())
                    <thead class="text-sm font-bold border-b border-t border-default-medium">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Users
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Generated URLs
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total URL Clicks
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($companies as $company)
                            <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $company->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $company->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $company->users_count }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $company->urls_count }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $company->urlClicks->sum('count') }}
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
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Generated URLs
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total URL Clicks
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($team as $member)
                            <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $member->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $member->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $member->role }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $member->urls_count }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $member->urlClicks->sum('count') }}
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
        </div>
    @endif
</div>