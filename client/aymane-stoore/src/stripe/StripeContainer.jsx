import { loadStripe } from '@stripe/stripe-js';
import { Elements } from '@stripe/react-stripe-js';
import PaymentCard from "@/myComponets/productDetail/PaymentCard.jsx";

const stripePromise = loadStripe('pk_test_51NVjXNI1z6kkp7Y0Wo2icwhbmHBt89zimhZAitjoLp4xrAThkXEXZ0tWeui1bnV7tFzDHxllFYbTEiBIXB3p0xRl00l9V0RntJ');

const StripeContainer = () => {
    return (
        <Elements stripe={stripePromise}>
            {/*<CheckoutForm />*/}
            <PaymentCard />
        </Elements>
    );
};

export default StripeContainer;