import {useShopingCart} from "../context/ShopingCartContext.jsx";

function CartItem({item,products}) {
    const {increaseCartQty,decreaseCartQty ,removeItemFromCart} = useShopingCart()
    const product = products?.find((pd) => pd.id === item.id)
    return (
        <>
            <div className="flex flex-col md:flex-row border-b border-gray-400 py-4">
                <div className="flex-shrink-0">
                    <img src={`http://127.0.0.1:8000/storage/${product?.image}`} alt="Product image" className="w-32 h-32 object-cover"/>
                </div>
                <div className="mt-4 md:mt-0 md:ml-6">
                    <div className="text-lg font-bold">{product?.title}</div>
                    <br/>
                    <div className="ml-auto font-bold">${product?.price}</div>
                    <div className="mt-4 flex items-center">
                        <div className="mr-2 text-gray-600">Quantity: </div>
                        <div className="flex items-center">
                            <button className="bg-yellow-400 rounded-l-lg px-2 py-1" onClick={() => decreaseCartQty(product.id)} >-</button>
                            <div className="mx-2 text-gray-600">{item.qty}</div>
                            <button className="bg-yellow-400 rounded-r-lg px-2 py-1" onClick={() => increaseCartQty(product.id)}>+</button>
                            <button className="bg-red-500 rounded px-2 py-1 ml-1" onClick={() => removeItemFromCart(product.id)} >x</button>
                        </div>
                    </div>
                    <div className={"font-bold "}>total price item : ${product?.price * item.qty}</div>
                </div>
            </div>
        </>
    );
}

export default CartItem;