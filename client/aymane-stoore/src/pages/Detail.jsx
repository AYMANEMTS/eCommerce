import {useParams} from "react-router-dom";
import {useQuery, useQueryClient} from "react-query";
import {ReactQueryDevtools} from "react-query/devtools";
import CashDetail from "../myComponets/productDetail/CashDetail.jsx";
import OnlineDetail from "../myComponets/productDetail/OnlineDetail.jsx";
import MyLoader from "../myComponets/MyLoader.jsx";

function Detail() {
    const {id} = useParams()
    const queryClient = useQueryClient()
    const getProducts = async (id) => {
        const response =  await fetch(`http://127.0.0.1:8000/api/products/${id}`)
        const data = await response.json()
        return data
    }
    const {data:product , isLoading,isError , error} = useQuery(['productDetail',id],() => getProducts(id),{
        staleTime:40000,
        refetchOnWindowFocus:false,
        retry:1,
        
    })
    if(isError){
        console.log(error)
    }
    if(isLoading){
        return (<MyLoader />)
    }
    if(product?.payement_method === 'cash'){
        return (
            <CashDetail product={product} />
        )
    }
    if(product?.payement_method === 'online'){
        return (
            <OnlineDetail product={product} />
        )
    }
    return (
        <>

            <ReactQueryDevtools />
            product not have payement methode
        </>
    );
}

export default Detail;