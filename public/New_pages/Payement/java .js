function selectPayment(method) {
    alert(`You selected ${method} as your payment method.`);
    showTransactionForm();
}

function showTransactionForm() {
    var transactionForm = document.getElementById('transactionForm');
    transactionForm.classList.remove('hidden');
}

function confirmTransaction(event) {
    event.preventDefault();
    var phoneNumber = document.getElementById('phoneNumber').value;
    var amount = document.getElementById('amount').value;

    alert(`Transaction confirmed!\nPhone Number: ${phoneNumber}\nAmount: ${amount}`);

    // You can add more logic here, like sending the transaction details to a server
}
