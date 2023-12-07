import brand from "../static/images/brand/brand.jpeg"
import {Button} from "../componets/ui/button.jsx";
import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "../componets/ui/card.jsx";
import  "../global.css"
import card_test from "../static/images/card_test.jpg"
import {useQuery} from "react-query";
import ProductCard from "../myComponets/ProductCard.jsx";
import {Link} from "react-router-dom";
import {ReactQueryDevtools} from "react-query/devtools";
function Home() {
    const getLastProducts = async () => {
        const response = await fetch('http://127.0.0.1:8000/api/lastProducts');
        const data = await response.json()
        return data
    }
    const {data:lastProducts} = useQuery("lastProducts",getLastProducts,{
        refetchOnWindowFocus:false,
        retry:1,
        cacheTime:50000,
        staleTime:25000,
    })
    return (
        <>
            <ReactQueryDevtools />
            <img src={brand} style={{width:"100%"}}/>
            <div className={"container "}>
                <div className="flex justify-center text-4xl mt-3">
                    <h1 className="text-center">Last Products</h1>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10 mt-4">
                    {lastProducts?.map((item,key) => {
                        return(
                            <ProductCard key={key} products={item} index={key} />
                        )
                    })}
            </div>
                <div className="flex justify-center my-3">
                    <Button variant="outline" className="hover:bg-yellow-500 rounded w-[15rem]">
                        <Link to="/store">More</Link>
                    </Button>
                </div>

                <p className={"text-center text-3xl mt-8 mb-10"}>La confiance de nos clients est notre priorité</p>
            </div>
        </>
    );
}

export default Home;