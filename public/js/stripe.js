document.addEventListener("DOMContentLoaded", () => {
  const stripe = Stripe(window.stripeKey);
  const elements = stripe.elements();
  const cardElement = elements.create('card');
  cardElement.mount('#card-element');

  const cardHolderName = document.getElementById('card-holder-name');
  const form = document.getElementById('card-form');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;

  const cardError = document.getElementById('card-error');
  const errorList = document.getElementById('error-list');

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // フォームのデフォルト送信を防止

    // エラーメッセージ初期化
    while (errorList.firstChild) {
      errorList.removeChild(errorList.firstChild);
    }
    cardError.style.display = 'none';

    if (cardHolderName.value === '') {
      cardError.style.display = 'block';
      const li = document.createElement('li');
      li.textContent = 'カード名義人の入力は必須です。';
      errorList.appendChild(li);
      return;
    }

    const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
      payment_method: {
        card: cardElement,
        billing_details: {
          name: cardHolderName.value
        }
      }
    });

    if (error) {
      console.error(error);
      cardError.style.display = 'block';
      const li = document.createElement('li');
      li.textContent = error.message;
      errorList.appendChild(li);
      return;
    }

    // paymentMethodId を hidden input にセットして送信
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'paymentMethodId');
    hiddenInput.setAttribute('value', setupIntent.payment_method);
    form.appendChild(hiddenInput);

    form.submit();
  });
});
