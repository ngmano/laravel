const stripe = Stripe('pk_test_51Ou97fSDZjzTNz5mYrXGO9YkJycBMWTGnep2omwX2OxYvOgP7CDPeHx61CEenoduUhQgob6vsD0XQQtgwbfv2lsH00e3XAJcIW');
 
const elements = stripe.elements();
const cardElement = elements.create('card');

cardElement.mount('#card-element');

// Handle form submission
var form = document.getElementById('payment-form');
var cardHolderName = document.getElementById('cardholder-name');
form.addEventListener('submit', async function(event) {
    event.preventDefault();
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );
 
    if (error) {
        alert(error.message);
    } else {
        stripeTokenHandler(paymentMethod.id);
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