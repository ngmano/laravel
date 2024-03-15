const stripe = Stripe('pk_test_51Ou97fSDZjzTNz5mYrXGO9YkJycBMWTGnep2omwX2OxYvOgP7CDPeHx61CEenoduUhQgob6vsD0XQQtgwbfv2lsH00e3XAJcIW');

let style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
}

const elements = stripe.elements();
const cardElement = elements.create('card', {style: style});

cardElement.mount('#card-element');

// Handle form submission
var form = document.getElementById('payment-form');
var cardHolderName = document.getElementById('cardholder-name');
const cardButton = document.getElementById('submit-btn');
const clientSecret = cardButton.dataset.secret;  


form.addEventListener('submit', async function(event) {
    event.preventDefault();
    // const { paymentMethod, error } = await stripe.createPaymentMethod(
    //     'card', cardElement, {
    //         billing_details: { name: cardHolderName.value }
    //     }
    // );

    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, 
        {
            payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
            }
        }
    ); 
 
    if (error) {
        alert(error.message);
    } else {
        stripeTokenHandler(setupIntent.payment_method);
    }
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}