@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Invoice anda!</div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Id Order:</strong> {{ $data['order_id'] }} </li>
                            <li><strong>Nama:</strong> {{ $data['name'] }} </li>
                            <li><strong>No.HP:</strong> {{ $data['phone'] }} </li>
                            <li><strong>Barang:</strong> {{ $data['item'] }} </li>
                            <li><strong>harga:</strong> 250.000 </li>
                            <li><strong>status:</strong> {{ $data['status'] }} </li>
                        </ul>

                        @if ($data['status'] === 'pending')
                            <button id="payButton" class="btn btn-primary">melakukan pembayaran</button>
                        @else
                            <p>Payment already processed or status is not pending.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-Bakl6nDg2pt1sK03"></script>

    <script type="text/javascript">
        // Retrieve the Snap Token passed from the controller
        var snapToken = "{{ $token }}";

        // Check if the Snap Token is valid
        if (snapToken) {
            // Add a click event listener to the button
            document.getElementById('payButton').addEventListener('click', function() {
                // Call the snap.pay() function with the retrieved Snap Token
                snap.pay(snapToken);
            });
        } else {
            console.error('Invalid Snap Token received from the server.');
        }
    </script>
@endsection
