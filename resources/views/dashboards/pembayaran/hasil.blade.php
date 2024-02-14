@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body" id="print-content">
            <h5 class="card-title">Deskripsi:</h5>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">Satu Stel Dasar Pakaian Putih Dongker</li>
                <li class="list-group-item">Satu Stel Dasar Pakaian Pramuka</li>
                <li class="list-group-item">Satu Stel Dasar Baju Batik Sekolah</li>
                <li class="list-group-item">Satu Stel Dasar Pakaian Muslim (Khusus Jum’at)</li>
                <li class="list-group-item">Satu Stel Pakaian Baju Olahraga</li>
                <li class="list-group-item">Atribut, topi, dasi, pin, lambang (OSIS, Pramuka, Lokasi, dan Nama Siswa)</li>
            </ol>

            <h5 class="card-title mt-4">Data Siswa:</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                {{-- Add other necessary customer data here --}}
            </ul>

            <h5 class="card-title mt-4">Invoice Information:</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Invoice ID:</strong> {{ $invoice->id }}</li>
                <li class="list-group-item"><strong>External ID:</strong> {{ $invoice->external_id }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ $invoice->status }}</li>
                <li class="list-group-item"><strong>Total Amount:</strong> {{ $invoice->amount }}</li>
                <li class="list-group-item"><strong>Expiry Date:</strong> {{ $invoice->expiry_date }}</li>
                {{-- Add other invoice details here --}}
            </ul>
        </div>
    </div>

    <button onclick="printContent()" class="btn btn-primary mt-4">Print</button>

    <script>
        function printContent() {
            var printContents = document.getElementById("print-content").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
