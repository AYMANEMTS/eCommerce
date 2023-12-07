import {createContext, useContext, useEffect, useState} from "react";


const ShopingCartContext = createContext({})
const INITIAL_CART_ITEMS = localStorage.getItem("shopping-cart")?JSON.parse(localStorage.getItem("shopping-cart")):[]
const ShopingCartProvider = ({children}) => {
    const [cartItems, setCartItems] = useState(INITIAL_CART_ITEMS)
    const [productsContext, setProductsContext] = useState([])

    useEffect(() => {
        localStorage.setItem("shopping-cart",JSON.stringify(cartItems))
    }, [cartItems]);
    const getItemQty = (id) => {
        return cartItems.find((item) => item.id === id)?.qty || 0
    }
    const increaseCartQty = (id) => {
        setCartItems((currentItems) => {
            if(currentItems.find(item => item.id === id)==null){
                return [...cartItems, {id,qty: 1}]
            }else {
                return currentItems.map((item) => {
                    if (item.id === id){
                        return {...item,qty:item.qty +1}
                    }else{
                        return item
                    }
                })
            }
        })
    }
    const decreaseCartQty = (id) => {
        setCartItems((curentItems) => {
            if(curentItems.find(item => item.id === id)==null){
                return curentItems.filter((item) => item.id !== id)
            }else {
                return curentItems.map((item) => {
                    if (item.id === id){
                        return {...item,qty:item.qty -1}
                    }else{
                        return item
                    }
                })
            }
        })
    }
    const removeItemFromCart = (id) => {
        setCartItems((currentItems) => currentItems.filter((item) => item.id !== id)
        )
    }
    const getCountItemsCart = (Items) => {
        return Items.length
    }
    const getTotalPrice = () => {
        return cartItems.reduce((total,cartItem) => {
            const item = productsContext?.find((i) => i.id === cartItem.id)
            return total + (item?.price || 0) * cartItem.qty
        },0)
    }

    return <ShopingCartContext.Provider value={{cartItems, getItemQty , increaseCartQty , decreaseCartQty ,
        removeItemFromCart , getCountItemsCart , productsContext , setProductsContext , getTotalPrice}}>
        {children}
    </ShopingCartContext.Provider>
}
export default ShopingCartProvider;

export const useShopingCart = () => {
    return useContext(ShopingCartContext)
}