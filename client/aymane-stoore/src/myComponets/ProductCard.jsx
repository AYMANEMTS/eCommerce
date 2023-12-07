import {useContext, useState} from "react";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "../componets/ui/card.jsx";
import {Button} from "../componets/ui/button.jsx";
import {Link} from "react-router-dom";
import {useShopingCart} from "../context/ShopingCartContext.jsx";
import {useFavoriteContext} from "@/context/FavorieContext.jsx";

export default function ProductCard({ products, index }) {
    const [cardHoverStates, setCardHoverStates] = useState(Array(products.length).fill(false));
    const {getItemQty,increaseCartQty,decreaseCartQty,removeItemFromCart} = useShopingCart()
    const {toogleFavorite , favoriteItems ,isFavorit} = useFavoriteContext()

    const qty = getItemQty(products.id)
    const handleMouseEnter = (index) => {
        const updatedCardHoverStates = [...cardHoverStates];
        updatedCardHoverStates[index] = true;
        setCardHoverStates(updatedCardHoverStates);
    };

    const handleMouseLeave = (index) => {
        const updatedCardHoverStates = [...cardHoverStates];
        updatedCardHoverStates[index] = false;
        setCardHoverStates(updatedCardHoverStates);
    };
    return (
        <>
            <Card
                onMouseEnter={() => handleMouseEnter(index)}
                onMouseLeave={() => handleMouseLeave(index)}
                className={`border-2 ${cardHoverStates[index] ? 'border-slate-950' : ''}`}
            >
                <picture className="rounded-lg overflow-hidden block">
                    <Link to={`/product/${products?.id}`}>
                    <img
                        className="hover:scale-125 ease-in duration-150 w-full h-[18rem]"
                        src={`http://127.0.0.1:8000/storage/${products?.image}`}/>
                    </Link>
                </picture>
                <CardHeader>
                    <CardTitle><Link to={`/product/${products?.id}`}>{products?.title}</Link></CardTitle>
                    <CardDescription className={"text-yellow-500 pb-0 title"}>
                        {products?.category?.name}
                    </CardDescription>
                </CardHeader>
                <CardContent >
                    <p className={"text-center text-red-500"}>
                        <del>{products?.befor_price}</del>
                    </p>
                    <p className={"text-center text-green-500 price"}>{products?.price} USD</p>
                </CardContent>
                <CardFooter style={{ marginTop: 'auto' }}>
                    {products?.payement_method === 'online'?
                        qty === 0 ?
                            (
                                <>
                                    <Button onClick={() => increaseCartQty(products.id)} variant={"outline"} className={"rounded w-full"}>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to cart
                                    </Button>
                                    <Button variant={"outline"} onClick={() => toogleFavorite(products.id)} className={`m-1 ${isFavorit(products.id)?'bg-yellow-500':''}` } >
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </Button>
                                </>
                            ) :
                            (<div className="ml-[3.3rem]">
                                    <button onClick={() => decreaseCartQty(products.id)} className="bg-yellow-400 rounded-l-lg px-2 py-1" >-</button>
                                    <span className="mx-2 text-gray-600">{qty}</span>
                                    <button onClick={() => increaseCartQty(products.id)} className="bg-yellow-400 rounded-r-lg px-2 py-1" >+</button>
                                    <button onClick={() => removeItemFromCart(products.id)} className="bg-red-500 rounded px-2 py-1 ml-1" >x</button>
                                </div>
                            )
                        :
                    (<><Button variant={"outline"} className={"rounded w-full"}>
                        <svg xmlns="http://www.w3.org/2000/svg" className={"m-1"} height="1em" viewBox="0 0 576 512">
                            <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                        </svg>
                        <Link to={`/product/${products?.id}`}>Order now</Link>
                    </Button>
                        <Button  variant={"outline"} onClick={() => toogleFavorite(products.id)} className={`m-1 ${isFavorit(products.id)?'bg-yellow-500':''}` }  >
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </Button>
                    </>)
                    }


                </CardFooter>
            </Card>
        </>
    );
}
