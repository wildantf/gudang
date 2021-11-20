<x-app-layout>
    <div class="px-4 xl:px-24 py-4 xl:py-20">
        {{-- MODAL TAMBAH BARANG --}}
        @auth
            <x-modal-form
                buttonTriggerClass='text-base p-2 mb-2 bg-indigo-700 hover:bg-indigo-600 border-white focus:border-indigo-700'
                modalID='item-create' :action="route('items.store')" method='post'>
                <x-slot name="modalTitle">
                    Tambah Barang
                </x-slot>
                <x-slot name='buttonTriggerBody'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    &nbsp; Tambah Barang
                </x-slot>
                <x-slot name='modalBody'>
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                    <x-label for="stock" :value="__('Stock')" class="mt-2" />
                    <x-input id="stock" class="block mt-1 w-full" type="number" min="1" name="stock" :value="old('stock')"
                        autofocus />
                </x-slot>
                <x-slot name="approve">
                    Tambahkan
                </x-slot>

            </x-modal-form>
        @endauth

        {{-- TABEL BARANG --}}
        <x-table>
            <x-slot name="th">
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ID Barang
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Barang
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tanggal Ditambahkan
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Ditambahkan Oleh
                </th>
                {{-- Memunculkan kolom khusus staff --}}
                @hasanyrole('admin|staff')
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                @endhasanyrole
            </x-slot>
            <x-slot name="record">
                @foreach ($items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->stock }}
                        </td>
                        {{-- formating date dengan carbon --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->user->name??'' }}
                        </td>
                        @hasanyrole('admin|staff')
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex">
                                    @can('edit items')
                                        {{-- MODAL UNTUK EDIT/UPDATE --}}
                                        <x-modal-form buttonTriggerClass="bg-blue-500 hover:bg-blue-600"
                                            modalID="item-update-{{ $item->id }}"
                                            :action="route('items.update',$item->slug)" method="PUT">
                                            <x-slot name="modalTitle">
                                                Edit Barang
                                            </x-slot>
                                            <x-slot name='buttonTriggerBody'>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </x-slot>
                                            <x-slot name='modalBody'>
                                                <x-label for="name" :value="__('Name')" />
                                                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                    :value="$item->name ?? old('name')" required autofocus />
                                                <x-label for="stock" :value="__('Stock')" class="mt-2" />
                                                <x-input id="stock" class="block mt-1 w-full" type="number" min="1" name="stock"
                                                    :value="$item->stock ?? old('stock')" required autofocus />
                                            </x-slot>
                                            <x-slot name="approve">
                                                Edit
                                            </x-slot>
                                        </x-modal-form>
                                    @endcan
                                    @can('delete items')
                                        <x-modal-form buttonTriggerClass="ml-1 bg-red-500 hover:bg-red-600"
                                            modalID="item-destroy-{{ $item->id }}"
                                            :action="route('items.destroy',$item->slug)" method="DELETE">
                                            <x-slot name="modalTitle">
                                                Hapus Barang
                                            </x-slot>
                                            <x-slot name='buttonTriggerBody'>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </x-slot>
                                            <x-slot name='modalBody'>
                                                <p class="my-4 text-gray-500 text-lg leading-relaxed">
                                                    Anda akan menghapus barang <span class="italic font-bold">
                                                        {{ $item->name }} </span>.
                                                </p>
                                            </x-slot>
                                            <x-slot name="approve">
                                                Hapus
                                            </x-slot>
                                        </x-modal-form>

                                    @endcan
                                </div>
                            </td>
                        @endhasanyrole
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>

</x-app-layout>
