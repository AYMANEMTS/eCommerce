import {createContext, useContext, useEffect, useState} from "react";


const FavoriteContext = createContext({})
const INITIAL_FAVORITE_ITEMS = localStorage.getItem("favorites")?JSON.parse(localStorage.getItem("favorites")):[]

const FavoriteProvider = ({children}) => {
    const [favoriteItems, setFavoriteItems] = useState(INITIAL_FAVORITE_ITEMS)
    useEffect(() => {
        localStorage.setItem("favorites",JSON.stringify(favoriteItems))
    }, [favoriteItems]);
    const toogleFavorite = (id) => {
        setFavoriteItems((prevFavorites) => {
            const isAlreadyFavorite = prevFavorites.some((item) => item.id === id);
            if (isAlreadyFavorite) {
                // If id is already in favorites, remove it
                return prevFavorites.filter((item) => item.id !== id);
            } else {
                // If id is not in favorites, add it
                return [...prevFavorites, { id }];
            }
        });
    };
    const isFavorit = (id) => {
        return favoriteItems.some((item) => item.id === id);
    }
    const getCountFavorites = () => favoriteItems.length;

    return (
        <FavoriteContext.Provider value={{favoriteItems , isFavorit , setFavoriteItems , toogleFavorite ,getCountFavorites}}>
            {children}
        </FavoriteContext.Provider>
    )
}
export default FavoriteProvider
export const useFavoriteContext = () => {
    return useContext(FavoriteContext)
}