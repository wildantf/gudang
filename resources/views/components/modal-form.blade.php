{{-- @props(['method' => 'post']) --}}

<!-- Button trigger modal -->

<x-button :class="$buttonTriggerClass" type="button" onclick="toggleModal('modal-{{ $modalID }}')">
    {{ $buttonTriggerBody }}
</x-button>
<!-- Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
    id="modal-{{ $modalID }}">
    <div class="relative w-full my-6 mx-auto max-w-lg">
        <!--content-->
        <div
            class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t ">
                <h3 class="text-3xl font-semibold">{{ $modalTitle }}</h3>

                <button
                    class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                    onclick="toggleModal('modal-{{ $modalID }}')">
                    <span
                        class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none hover:text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

            </div>
            <!--body-->
            <form action="{{ $action }}" method="POST">
                @csrf
                @method($method)

                <div class="relative p-6 flex-auto">
                    {{ $modalBody }}
                </div>
                <!--footer-->
                <div class="flex items-center justify-end px-6 py-4 border-t border-solid border-gray-200 rounded-b">

                    <x-button
                        class="text-sm p-2 capitalize bg-indigo-700 hover:bg-indigo-600 border-white focus:border-indigo-700"
                        type="submit">
                        {{ $approve }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-{{ $modalID }}-backdrop"></div>
<script type="text/javascript">
    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document
            .getElementById(modalID + "-backdrop")
            .classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
