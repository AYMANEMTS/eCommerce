import {SheetContent, SheetTrigger,Sheet,SheetHeader,SheetTitle,SheetDescription,SheetFooter} from "../componets/ui/sheet.jsx";
import {useShopingCart} from "../context/ShopingCartContext.jsx";
import CartItem from "./CartItem.jsx";
import {useQuery, useQueryClient} from "react-query";
import {Button} from "@/componets/ui/button.jsx";
import {useState} from "react";
import PaymentCard from "@/myComponets/productDetail/PaymentCard.jsx";
import axios from "axios";
import StripeContainer from "@/stripe/StripeContainer.jsx";
export default function Cart() {
    const [isInCheckoutPage, setIsInCheckoutPage] = useState(false)
    const {cartItems , getCountItemsCart} = useShopingCart()
    const queryClient = useQueryClient()
    const countItems = getCountItemsCart(cartItems)
    const fetchProducts = () => {
        return fetch("http://127.0.0.1:8000/api/products")
            .then((res) => res.json())
            .then((response) => {
                if (response.data.length > 0) {
                    return response.data;
                }
                return [];
            });
    };
    const { data: products } = useQuery("products2", fetchProducts, {
        enabled: !queryClient.getQueryState("products"),
    });
    const {getTotalPrice} = useShopingCart()


    return (<>
            <Sheet>
                <SheetTrigger>
                    <div className="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {countItems > 0 ? (
                            <span className="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                 {countItems}
                            </span>) : (<span className="flex absolute -mt-5 ml-4">
                            <span className="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
                            <span className="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                        </span>)}
                    </div>
                </SheetTrigger>
                <SheetContent>
                    {!isInCheckoutPage  ?  <>
                        <SheetHeader>
                            <SheetTitle>Shopping Cart</SheetTitle>
                            <div style={{ maxHeight:'32rem', overflowY: "auto" }}>
                                <SheetDescription>

                                    {cartItems?.map((item,key) => {
                                        return (<div key={key}>
                                            <CartItem  item={item} products={products} />
                                        </div>)
                                    })}
                                </SheetDescription>
                            </div>

                        </SheetHeader>
                        {cartItems.length >= 1 ? <>
                            <SheetFooter>
                                <div className={"text-xl font-bold"}>

                                    Total price : {getTotalPrice()}
                                </div>
                            </SheetFooter>
                            <Button onClick={() => setIsInCheckoutPage(true)} className={"rounded w-full mt-2"}>
                                Checkout
                            </Button>
                        </>:'No item in cart'}
                    </> : <>
                        <SheetHeader className={"w-full"}>
                            {/*<PaymentCard stripePayment={stripePayment} />*/}
                            <StripeContainer  />
                        </SheetHeader>
                        <Button onClick={() => setIsInCheckoutPage(false)} className={"rounded w-full mt-4"}>
                            Back to cart
                        </Button>

                    </>}



                </SheetContent>
            </Sheet>
        </>
    );
}
