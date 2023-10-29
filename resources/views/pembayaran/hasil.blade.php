@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-Bakl6nDg2pt1sK03"></script>

    <script type="text/javascript">
        // Retrieve the Snap Token passed from the controller
        var snapToken = "{{ $token }}";

        // Check if the Snap Token is valid
        if (snapToken) {
            // Call the snap.pay() function with the retrieved Snap Token
            snap.pay(snapToken);
        } else {
            console.error('Invalid Snap Token received from the server.');
        }
    </script>
@endsection
