<x-app-layout>
    <div class="w-3/4 mx-auto text-center" style="margin-top: 100px; margin-bottom: 100px;">

        @if (!auth()->user()->isAdmin())
            <h1 class="text-black text-lg font-bold">Your Prescription List</h1>
        @else
            <h1 class="text-black text-lg font-bold">All Prescription</h1>
        @endif

        <div
            class="max-w-3/4 lg:max-w-4/5 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @foreach ($prescriptions as $prescription)
                <div>

                    <a href="{{ route('prescriptions.show', $prescription->id) }}">

                        <div class="max-w-3/4 lg:max-w-4/5"
                            style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                            <p style="margin: 10px; padding: 10px;">Id : {{ $prescription->id }}</p>
                            <p style="margin: 10px; padding: 10px;">Address :
                                {{ $prescription->delivery_address }}
                            </p>
                        </div>
                    </a>

                    <div class="max-w-3/4 lg:max-w-4/5"
                        style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                        <div>
                            @if ($prescription->status == 'approved')
                                <p class="text-black" style="margin-left: 10px; padding-left: 10px; color:black;">
                                    Accepted</p>
                            @elseif ($prescription->status == 'rejected')
                                <p class="text-black" style="margin-left: 10px; padding-left: 10px; color:black;">
                                    Reject</p>
                            @else
                                <p class="text-black" style="margin-left: 10px; padding-left: 10px; color:black;">
                                    Pending</p>
                            @endif

                        </div>

                        <p style="margin-right: 10px; padding-rigth: 10px; color:black;">
                            {{ $prescription->created_at->diffForHumans() }}</p>

                    </div>
                </div>

                <hr> 
            @endforeach
        </div>
    </div>
</x-app-layout>
