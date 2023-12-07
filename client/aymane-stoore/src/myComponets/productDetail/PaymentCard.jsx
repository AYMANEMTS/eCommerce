import {
    Card , CardHeader , CardTitle , CardDescription , CardContent , CardFooter
} from "@/componets/ui/card.jsx";
import {Label} from "@/componets/ui/label.jsx";
import {Button} from "@/componets/ui/button.jsx";
import {Input} from "@/componets/ui/input.jsx";
import {CardElement, useElements, useStripe} from "@stripe/react-stripe-js";
import {useShopingCart} from "@/context/ShopingCartContext.jsx";
import axios from "axios";
import {useTheme} from "@/componets/theme-provider.jsx";
import {useForm} from "react-hook-form";
import {Loader} from "lucide-react";
import {useNavigate} from "react-router-dom";

export default function PaymentCard() {
    const { theme } = useTheme()
    const stripe = useStripe();
    const elements = useElements();
    const {getTotalPrice,cartItems} = useShopingCart()
    const {register,handleSubmit,formState:{errors,isValid,isSubmitting}} = useForm()
    const navigate = useNavigate()
    const stripePayment = async (paymentMethod,fullName,phone,email,address) => {
        const data = {
            amount: getTotalPrice(),
            description: "This is a first payment test",
            stripePaymentMethod: paymentMethod.id,
            fullName:fullName,
            email:email,
            phone:phone,
            address:address,
            cartItems: cartItems
        };

        try {
            const res = await axios.post('http://localhost:8000/api/stripePost', data);
            if (res.data.status === "succeeded"){
                localStorage.removeItem('shopping-cart')
                window.location.href = 'http://localhost:5173/thank-you';
            }
        } catch (error) {
            console.error('Error making payment:', error);
        }
    };

    const handlePayment = async (data) => {
        if (!stripe || !elements) {
            // Stripe.js has not loaded yet. Make sure to disable form submission until Stripe.js has loaded.
            return;
        }

        const cardElement = elements.getElement(CardElement);

        try {
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.error(error);
            } else {
                stripePayment(paymentMethod,data.fullName,data.phone,data.email,data.address);
            }
        } catch (error) {
            console.error('Error creating payment method:', error);
        }
    };

    const customStyle = {
        base: {color: 'white'},
    };

    return (
        <>
                <Card >
                    <CardHeader>
                        <CardTitle>Pay now</CardTitle>
                        <CardDescription>
                            This payment is secures and save
                        </CardDescription>
                    </CardHeader>
                    <form onSubmit={handleSubmit(handlePayment)}>
                    <CardContent className="grid gap-3">

                            <div className="grid gap-2">
                                <Label htmlFor="fullName">Full name</Label>
                                <Input {...register('fullName',{
                                    required:{
                                        value:true,message:"the full name field is required"
                                    }
                                })} type={"text"} />
                                {errors?.fullName && <span className={"text-red-600"}>{errors.fullName.message}</span>}
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="phone">Phone number</Label>
                                <Input {...register('phone',{
                                    required:{
                                        value:true,message:"the phone field is required"
                                    },
                                    valueAsNumber:true
                                })} type={"number"} />
                                {errors?.phone && <span className={"text-red-600"}>{errors.phone.message}</span>}
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="email">Email</Label>
                                <Input {...register('email',{
                                    required:{
                                        value:true,message:"the email field is required"
                                    },
                                    pattern:{
                                        value:/^\S+@\S+\.\S+$/,message:"the email is not valid format"
                                    }
                                })} type={"email"} />
                                {errors?.email && <span className={"text-red-600"}>{errors.email.message}</span>}
                            </div>
                            <div className="grid gap-2">
                                <Label htmlFor="adsress">Address</Label>
                                <Input {...register('address',{
                                    required:{
                                        value:true,message:"the address field is required"
                                    }
                                })} type={"text"} />
                                {errors?.address && <span className={"text-red-600"}>{errors.address.message}</span>}
                            </div>
                            <div className="grid gap-2 ">
                                <Label htmlFor="number">Card number</Label>
                                <CardElement options={{style: theme === 'dark'?customStyle:{} }}  id="card-element" />
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button  disabled={!stripe || isSubmitting} className="w-full">
                                {isSubmitting && <Loader className={"my-2 mx-2 animate-spin"} />}{'  '}
                                Continue
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
        </>
    );
}

