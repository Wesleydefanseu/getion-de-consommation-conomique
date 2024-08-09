<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Methods</title>
    <link rel="stylesheet" href="{{asset('New_pages/Payement/stylee.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
</head>

<body>



    <div class="wrapper" style=" display:grid;grid-template-columns: repeat(1, 1fr);background-color: rgba(0, 0, 0, 0.5);width:100%;height:100%;z-index:1;  position: fixed;  backdrop-filter: blur(5px);">
        <div class="payment-container" id="operateurs" style="margin-left:auto;margin-right:auto;">
            <div class="payment-method mtn">
                <img src="{{asset('New_pages/Payement/MTN.png')}}" alt="MTN Mobile Money">
                <h3>MTN Mobile Money</h3>
                <button onclick="payement()">MTN</button>
            </div>
            <div class="payment-method orange">
                <img src="{{asset('New_pages/Payement/Orange.png')}}" alt="Orange Money">
                <h3>Orange Money</h3>
                <button onclick="payement()">Orange</button>
            </div>
        </div>

        <div class="transaction-form-container hidden" style="display:none;margin-left:auto;margin-right:auto;" id="transactionForm">
            <h2>Details de la transaction</h2>
            <form id="paymentForm"method="POST" action="{{route('client.RechargeSolde')}}" onsubmit="confirmTransaction(event)">
                @csrf
                <label for="phoneNumber">Numero  Telephone:</label>
                <input type="tel" id="Numero" name="phoneNumber" required>
                <label for="amount">Montant:</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" required>
                <button type="submit" >Confirmer la Transaction</button>
            </form>
        </div>

        <button style="width: 200px;margin-left:auto;margin-right:auto;height:50px;border-radius:20px;font-weight:bold;background-color:#FF8000">
        <a class="compare" href="{{url('mycart')}}" style="text-decoration:none;color:white;font-size:24px" ><i class="fa fa-arrow-left" ></i> <span style="margin-left:8px">Back</span> </a>
        </button>


    </div>

    <script>
        const block1 = document.getElementById('operateurs');
        const block2 = document.getElementById('transactionForm');

        function payement() {
            if (block2.style.display == 'none') {

                block2.style.display = 'block';
                block1.style.display = 'none';

            } else {

                block1.style.display = 'flex';
                block2.style.display = 'none';
            }

        }
    </script>

    <script src="{{asset('New_pages/Payement/java.js')}}"></script>
</body>

</html>