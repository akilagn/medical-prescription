<x-app-layout>
    <div class="w-3/4 mx-auto text-center" style="margin-top: 10px;">

        
        <div
            class="max-w-3/4 lg:max-w-4/5 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div>


                @if (!auth()->user()->isAdmin())
                    <div>
                        <a href="{{ route('prescriptions.show', $prescription->id) }}">
                            <div class="max-w-3/4 lg:max-w-4/5"
                                style="margin-bottom: 10px; display: flex; justify-content: space-between;">
                                <p style="margin: 10px; padding: 10px;"> Address :
                                    {{ $prescription->delivery_address }}</p>
                                <p style="margin: 10px; padding: 10px; color:black;">
                                    {{ $prescription->created_at->diffForHumans() }}</p>
                            </div>
                        </a>

                        <div class="max-w-3/4 lg:max-w-4/5"
                            style="margin: 20px; display: flex; justify-content: space-between;">
                            <a href="{{ $prescription->attachment }}">Attachments :</a>
                            <div>
                                @foreach (json_decode($prescription->attachment, true) as $image)
                                    @if (!empty($image))
                                        <a href="/storage/{{ $image }}" target="_blank">
                                            <img src="/storage/{{ $image }}" alt="attachment" class="w-20 h-20"
                                                style="margin-right: 10px; padding-right: 10px;">
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-between">
                        <div
                            style="background-color: white; width: 45%; padding: 20px; height: 500px; border-right: 2px solid black; overflow-y: auto;">

                            <div style="height: 80%; border-bottom: 2px solid black;">
                                <div id="previewImage" style="width: 100%; height: 100%; overflow: hidden;"></div>

                            </div>
                            <div style="height: 20%; display: flex; align-items: center;">
                                @foreach (json_decode($prescription->attachment, true) as $image)
                                    @if (!empty($image))
                                        <a href="javascript:void(0);" onclick="displayImage('{{ $image }}')">
                                            <img src="/storage/{{ $image }}" alt="attachment" class="w-20 h-20"
                                                style="margin-right: 10px;">
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div style="background-color: white; width: 55%; padding: 20px;">

                            <div style="height: 60%; border-bottom: 2px solid black; overflow-y: auto;">

                                <table id="drugTable" style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid black;">
                                            <th style="border: 1px solid black; padding: 8px;">Drug</th>
                                            <th style="border: 1px solid black; padding: 8px;">Quantity</th>
                                            <th style="border: 1px solid black; padding: 8px;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="drugList">
                                        <tr style="border-bottom: 1px solid black;">

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div
                                style="height: 40%; display: flex; flex-direction: column; justify-content: space-between;">

                                <div>
                                    <br>
                                    <label for="drug" style="margin-bottom: 10px;">Drug:</label>
                                    <input type="text" id="drug" placeholder="Drug"
                                        style="margin-bottom: 10px; border: 1px solid black; padding: 5px;">
                                    <label for="quantity" style="margin-bottom: 10px;">Quantity:</label>
                                    <input type="text" id="quantity" placeholder="Quantity"
                                        style="margin-bottom: 10px; border: 1px solid black; padding: 5px;">
                                </div>

                                <div class="display-flex">
                                    <button id="addButton"
                                        style="width: 100px; padding: 10px; background-color: blue; color: white; border: none;">Add</button>
                                </div>

                                <div id="totalAmount" style="padding: 8px; border-top: 1px solid black;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">

                        <form action="{{ route('prescriptions.update', $prescription->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="approved" />
                            <x-primary-button>Send Quotation</x-primary-button>
                        </form>


                    </div>
                @endif

                <br>

                <div class="flex justify-between">

                    @if (!auth()->user()->isAdmin())
                        <div class="flex">
                            <a href="{{ route('prescriptions.edit', $prescription->id) }}">
                               
                            </a>
                            <form class="ml-2" action="{{ route('prescriptions.destroy', $prescription->id) }}"
                                method="post">
                                @method('delete')
                                @csrf
                                <x-primary-button>Delete</x-primary-button>
                            </form>
                        </div>
                    @endif


                    @if (auth()->user()->isAdmin())
                        <div class="flex">

                            <form action="{{ route('prescriptions.update', $prescription->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="status" value="rejected" />
                                <x-primary-button class="ml-2">Reject</x-primary-button>
                            </form>





                        </div>

                        <div>
                            @if ($prescription->status == 'approved')
                                <p class="text-black">Order Accepted</p>
                            @endif
                        </div>
                    @else
                        <p class="text-black">Status: {{ $prescription->status }} </p>
                    @endif
                </div>
            </div>

            @if(!auth()->user()->isAdmin())
                <br>
                <hr>
                <br>
            @endif
            


            <div class="flex justify-between">
                @if ($prescription->status != 'pending' && !auth()->user()->isAdmin() && $prescription->status != 'rejected')
                    <p>Total Amount : $1110</p>

                    <form method="POST">
                        @csrf
                        <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                        <button type="submit"
                            style="background-color: green; color: white; padding: 6px 12px; border: none; cursor: pointer;">Accept</button>
                    </form>
                    <form method="POST">
                        @csrf
                        <input type="hidden" name="prescription_id" value="{{ $prescription->id }}">
                        <button type="submit"
                            style="background-color: red; color: white; padding: 6px 12px; border: none; cursor: pointer;">Reject</button>
                    </form>
                @endif
            </div>


        </div>


    </div>












    <script>
        function displayImage(imageUrl) {
            var previewDiv = document.getElementById('previewImage');
            previewDiv.innerHTML = '<img src="/storage/' + imageUrl +
                '" alt="attachment" style="width: 100%; height: 100%;">';
        }
    </script>

    <script>
        document.getElementById("addButton").addEventListener("click", function() {
            var drug = document.getElementById("drug").value;
            var quantity = document.getElementById("quantity").value;
            var amount = 5 * parseInt(quantity);
            var table = document.getElementById("drugList");
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            cell1.innerHTML = drug;
            cell2.innerHTML = quantity;
            cell3.innerHTML = "Rs" + amount;
            newRow.style.borderBottom = "1px solid black";
            newRow.style.border = "1px solid black";
            newRow.style.padding = "8px";
            // Calculate total amount
            var totalAmount = 0;
            var rows = document.querySelectorAll("#drugList tr");
            for (var i = 1; i < rows.length; i++) {
                var rowCells = rows[i].getElementsByTagName("td");
                totalAmount += parseInt(rowCells[2].innerHTML.replace("Rs", ""));
            }
            document.getElementById("totalAmount").innerHTML = "Total Amount: RS " + totalAmount;
        });
    </script>

</x-app-layout>
