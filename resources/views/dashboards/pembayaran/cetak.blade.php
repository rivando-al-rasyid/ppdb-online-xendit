<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <!-- Include any CSS stylesheets or frameworks here -->
</head>

<body>
    <h1>Invoice Details</h1>
    <div>
        <h2>Invoice Information</h2>
        <p>Invoice ID: {{ $invoiceDetails['id'] }}</p>
        <p>Amount: {{ $invoiceDetails['amount'] }}</p>
        <p>Status: {{ $invoiceDetails['status'] }}</p>
        <!-- Add more details as needed -->
    </div>
    <!-- Include any JavaScript scripts or frameworks here -->
</body>

</html>
