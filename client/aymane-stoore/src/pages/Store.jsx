import {useState} from "react";
import {ReactQueryDevtools} from "react-query/devtools";
import {useQuery, useQueryClient} from "react-query"
import "../style/hoverCard.css"
import ProductCard from "../myComponets/ProductCard.jsx";
import MyLoader from "../myComponets/MyLoader.jsx";
import FilterProducts from "../myComponets/FilterProducts.jsx";
import {useShopingCart} from "@/context/ShopingCartContext.jsx";

function Store() {
    const [products, setProducts] = useState([])
    const {setProductsContext} = useShopingCart()
    const getAllProducts = async () => {
        const response = await fetch('http://127.0.0.1:8000/api/products');
        return await response.json()
    }
    const {data:data,isLoading,isError,isFetching} = useQuery("products",getAllProducts,{
        refetchOnWindowFocus:false,
        retry:1,
        cacheTime:100000,
        staleTime:100000,
        onSuccess:((data) => {
            setProducts(data.data)
            setProductsContext(data.data)
        })
    })
    const queryClient = useQueryClient()
    const display = () => {
        const Products =   data.data
        return  Products?.map((item, key) => (
            <ProductCard key={key} products={item} index={key} />
        ));
    };
    const filterWithPayement = async (e) => {
        const payMethod = e.currentTarget.dataset.value;
        try {
            await queryClient.invalidateQueries('products', data);
            console.log(data)
            let filteredProducts = queryClient.getQueryState('products').data?.data;
            if (payMethod === 'all') {
                await queryClient.invalidateQueries('products');
            }
            if (payMethod === 'cash') {
                filteredProducts = filteredProducts.filter((item) => item.payement_method === 'cash');
            }
            if (payMethod === 'online') {
                filteredProducts = filteredProducts.filter((item) => item.payement_method === 'online');
            }
            queryClient.setQueryData('products', (prevData) => ({
                ...prevData,
                data: filteredProducts,
            }));
        } catch (error) {
            console.error('Error filtering products:', error);
        }
    };

    if(isLoading||isFetching){
        return <MyLoader />
    }
    if(isError){
        return (
            <div className="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p className="font-bold">Warning</p>
                <p>Problems in fetch data please repeat later.</p>
            </div>
        )
    }
    return (<>
            <div className="container my-5  flex flex-col justify-center items-center">
                 <div className="flex flex-col sm:flex-row">
                    <div className="sm:w-2/6 md:w-1/3 lg:w-2/6 hidden md:block">
                        <p className="text-2xl">Filters:</p>
                        <FilterProducts products={products} />
                    </div>
                    <div className="sm:w-4/6 md:w-2/3 lg:w-4/6">
                        <h3 className="text-2xl">Products list:</h3>
                        <h3>Filter with payment method : <span>    </span>
                            <span onClick={filterWithPayement} data-value={"cash"} className="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 cursor-pointer">Cash on delivery</span>
                            <span onClick={filterWithPayement} data-value={"online"} className="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 cursor-pointer" >Online</span>
                            <span onClick={filterWithPayement} data-value={"all"} className="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 cursor-pointer" >All</span>
                        </h3>
                        <div className="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 my-4">
                            {display()}
                        </div>
                    </div>
                </div>
            </div>

        </>
    )}
export default Store;