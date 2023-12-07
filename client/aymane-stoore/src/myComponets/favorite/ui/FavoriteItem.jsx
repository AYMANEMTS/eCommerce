import {useFavoriteContext} from "@/context/FavorieContext.jsx";
import {useShopingCart} from "@/context/ShopingCartContext.jsx";
import {Button} from "@/componets/ui/button.jsx";
import {Link} from "react-router-dom";
import {SheetClose} from "@/componets/ui/sheet.jsx";
import * as SheetPrimitive from "@radix-ui/react-dialog";
function FavoriteItem() {
    const {favoriteItems , toogleFavorite} = useFavoriteContext()
    const {productsContext} = useShopingCart()
    const favoriteProducts = productsContext.filter((item) =>
        favoriteItems.some((favoriteItem) => favoriteItem.id === item.id)
    );


    return (
        <>
            {favoriteProducts.map((product,key) => {
                return (
                    <div key={key}>
                        <div className="flex flex-col md:flex-row border-b border-gray-400 py-4">
                            <div className="flex-shrink-0">
                                <img src={`http://127.0.0.1:8000/storage/${product?.image}`} alt="Product image" className="w-32 h-32 object-cover" />
                            </div>
                            <div className="mt-4 md:mt-0 md:ml-6 flex-grow">
                                <div className="text-lg font-bold">{product?.title}</div>
                                <div className="ml-auto font-bold">${product?.price}</div>
                                <div className="flex items-center mt-5">

                                    <Link to={`/product/${product.id}`}>
                                        <Button  size="sm" className="bg-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" className={"m-1"}  height="1em" viewBox="0 0 576 512">
                                                <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                            </svg>
                                            View
                                        </Button>
                                    </Link>
                                    <button onClick={() => toogleFavorite(product.id)} className="bg-red-500 rounded px-2 py-2 ml-1 ">x</button>
                                </div>
                            </div>

                        </div>
                    </div>

                )
            })}
        </>
    );
}

export default FavoriteItem;