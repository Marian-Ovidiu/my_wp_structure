export default function donationFormData(progettoId, thankYouUrl) {
    console.log(progettoId, thankYouUrl);
    return {
        progettoId: null,
        thankYouUrl: null,
        step: 1,
        selectedAmount: null,
        customAmount: '',
        showAmountError: false,
        loading: false,
        stripe: null,
        clientSecret: null,
        elements: null,
        touched: {
            name: false,
            surname: false,
            email: false,
            phone: false,
        },
        formData: {
            name: '',
            surname: '',
            phone: '',
            email: '',
            codiceFiscale: '',
        },
        init(progettoId, thankYouUrl) {
            this.progettoId = progettoId;
            this.thankYouUrl = thankYouUrl;
        },
        async createIntent() {
            this.loading = true;
            let amount = (this.customAmount || this.selectedAmount) * 100;
            const call = new window.ApiService();

            try {
                const res = await call.post('/create-payment-intent', {
                    amount,
                    progetto_id: this.progettoId,
                });

                this.clientSecret = res.clientSecret;
                this.stripe = Stripe('pk_live_51QQqzmP9ji9EUZt5LkB8kShCP2rhsd195h5SlYAzUb3gGabZ8R8Uinp0TiDGKXqFsBu7oCPVL7of79NbNSGrAr3u00xFyOm6u8');
                this.elements = this.stripe.elements({ clientSecret: this.clientSecret });

                // Prima cambia lo step, così Alpine renderizza il DOM giusto
                this.step = 3;

                // Aspetta che Alpine abbia inserito #payment-element nel DOM
                await this.$nextTick(() => {
                    const paymentElement = this.elements.create('payment');
                    paymentElement.mount(`#payment-element-${this.progettoId}`);
                });

                this.setupGooglePay(amount, this.progettoId);
            } catch (err) {
                console.error('Errore nella creazione dell\'intent:', err);
            } finally {
                this.loading = false;
            }
        },
        async setupGooglePay(amount, progettoId) {
            const paymentRequest = this.stripe.paymentRequest({
                country: 'IT',
                currency: 'eur',
                total: { label: 'Donazione', amount },
                requestPayerName: true,
                requestPayerEmail: true
            });

            const result = await paymentRequest.canMakePayment();
            if (result) {
                const prButton = this.elements.create("paymentRequestButton", { paymentRequest });
                prButton.mount(`#google-pay-button-${progettoId}`);
                document.getElementById(`google-pay-button-${progettoId}`).style.display = 'block';
            }
        },
        async submitForm() {
            this.loading = true;
            try {
                const { error } = await this.stripe.confirmPayment({
                    elements: this.elements,
                    confirmParams: {
                        return_url: thankYouUrl,
                        payment_method_data: {
                            billing_details: {
                                name: `${this.formData.name} ${this.formData.surname}`,
                                email: this.formData.email,
                            }
                        }
                    }
                });

                if (error) throw error;

                await new window.ApiService().post('/complete-donation', {
                    ...this.formData,
                    progettoId,
                    amount: this.customAmount || this.selectedAmount
                });

                window.location.href = thankYouUrl;
            } catch (err) {
                alert("Errore: " + err.message);
                console.error(err);
            } finally {
                this.loading = false;
            }
        },
        isAmountValid() {
            return this.selectedAmount || (this.customAmount && this.customAmount > 0);
        },
        isUserDataValid() {
            return this.formData.name && this.formData.surname && this.formData.email && this.formData.phone;
        },
        goToStep(n) {
            if (n === 1) {
                this.step = 1;
            } else if (n === 2 && this.isAmountValid()) {
                this.step = 2;
                this.showAmountError = false;
            } else if (n === 3 && this.isAmountValid() && this.isUserDataValid()) {
                this.createIntent();
            } else {
                if (n === 2) this.showAmountError = true;
            }
        }
    };
}
