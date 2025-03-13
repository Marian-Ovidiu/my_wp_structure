function setupGooglePay(amount) {
    const paymentRequest = stripe.paymentRequest({
        country: 'IT',
        currency: 'eur',
        total: {
            label: 'Donazione',
            amount: amount
        },
        requestPayerName: true,
        requestPayerEmail: true
    });

    paymentRequest.canMakePayment().then(result => {
        let googlePayButton = document.getElementById("google-pay-button");
        
        if (result && googlePayButton) {
            googlePayButton.style.display = "block";
            const elements = stripe.elements();
            const prButton = elements.create("paymentRequestButton", {
                paymentRequest: paymentRequest,
            });

            prButton.mount("#google-pay-button");
        } else {
            console.error("Google Pay non disponibile o elemento non trovato.");
        }
    }).catch(error => {
        console.error("Errore nel controllo di Google Pay:", error);
    });
}
