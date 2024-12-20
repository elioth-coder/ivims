<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CTPL Insurance Policy - Authenticated Successfully</title>
    <style>
        * {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="message">
            <p>Dear
                {{ $data['gender']=='male' ? 'Mr.' : 'Ms.' }}
                {{ strtoupper($data['customer']) }},
            </p>
            <p>
                We are pleased to inform you that your Compulsory Third-Party Liability (CTPL) insurance application
                has been successfully processed and approved. Please see attached digital copy of your insurance policy.
            </p>
            <p>
                Your policy covers the essential protection required by law, and it is now active. For your convenience, the hard copy of the
                policy document is available for pick-up at any of our nearest authorized branches. Simply present a valid ID, and our staff will
                assist you with your claim.
            </p>

            <p>
                Thank you for choosing {{ strtoupper($data['company']) }}as your trusted provider. Should you have any questions or need further assistance, please feel free to reach out.
            </p>

            <p>
                Warm regards, <br>
                <span class="capitalize">{{ $data['agent_name'] }}</span><br>
                Customer Service <br>
                {{ strtoupper($data['company']) }} <br>
                {{ $data['contact_no'] }} <br>
                {{ $data['email'] }} <br>
            </p>
        </div>
    </div>
</body>

</html>
